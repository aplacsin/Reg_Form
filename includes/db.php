<?php

require_once "config.php";

?>

<?php

try {
$connection = new PDO("mysql:host=$server;dbname=$name;charset=utf8", $username, $password); 


/* Create DB and TABLE */

$createdb = "CREATE DATABASE userdb";

$createtable = "CREATE TABLE `userdb`.`userstable` ( 
    `id` INT NOT NULL AUTO_INCREMENT , 
    `username` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `password` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    `email` VARCHAR(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
    PRIMARY KEY (`id`)
    ) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_unicode_ci;";

$connection->exec($createdb); 
$query = $connection->prepare($createtable);
$connection->exec($createtable);


}
catch(Exception $connection) {
    $messageError = 'Не удалось подключиться к базе данных!';     
}


?>