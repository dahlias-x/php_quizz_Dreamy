<?php require_once 'include/DB.php';?>
<?php session_start(); ?>

<?php
    if (isset($_POST['submit'])){
       //Get Post variables
       $question_number = $_POST['question_number'];
       echo $question_number;die();
       $question_text = $_POST['question_text'];
       $correct_choice = $_POST['correct_choice'];
       //Choices array
       $choices = array();
       $choice[1]= $_POST['choice1'];
       $choice[2]= $_POST['choice2'];
       $choice[3]= $_POST['choice3'];
       $choice[4]= $_POST['choice4'];
       $choice[5]= $_POST['choice5'];


       //question query
       $query = "INSERT INTO `questions`(question_number,text)
                    VALUES('$question_number','$question_text')";
       //Run query
       $insert_row = $Connection -> query($query) or die ($connection->error-__LINE__);   
       
       // Validate instert
       if($inser_row) {
            foreach ($choices as $choice => $value) {
             if($value !=''){
                if($correct_choice == $choice) {
                    $is_correct == 1;
                } else {
                    $is_correct = 0;
                
                }
                // choice query
                $query= "INSERT INTO `choice` (question_number, is_correct, text)
                VALUES('$question_number','$is_correct',$value)";

                //Run query
                $insert_row = $connection -> query ($query) or die($connection->error.__LINE__);
                
                //Validate insert
                if($inser_row) {
                    continue;
                    
                } else{
                    die ('Error : ('.$connection->error.')'.$connection->error);
                }
             }
            }
            $msg ='Question has been added';
       }

    }

    $query = "SELECT * FROM `questions`";
    //Get Results
    $questions = $connection ->query($query) or die ($connection->error-__LINE__);
    $totL = $questions -> num_rows;
    $next = $total+1;

?> 


    <?php require_once 'include/header.php';?> 
    <main>
        <div class="container">
            <h2>Add A Question</h2>
            <?php
                if(isset($msg)){
                    echo '<p>'.$msg.'</p>';
                }
               ?> 
            <form method="post" action="add.php"></form>
            <p>
                <label> Question Number: </Label>
                <input type="number" value="<?php echo "$next" ?> name="question_number"/>
            </p>
            <p>
                <label> Question Text: </Label>
                <input type="text" name="question_text"/>
            </p>
            <p>
                <label> Choice #1: </Label>
                <input type="text" name="Choice1"/>
            </p>
            <p>
                <label> Choice #2: </Label>
                <input type="text" name="Choice2"/>
            </p>
            <p>
                <label> Choice #3: </Label>
                <input type="text" name="Choice3"/>
            </p>
            <p>
                <label> Choice #4: </Label>
                <input type="text" name="Choice4"/>
            </p>
            <p>
                <label> Choice #5: </Label>
                <input type="text" name="Choice5"/>
            </p>
            <p>
                <label> Correct Choice Number: </Label>
                <input type="number" name="correct_choice"/>
            </p>
            <p>
                <input type="submit" name="submit" value= "submit"/>
            </p>
        </div> 
    </main>
    <?php
    require_once 'include/footer.php';
?>