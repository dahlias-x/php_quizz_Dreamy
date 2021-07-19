<?php 
session_start(); 
require_once 'include/DB.php';
if(!isset($_SESSION['counter'])){
    $_SESSION['counter']=0;
$_SESSION['score']=0;
        
    }

// //Set question number
// $number = (int) $_GET ['n'];
// echo 'number = ' . $number . '<br>';

// Get question
    $query = $connection->query("SELECT * FROM `questions`") ;


// ->fetch() or ->fetchAll()
    $question = $query->fetchAll(PDO::FETCH_ASSOC);
    $totalQ = count($question);
    $_SESSION['totalQ'] = $totalQ;
    $question = $question [$_SESSION['counter']]; 
// echo 'number='.$number-'<br>';
// Get Choices
    $number = $question ['question_number'];
    $query = $connection->query("SELECT * FROM `choices` WHERE question_number = $number") ;
    
//Get Results

    $choices = $query->fetchAll(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // var_dump($choices);
    // echo "</pre>";
   
    require_once 'include/header.php';

?>

        <div class="container">
            <div class="current">Question <?php echo $_SESSION['counter']+1 . ' of ' . $totalQ;?></div>
            <p class="question">
            <?php echo $question ['Text']; ?>
            </p>
            <form method="post" action="process.php">
                <ul class="choices">
                <?php
                foreach($choices as $choice){
                    echo '<button name="choice" class="btn" Value="'.$choice['is_correct'].'">'.$choice["text"].'</button>' ."<br>";
                    
                }
                ?>
                </ul>
            </form>
           
        </div>
<?php
    require_once 'include/footer.php';
?>