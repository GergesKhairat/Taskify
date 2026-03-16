<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';
require_login();
if (isset($_POST['submit']) && isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $task_id = $_GET['id'];
    $query = "select * from tasks where id=$task_id and user_id=$user_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $query = "delete from tasks where id=$task_id and user_id=$user_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['success'] = "Task deleted successfully";
            redirect("index.php");
        } else {
            $_SESSION['errors'] = ['error while deleting    '];
            redirect("index.php");
        }
    } else {
        $_SESSION['errors'] = ['no task to delete'];
        redirect("index.php");
    }
} else {
    redirect("../errors/404.php");
}
