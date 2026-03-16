<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';
require_login();
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $query = "select * from tasks where id=$task_id and user_id=$user_id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $task = mysqli_fetch_assoc($result);
    } else {
        $_SESSION['errors'] = ["task not founded"];
        redirect("index.php");
    }
} else {
    $_SESSION['errors'] = ["no id founded"];
    redirect("index.php");
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <div class="card shadow-sm">

            <div class="card-body p-4">
                <h3 class="mb-3">Edit Task</h3>
                <?php
                require_once '../errors/errors_success.php';
                ?>
                <form action="update.php?id=<?php echo $task['id'] ?>" method="post">
                    <div class="mb-3">
                        <label class="form-label"></label>
                        <input class="form-control" name="title" value="<?= $task['title'] ?>" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input class="form-control" name="description" value="<?php echo $task['description'] ?>" />
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    <a class="btn btn-light" href="index.php">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>