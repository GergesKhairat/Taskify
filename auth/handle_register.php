<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';
if (isset($_POST['submit'])) {
    //catch
    htmlspecialchars(trim(extract($_POST)));
    //validation
    $errors = [];
    if (empty($name)) {
        $errors[] = "name is required";
    } elseif (is_numeric($name)) {
        $errors[] = "name must be string";
    }
    if (empty($email)) {
        $errors[] = "email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid";
    }
    if (empty($password)) {
        $errors[] = "password is required";
    } elseif (strlen($password) < 7) {
        $errors[] = "password must be 7 or more characters";
    }
    if (empty($errors)) {
        //check if the email already exist
        $query = "select * from users where email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['errors'] = ['Email Already Exist'];
            redirect("register.php");
        }
        $email = strtolower($email);
        $password = password_hash($password, PASSWORD_DEFAULT);
        //inserting the new user into the Database
        $query = "insert into users(`name`,`email`,`password`) values ('$name','$email','$password')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['success'] = "User registered successfully, Please Login";
            redirect("login.php");
        } else {
            $_SESSION['errors'] = ['error while Registering'];
        }
    } else {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['errors'] = $errors;
        redirect("register.php");
    }
} else {
    $_SESSION['errors'] = ['please register Here'];
    redirect('register.php');
}
