<?php 
require_once("includes/config.php");
require_once("includes/classes/account.php");
require_once("includes/classes/constants.php");
require_once("includes/classes/formSanitizer.php");

$account = new Account($con);

if(isset($_POST["submitButton"])){
    $firstName = formSanitizer::sanitizeFormString($_POST['firstName']);
    $lastName = formSanitizer::sanitizeFormString($_POST['lastName']);

    $username = formSanitizer::sanitizeFormUsername($_POST['username']);

    $email = formSanitizer::sanitizeFormEmail($_POST['email']);
    $email2 = formSanitizer::sanitizeFormEmail($_POST['email2']);

    $password = formSanitizer::sanitizeFormPassword($_POST['password']);
    $password2 = formSanitizer::sanitizeFormPassword($_POST['password2']);

    $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign In | VideoTube</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 

</head>
<body>

    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="assets/images/icons/VideoTubeLogo.png" title="logo" alt="Site logo">
                <h3>Registrate</h3>
                <span>para continuar en VideoTube</span>
            </div>
            <div class="loginForm">
                <form action="signUp.php" method="POST">
                    
                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="Primer nombre" autocomplete="off" require>

                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Segundo nombre" autocomplete="off" require>

                    <?php echo $account->getError(Constants::$usernameCharacters); ?>
                    <?php echo $account->getError(Constants::$usernameTaken); ?>
                    <input type="text" name="username" placeholder="Usuario" autocomplete="off" require>

                    <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <input type="email" name="email" placeholder="Correo electrónico" autocomplete="off" require>
                    <input type="email" name="email2" placeholder="Confirmar correo electrónico" autocomplete="off" require>

                    <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                    <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                    <?php echo $account->getError(Constants::$passwordLength); ?>
                    <input type="password" name="password" placeholder="Contraseña" autocomplete="off" require>
                    <input type="password" name="password2" placeholder="Confirmar contraseña" autocomplete="off" require>

                    <input type="submit" name="submitButton" value="Crear">
                </form>
            </div>
            <a class="signInMessage" href="signIn.php">Ya tienes una cuenta? Ingresa aquí!</a>
        </div>
    </div>

</body>
</html>