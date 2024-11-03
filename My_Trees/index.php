<?php
include('utils/functions.php');
$error_msg = isset($_GET['error']) ? $_GET['error'] : '';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registro </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 class="display-4">Login</h1>
            <p class="lead">User Login</p>
            <hr class="my-4">
        </div>
        <div class="error">
            <?php 
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'empty_fields') {
                    echo "Por favor, completa todos los campos.";
                } elseif ($_GET['error'] == 'login') {
                    echo "Credenciales incorrectas. Intenta nuevamente.";
                }
            }
            ?>
        </div>
        <form method="post" action="actions/login.php">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" class="form-control" type="text" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" class="form-control" type="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary"> Login </button>
        </form>
    </div>
    <a href="signup.php" class="nav-link active"> Signup </a>

</body>

</html>
