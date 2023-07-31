<?php
include "Connection/connection.php";
session_start();
$id = $_SESSION['thId'];
$sql = "SELECT * FROM teacher WHERE id = '$id'";
$getuser = $conn->query($sql);
$getuser->execute();
$user = $getuser->fetch(PDO::FETCH_ASSOC);
if (isset($_POST['edit'])) {
    $_SESSION['id'] = $user['id'];
    header("Location:teacherEdit.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
</head>
<body>
    <?php include "Templates/teacherHeader.php";?>
    <div class="container center">
		<?php if($user){ ?>
			<h4><?php echo $user['thName']; ?></h4>
			<p>Created by : <?php echo $user['thEmail']; ?></p>
            <form action="teacher.php" method="POST">
                <input type="submit" name="edit" value="edit" class="btn brand z-depth-0">
            </form>
        <?php }else{ ?>
			<h5>No such user exists.</h5>
		<?php } ?>
	</div>

    <?php include "Templates/footer.php";?>
</body>
</html>


