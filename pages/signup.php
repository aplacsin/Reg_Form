<?php

require_once "../includes/db.php";


$nameError    = $emailError = $passwordError = "";
$username     = $password = $email = "";
$messageError = "";


if (isset($_POST["signup"])) {
    
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email    = trim($_POST['email']);
    
    
    if (!empty($_POST[$username]) && !empty($_POST[$password]) && !empty($_POST[$email])) {
        
        /* form validation */
        $emailError = "Все поля обязательны для заполнения!";
        
        /* Check username */
    } elseif (empty($_POST['username'])) {
        $nameError = "Поле должно быть заполнено";
    } elseif (!preg_match("/^[A-z0-9]{3,10}$/", $_POST['username'])) {
        $username  = $_POST['username'];
        $nameError = "Логин может содержать только латинские буквы и цифры, длиной от 3 до 10 символов";
        
        /* Check password */
    } elseif (empty($_POST['password'])) {
        $username      = $_POST['username'];
        $passwordError = "Поле должно быть заполнено";
    } elseif (!preg_match("/^[A-z0-9]{5,15}$/", $_POST['password'])) {
        $username      = $_POST['username'];
        $passwordError = "Пароль может содержать только латинские буквы и цифры, длиной от 5 до 15 символов";
        
        /* Check email */
    } elseif (empty($_POST['email'])) {
        $username   = $_POST['username'];
        $emailError = "Поле должно быть заполнено";
    } elseif (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
        $username   = $_POST['username'];
        $emailError = "Формат E-mail неправильный";
        

        /* Work BD */
    } else {        
        $sqlUsername   = "SELECT * FROM `userstable` WHERE username = '$username'";
        $sqlEmail      = "SELECT * FROM `userstable` WHERE email = '$email'";
        $queryUsername = $connection->prepare($sqlUsername);
        $queryEmail    = $connection->prepare($sqlEmail);
        $queryUsername->execute(array(
            $username
        ));
        $queryEmail->execute(array(
            $email
        ));
        if ($queryUsername->rowCount() == 0) {
            if ($queryEmail->rowCount() == 0) {
                $sql_query = "INSERT INTO `userstable`
                 (username,password,email)
                  VALUES('{$username}','{$password}', '${email}')";
                $res       = $connection->prepare($sql_query);
                $res->execute(array(
                    $sql_query
                ));
                if ($res) {
                    header("location: success_signup.php");
                } else {
                    $messageError = "Не удалось добавить информацию";
                }
            } else {
                $messageError = "Email уже существует. Попробуйте другой!";
            }
        } else {
            $messageError = "Логин уже существует. Попробуйте другой!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="wrapper-form form-login">
        <div id="signup">
            <div class="wrapper-menu-text">
                <a href="../index.php" class="main-page">Главная страница</a>
            </div>
            <div class="title-text">
                <h1>Регистрация</h1>
            </div>
            <form action="signup.php" id="signupform" method="post" name="signupform">
                <p><label for="user_pass">Логин<br>
                        <input class="input" id="username" name="username" size="20" type="text"
                            placeholder="Введите Логин" value="<?php echo $username; ?>"></label></p>
                <span class="error"><?php echo $nameError;?></span>
                <p><label for="user_pass">Пароль<br>
                        <input class="input" id="password" name="password" size="32" type="password"
                            placeholder="Введите Пароль" value=""></label>
                </p>
                <span class="error"><?php echo $passwordError;?></span>
                <p><label for="user_pass">E-mail<br>
                        <input class="input" id="email" name="email" size="32" type="email" placeholder="Введите E-mail"
                            value=""></label></p>
                <p><span class="error"><?php echo $emailError;?></span></p>
                <p><span class="error"><?php echo $messageError;?></span></p>
                <p class="submit"><input class="button" name="signup" type="submit" value="Зарегистрироваться"></p>
                <p class="signup-text">Уже зарегистрированы? <a href="login.php">Войти</a>.</p>
            </form>
        </div>
    </div>
</body>

</html>