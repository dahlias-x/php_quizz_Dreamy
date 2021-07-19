<?php session_start();
require_once 'include/DB.php';


$_SESSION['score']=$_SESSION['score']+$_POST['choice'];
// echo $_SESSION ['score'];
$_SESSION['counter']++;



//check if its last
if($_SESSION['totalQ'] == $_SESSION['counter']+1){
    header("Location:final.php");
    exit();
} else {
    header('Location:question.php');
}


// echo "<pre>";
// var_dump ($_SESSION);
// echo "</pre>"
// ;echo "<pre>";
// var_dump ($_POST);
// echo "</pre>";