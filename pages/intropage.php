<?php

session_start();

if(!isset($_SESSION["session_username"])):
header("location: login.php");
else:
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>

<body>
    <div id="welcome">
        <div class="title-text">
            <h2>Поздравляем, успешная авторизация!, <span
                    class="text-session"><?php echo $_SESSION['session_username'];?></span>.</h2>
        </div>
        <p class="intro-text"><a href="logout.php">Выйти</a> из системы</p>
    </div>
</body>

</html>

<?php endif; ?>