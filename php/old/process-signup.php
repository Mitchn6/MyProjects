<?php

if (empty($_POST['firstname'])) {
    die('Name is required');
}
if (empty($_POST['lastname'])) {
    die('Last Name is required');
}

if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    die('Email is invalid');
}

if (strlen($_POST['password']) < 6) {
    die('Password must be at least 6 characters');
}
//match password and confimpassword
if ($_POST['password'] != $_POST['confirmpassword']) {
    die('Password and Confirmed Password must match');
}
//store password and confirmpassword in default hash format
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);



$mysql = require __DIR__ . '/database.php';

$sql = "INSERT INTO user (firstname, lastname, email, password_hash) 
VALUES (?, ?, ?, ?)";

$statement = $mysql->prepare($sql);



//display message
echo 'Account created successfully';

print_r($_POST);
var_dump($password_hash);
?>


//https://www.youtube.com/watch?v=5L9UhOnuos0 this is the video I am following
//Curretlty I am stuck on the process-signup.php page. I am getting the following error:
//Fatal error: Uncaught PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'lastname' in 'field list' in C:\Users\markm\OneDrive - Athlone Institute Of Technology\Desktop\Year3\Web Dev 3\XAMPP\htdocs\php\process-signup.php:37 Stack trace: #0 C:\Users\markm\OneDrive - Athlone Institute Of Technology\Desktop\Year3\Web Dev 3\XAMPP\htdocs\php\process-signup.php(37): PDOStatement->execute(Array) #1 {main} thrown in C:\Users\markm\OneDrive - Athlone Institute Of Technology\Desktop\Year3\Web Dev 3\XAMPP\htdocs\php\process-signup.php on line 37
//I am at around 14 minutes into the youtube video