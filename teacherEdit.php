<?php
    include "Connection/connection.php";
    session_start();
    $thId =$_SESSION['id'];
    $thName =$thEmail ="" ;
    $error = array('thName' => '' , 'email' => '');
     
     // Get the DB information
     $sql = "SELECT * FROM teacher WHERE id = $thId";
     $getUser = $conn->query($sql);
     $getUser->execute();
     $user = $getUser->fetch(PDO::FETCH_ASSOC);
    // Edit the user information
    if (isset($_POST['submit'])) {
        $thName = $_POST['thName'];
        $thEmail = $_POST['email'];
        // validate thName 
        if (empty($thName)) {
            $error['thName'] = 'Please enter a thName';
        }else {
            if (preg_match('/^[a-zA-z1-9]$/',$thName) && strlen($thName)> 3) {
                $error['thName'] = 'Please enter a valid thName';
            }
        }
        // Email validation
        if (empty($thEmail)) {
            $error['email'] = 'Please enter an email address';
        }if(!filter_var(FILTER_VALIDATE_EMAIL)){
            $error['email'] = 'Please enter a valid email address';
        }
        // Update the user information
        if (!array_filter($error)) {
            $thName = htmlspecialchars($_POST['thName']);
            $thEmail = htmlspecialchars($_POST['email']);
            $sql = "UPDATE teacher SET thName='$thName' , thEmail = '$thEmail' WHERE id = $thId";
            $upDate = $conn->query($sql);
            if ($upDate) {
                $getUsers = $conn->query("SELECT * FROM teacher WHERE thId = '$thId'");
                $getUsers->execute();
                $user = $getUsers->fetch(PDO::FETCH_ASSOC);
                $_SESSION['thId'] = $user['thId'];
                header("Location:teacher.php");
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
            <form action="teacherEdit.php" method="POST">
                <label for="thName">Teacher's Name :</label>
                <input type="text" name="thName" value="<?php echo htmlspecialchars($user['thName']) ?>">
                <div class="red-text"><?php echo $error['thName']; ?></div>
                <label for="email">Email :</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['thEmail']) ?>">
                <div class="red-text"><?php echo $error['email']; ?></div>
                <input type="hidden" name="idEdit" value="<?php echo $user['id'];?>" >
                <input type="submit" value="edit" name="submit" class="btn brand z-depth-0">
            </form>
	</div>
    <?php include 'Templates/footer.php'; ?>    
</body>
</html>