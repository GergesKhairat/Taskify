<?php
function redirect($path)
{
    header("location:" . $path);
}


function require_login()
{
    if (!isset($_SESSION['user_id'])) {
        redirect("../auth/login.php");
    }
}
