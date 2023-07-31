<?php
include 'Connection/connection.php';
session_start();
$teacher= $name =  $email= $password= $rePssword = null;
$errors = array('id'=>'','name'=>'','email'=>'', 'password'=>'','rePassword'=>'');

// Conditions to forward to other page
if (isset($_POST['submit'])) {

    // id Condition
    if (empty($_POST['id'])) {
        $errors['id'] = 'Please enter a teacherID';
    }
    if (preg_match("/[0-9]/i" , $_POST['id'])) {
        $teacher = htmlspecialchars($_POST['id']);
    }
    // Password Condition
    if (empty($_POST['name'])) {
        $errors['name'] = "Please enter teacher's name";
    }
    if ((strlen($_POST['password'])<4) || (preg_match("/[A-Z] [a-z] [0-9]/i" , $_POST['password']))) {
        $errors['password'] ="Please enter a password more than 4 characters with alphabetic characters and digits";
    }

    // email Condition
    if (empty($_POST['email'])) {
        $errors['email'] = "'Please enter a email";
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email is not valid";
    }

    // Password Condition
    if (empty($_POST['password'])) {
        $errors['password'] = "Please enter a password";
    }
    if ((strlen($_POST['password'])<4) || (preg_match("/[A-Z] [a-z] [0-9]/i" , $_POST['password']))) {
        $errors['password'] ="Please enter a password more than 4 characters with alphabetic characters and digits";
    }
    if ($_POST['rePassword']!=$_POST['password']) {
        $errors['rePassword'] = "'Please enter a password like 'password'";
    }
    if (!array_filter($errors)) {
        $password =  md5(htmlspecialchars($_POST['password']));
        $email = htmlspecialchars($_POST['email']);
        $name = htmlspecialchars($_POST['name']);

        try {
            $sql = "INSERT INTO teacher (id, thId , thName ,password, thEmail)VALUES ('$teacher','$teacher', '$name' ,'$password','$email')";
            $result = $conn->query($sql);
            if ($result) {
                $getUsers = $conn->query("SELECT * FROM teacher WHERE thId = '$teacher'");
                $getUsers->execute();
                $user = $getUsers->fetch(PDO::FETCH_ASSOC);
                $_SESSION['thId'] = $user['thId'];
                header("Location:teacher.php");
            }
        } catch (\Throwable $th) {
            echo "Error: " . $th->getMessage();
            
        }
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher sign up </title>
</head>
<body>
    <center>
        <!-- Inport hedder -->
        <?php include 'Templates/signUpHeader.php';?>
        <h3>Enter informtion</h3>
        <form action="teachersSignUp.php" method="POST" class="white">
            <input type="number" name="id">
            <label for="id">Teacher ID</label>
            <div class="red-text"><?php echo $errors["id"]; ?></div>
            <input type="text" name="name">
            <label for="name">Teacher Name</label>
            <div class="red-text"><?php echo $errors["name"]; ?></div>
            <input type="email" name="email">
            <label for="email">Email</label>
            <div class="red-text"><?php echo $errors["email"]; ?></div>
            <input type="password" name="password">
            <label for="password">Password</label>
            <div class="red-text"><?php echo $errors["password"]; ?></div>
            <input type="password" name="rePassword">
            <label for="password">RePassword</label>
            <div class="red-text"><?php echo $errors["rePassword"]; ?></div>  
            <br><br>
            <input type="submit" value="Sign Up" name="submit" class="center btn brand z-deth-0" style="margin-right: 30px;">
            <input type="reset" value="Reset" class="center btn brand z-deth-0" style="margin: 30;">
            
        </form>
        



        <!-- inport footer -->
        <?php include 'Templates/footer.php';?>

    </center>
</body>
</html>
