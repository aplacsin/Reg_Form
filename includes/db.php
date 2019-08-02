<?php

require_once "config.php";

?>

<?php

try {
$connection = new PDO("mysql:host=$server;dbname=$name;charset=utf8", $username, $password); 

}
catch(Exception $connection) {
    $messageError = 'Не удалось подключиться к базе данных!';    
}


?>

