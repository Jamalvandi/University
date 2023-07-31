<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=university;character=utf8","localTest","Reza071882");
} catch (\Throwable $th) {
    echo $th->getMessage();
}
?>