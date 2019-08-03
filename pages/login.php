<?php

require_once "../includes/db.php";

?>

<?php
session_start();
?>

<?php

$message      = $user_username = "";
$messageError = "";

if (isset($_SESSION["session_username"])) {
    /* Session is set */
    header("Location: intropage.php");
}

if (isset($_POST["login"])) {
    $user_username = trim($_POST['username']);
    $user_password = $_POST['password'];
    
    
    if (!empty($user_username) && !empty($user_password)) {
        
        /* Work BD */
        $sql   = "SELECT `id`, `username` FROM `userstable` WHERE username = '$user_username' AND password = '$user_password'";
        $query = $connection->prepare($sql);
        $query->execute(array(
            $user_username,
            $user_password
        ));
        if ($query->rowCount() == 1) {
            $_SESSION['session_username'] = $user_username;
            header("Location: intropage.php");
        } else {
            $messageError = 'Вы должны ввести правильно имя пользователя или пароль';
        }
    } else {
        $messageError = 'Вы должны заполнить все поля правильно!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Вход</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div class="wrapper-form form-login">
        <div id="login">
            <div class="wrapper-menu-text">
                <a href="../index.php" class="main-page">Главная страница</a>
            </div>
            <div class="title-text">
                <h1>Вход</h1>
            </div>
            <form action="" id="loginform" method="post" name="loginform">
                <p><label for="user_login">Логин<br>
                        <input class="input" id="username" name="username" size="20" type="text"
                            placeholder="Введите Логин" value="<?php echo $user_username;?>"></label></p>
                <p><label for="user_pass">Пароль<br>
                        <input class="input" id="password" name="password" size="20" type="password"
                            placeholder="Введите Пароль" value=""></label>
                </p>
                <p><span class="error"><?php echo $messageError;?></span></p>
                <p class="submit"><input class="button" name="login" type="submit" value="Войти"></p>
                <p class="login-text">Еще не зарегистрированы?<br><a href="signup.php">Регистрация</a>.</p>
            </form>
        </div>
    </div>
</body>

</html>