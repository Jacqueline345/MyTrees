<?php
include('utils/functions.php');
$error_msg = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="jumbotron text-center">
                <h1 class="display-5">Login</h1>
                <p class="lead">User Login</p>
                <hr class="my-4">

                <div class="error text-center mb-3">
                    <?php
                    if ($error_msg) {
                        if ($error_msg == 'empty_fields') {
                            echo "<div class='alert alert-warning'>Por favor, completa todos los campos.</div>";
                        } elseif ($error_msg == 'login') {
                            echo "<div class='alert alert-danger'>Credenciales incorrectas. Intenta nuevamente.</div>";
                        }
                    }
                    ?>
                </div>

                <!-- Login form -->
                <form method="post" action="actions/login.php" class="p-4 border rounded shadow">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" class="form-control" type="text" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" class="form-control" type="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4">Login</button>
                <!-- Signup link -->
                <div class="text-center mt-3">
                    <a href="signup.php" class="nav-link active">Signup</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>