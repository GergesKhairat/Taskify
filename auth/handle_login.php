<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';
if (isset($_POST['submit'])) {
    //catch
    htmlspecialchars(trim(extract($_POST)));
    //validation
    $errors = [];
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
        $email = strtolower($email);
        $query = "select * from users where email='$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $old_password = $user['password'];
            if (password_verify($password, $old_password)) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['success'] = "login success, welcome, " . $user['name'];
                redirect('../tasks/index.php');
            } else {
                $_SESSION['errors'] = ['Email or Password are incorrect'];
                redirect("login.php");
            }
        } else {
            $_SESSION['errors'] = ['Email or Password are incorrect'];
            redirect("login.php");
        }
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['errors'] = $errors;
        redirect("login.php");
    }
} else {
    $_SESSION['errors'] = ['please login Here'];
    redirect('login.php');
}
