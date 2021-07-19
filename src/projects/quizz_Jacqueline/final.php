<?php session_start(); 
require_once 'include/DB.php';
require_once 'include/header.php';?>
    <main>
        <div class="container">
            <h2>You're Done!</h2>
            <p>Congrats! You have completed the test</p>
            <p>Final Score: <?php echo $_SESSION['score'];?></p>
            <a href="question.php" class="start">Take Again</a>
        </div>
    </main>
<?php
    require_once 'include/footer.php';
?>
<?php

unset ($_SESSION);
session_destroy();