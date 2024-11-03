<?php
include('utils/functions.php');
$country = getCountry();
$error_msg = isset($_GET['error']) ? $_GET(['error']) : '';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Registro </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="jumbotron">
        <h1 class="display-4"> Signup </h1>
        <p class="lead"> This is the signup process</p>
        <hr class="my-4">
    </div>
    <form method="post" action="actions/signup.php">
        <div class="error">
            <?php echo $error_msg; ?>
        </div>
        <div class="form-group">
            <label for="first-name"> First name </label>
            <input id="first-name" class="form-control" type="text" name="firstName">
        </div>
        <div class="form-group">
            <label for="last-name"> Last Name </label>
            <input id="last-name" class="form-control" type="text" name="lastName">
        </div>
        <div class="form-group">
            <label for="phone-number"> Phone number </label>
            <input id="phone-number" class="form-control" type="text" name="phoneNumber">
        </div>
        <div class="form-group">
            <label for="email"> Email </label>
            <input id="username" class="form-control" type="text" name="username">
        </div>
        <div class="form-group">
            <label for="address"> Address </label>
            <input id="address" class="form-control" type="text" name="address">
        </div>
        <div class="form-group">
            <label for="country"> Country </label>
            <select id="country" class="form-control" name="country">
                <?php
                foreach ($country as $id => $country) {
                    echo "<option value=\"$id\">$country</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="password"> Password </label>
            <input id="password" class="form-control" type="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary"> Sign up </button>
    </form>
</body>

</html>