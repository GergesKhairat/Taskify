<?php
require_once '../inc/conn.php';
require_once '../inc/functions.php';
require_login();
session_destroy();
redirect("login.php");
