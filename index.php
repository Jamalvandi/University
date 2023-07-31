<?PHP
session_start();
session_destroy();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page </title>
</head>
<body>
    <center>
        <!-- Inport hedder -->
        <?php include 'Templates/homeHeader.php';?>
        
        <h1>Wellcome Users</h1><hr>
        <h3>Choose your role in header  </h3><br><hr>

        <!-- inport footer -->
        <?php include 'Templates/footer.php';?>

    </center>
</body>
</html>