<?php
try {
    $conn = new PDO("mysql:host=localhost;dbname=university;character=utf8","localTest","Your password");
} catch (\Throwable $th) {
    echo $th->getMessage();
}
?>
