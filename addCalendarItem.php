<?php
session_start();
//luodaan yhteys tietokantaan
$connectstr_dbhost = '';
$connectstr_dbname = 'localdb';
$connectstr_dbusername = '';
$connectstr_dbpassword = '';

foreach ($_SERVER as $key => $value) {
if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) {
continue;
}

$connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
$connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
$connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
}


$conn = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);

$eventDate = $_POST["eventDate"];
$startTime = $_POST["startTime"];
$endTime = $_POST["endTime"];
$description = $_POST["description"];
$userID = $_SESSION["userID"];

$sql = "INSERT INTO `calendaritem`(`eventDate`, `startTime`, `endTime`, `description`, `userID`)
        VALUES ('$eventDate', '$startTime', '$endTime', '$description', '$userID')";


$conn->query($sql);



header("Location: https://1701560.azurewebsites.net/profile.php");





?>
