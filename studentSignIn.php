<?php
include 'Connection/connection.php';
session_start();
$student= $email= $password= null;
$errors = array('id'=>'', 'password'=>'');                               
if (isset($_POST['submit'])) {
    // id Condition
    if (empty($_POST['id'])) {
        $errors['id'] = 'Please enter a StudentID';
    }
    if (preg_match("/[0-9]/i" , $_POST['id'])) {
        $student = htmlspecialchars($_POST['id']);
    }
    // Password Condition
    if (empty($_POST['password'])) {
        $errors['password'] = "Please enter a password";
    }
    if ((strlen($_POST['password'])<4) || (preg_match("/[A-Z] [a-z] [0-9]/i" , $_POST['password']))) {
        $errors['password'] ="Please enter a password more than 4 characters with alphabetic characters and digits";
    }
    if (!array_filter($errors)) {
        $password =md5(htmlspecialchars($_POST['password']));
        $student = htmlspecialchars($_POST['id']);
        $sql = "SELECT * FROM Student WHERE $student = stId";
        $get = $conn->query($sql);
        $get->execute();
        $user = $get->fetch(PDO::FETCH_ASSOC);
        if ($user['password'] == $password) {
            $_SESSION["id"] = $user['id'];
            header("Location:student.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student </title>
</head>
<body>
    <center>
        <!-- Inport hedder -->
        <?php include 'Templates/header.php';?>
        <!-- inputs -->
        <h3>Student informtion</h3>
        <form action="StudentSignIn.php" method="post" class="white">
            <input type="number" name="id">
            <label for="id">Student ID</label>
            <div class="red-text"><?php echo $errors['id']?></div>
            <input type="password" name="password">
            <label for="password">Password</label>
            <div class="red-text"><?php echo $errors['password']?></div>
            <br><br>
            <input type="submit" value="Sign In" name="submit" class="center btn brand z-deth-0">
        </form>
        <!-- inport footer -->
        <?php include 'Templates/footer.php';?>

    </center>
</body>
</html>