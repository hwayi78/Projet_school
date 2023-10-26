<?php
require('config.php');
$query2= $pdo->prepare("SELECT*FROM personne WHERE email = ?");
$query2->execute([$_POST['email']]);
$users=$query2->fetch();


// echo var_dump($users);
$mdp= $_POST['psw'];

if ($users && ($mdp == $users['password']) && ($mdp != '')){
    // echo 'ok';
    session_start();
    $_SESSION['email']=$users['email'];
    header("location:./dashboard.php");
}
else{
    // echo 'email ou mdp incorrect';
    header("location:./loginprojet.html");
}
// require('config.php');
?>

