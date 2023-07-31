<?php
include "Connection/connection.php";
session_start();
$id = $_SESSION['id'];
    $stName =$stEmail ="" ;
    $error = array('stName' => '' , 'email' => '');
     
     // Get the DB information
     $sql = "SELECT * FROM student WHERE id = $id";
     $getUser = $conn->query($sql);
     $getUser->execute();
     $user = $getUser->fetch(PDO::FETCH_ASSOC);
    // Edit the user information
    if (isset($_POST['submit'])) {
        $stName = $_POST['stName'];
        $stEmail = $_POST['email'];
        // validate stName 
        if (empty($stName)) {
            $error['stName'] = 'Please enter a stName';
        }else {
            if (preg_match('/^[a-zA-z1-9]$/',$stName) && strlen($stName)> 3) {
                $error['stName'] = 'Please enter a valid stName';
            }
        }
        // Email validation
        if (empty($stEmail)) {
            $error['email'] = 'Please enter an email address';
        }if(!filter_var(FILTER_VALIDATE_EMAIL)){
            $error['email'] = 'Please enter a valid email address';
        }
        // Update the user information
        if (!array_filter($error)) {
            $stName = htmlspecialchars($_POST['stName']);
            $stEmail = htmlspecialchars($_POST['email']);
            $sql = "UPDATE student SET stName='$stName' , stEmail = '$stEmail' WHERE id = $id";
            $upDate = $conn->query($sql);
            if ($upDate) {
                $getUsers = $conn->query("SELECT * FROM student WHERE id = '$id'");
                $getUsers->execute();
                $user = $getUsers->fetch(PDO::FETCH_ASSOC);
                $_SESSION['id'] = $user['id'];
                header("Location:student.php");
            }
        }
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<body>
<?php include 'Templates/header.php'; ?>
<div class="container center">
            <form action="studentEdit.php" method="POST">
                <label for="stName">Student's Name :</label>
                <input type="text" name="stName" value="<?php echo htmlspecialchars($user['stName']) ?>">
                <div class="red-text"><?php echo $error['stName']; ?></div>
                <label for="email">Email :</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['stEmail']) ?>">
                <div class="red-text"><?php echo $error['email']; ?></div>
                <input type="hidden" name="idEdit" value="<?php echo $user['id'];?>" >
                <input type="submit" value="edit" name="submit" class="btn brand z-depth-0">
            </form>
	</div>
    <?php include 'Templates/footer.php'; ?>    
</body>
</html>