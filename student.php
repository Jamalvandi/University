<?php
include "Connection/connection.php";
session_start();
$id = $_SESSION['id'];
$sql = "SELECT * FROM student WHERE id = '$id'";
$getuser = $conn->query($sql);
$getuser->execute();
$user = $getuser->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['edit'])) {
    $_SESSION['id'] = $user['id'];
    header("Location:studentEdit.php");
}
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student</title>
</head>
<body>
    <?php include "Templates/signUpHeader.php";?>
    <div class="container center">
		<?php if($user){ ?>
			<h4><?php echo $user['stName']; ?></h4>
			<p>Created by : <?php echo $user['stEmail']; ?></p>
            <form action="student.php" method="POST">
                <input type="submit" name="edit" value="edit" class="btn brand z-depth-0">
            </form>
        <?php }else{ ?>
			<h5>No such user exists.</h5>
		<?php } ?>
	</div>

    <?php include "Templates/footer.php";?>
</body>
</html>


