<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';
require_login();
if (isset($_POST['submit']) && isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));
    //validation
    $errors = [];
    if (empty($title)) {
        $errors[] = "title required";
    }
    if (empty($description)) {
        $errors[] = "description required";
    }
    if (empty($errors)) {
        $query = "select * from tasks where id=$task_id and user_id=$user_id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $query = "update tasks set title='$title',description='$description',updated_at=now() where id=$task_id and user_id=$user_id";
            $result = mysqli_query($conn, $query);
            if ($result) {
                $_SESSION['success'] = "task updated successfully";
                redirect("index.php");
            } else {
                $_SESSION['errors'] = ['error while updating'];
                redirect("edit.php?id=$task_id");
            }
        } else {
            $_SESSION['errors'] = ['error while updating'];
            redirect("edit.php?id=$task_id");
        }
    } else {
        $_SESSION['errors'] = $errors;
        redirect("edit.php?id=$task_id");
    }
} else {
    redirect("../errors/404.php");
}
