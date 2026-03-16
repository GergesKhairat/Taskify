<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';
require_login();
if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    htmlspecialchars(trim(extract($_POST)));
    $errors = [];
    if (empty($title)) {
        $errors[] = "title required";
    }
    if (empty($description)) {
        $errors[] = "description required";
    }
    if (empty($errors)) {
        $query = "insert into tasks(`title`,`description`,`user_id`) values ('$title','$description',$user_id)";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['success'] = "Task Added successfully";
            redirect('index.php');
        } else {
            $_SESSION['errors'] = ['error while creating the task'];
            redirect('index.php');
        }
    } else {
        $_SESSION['errors'] = $errors;
        redirect('index.php');
    }
} else {
    redirect('../errors/404.php');
}
