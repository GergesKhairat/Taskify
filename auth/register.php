<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-3">Create account</h3>
                <?php session_start();
                require_once '../errors/errors_success.php';
                ?>


                <form action="handle_register.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control" name="name" value="<?php if (isset($_SESSION['name'])) echo $_SESSION['name']; ?>" placeholder="Enter Name" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" name="email" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>" placeholder="email@example.com" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control" name="password" placeholder="Enter Password" type="password" />
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100">Register</button>
                </form>

                <p class="mt-3 mb-0">
                    Already have account? <a href="login.php">Login</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>