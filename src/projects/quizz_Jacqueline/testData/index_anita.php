<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>php pdo intro</title>
        <style>
            body {
                font-family: "Arial", sans-serif;
                font-size: larger;
            }

            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }
        </style>
    </head>
    <body>
        <?php


        define('DB_NAME', getenv('DB_NAME'));
        define('DB_USER', getenv('DB_USER'));
        define('DB_PASSWORD', getenv('DB_PASSWORD'));
        define('DB_HOST', getenv('DB_HOST'));


        $connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);

        $query      = $connection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'demo'");
        $tables     = $query->fetchAll(PDO::FETCH_COLUMN);

        if (empty($tables)) {
            echo '<p class="center">There are no tables in database <code>demo</code>.</p>';
        } else {
            echo '<p class="center">Database <code>demo</code> contains the following tables:</p>';
            echo '<ul class="center">';
            foreach ($tables as $table) {
                echo "<li>{$table}</li>";
            }
            echo '</ul>';
        }

        print "<h1>Example with FETCH_ASSOC</h1>";


        $query  = $connection->query("SELECT * from questions");
        $questions = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($questions as $question) {
            $subQuery  = $connection->prepare("SELECT * from answers where answers.QuestionID = ?");
            $subQuery->bindValue(1, $question['Id']);
            $subQuery->execute(); 
            $answers = $subQuery->fetchAll(PDO::FETCH_ASSOC);
            $question['answers'] = $answers;
        }          


        echo ("<pre>"); 

        print_r($questions);
        print_r($answers);

        $query = $connection->query("SELECT Text FROM questions AND Text FROM answers WHERE questions.Id AND answers.QuestionID =1");
        $questiontext1 = $query->fetchAll(PDO::FETCH_ASSOC);
        print_r($questiontext1);

        ?>
    </body>
</html>