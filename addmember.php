<?php
session_start();
if(!isset($_SESSION["loggedin2"]) || isset($_SESSION["loggedin2"]) !== true){
    header("location: login.php");
}else{
    include 'config.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name='viewport' content='width=device-width,initial-scale=1'>
    <title>Meal Management</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
	<div class="navbar">
	    <ul>
		    <li><a href="index.php">Home</a></li>
		    <li><a href="contact.php">Contact Us</a></li>
            <li><a href="#">Tools</a></li>
            <li style="float:right"><a class="active"  href="manager.php">Dashboard</a></li>
        </ul>
    </div></br>
    <div class="bazar">
    <?php
    $messid=$_SESSION['messid'];
    if(!isset($_GET['action'])){
    	header('Location: addmember.php?action=main');
	}
	if(isset($_GET['action'])){
	$action=$_GET['action'];
	}
    if($action=='main'){
		echo"<center><h1>Add Member</h1><form method='POST' action='addmember.php?action=bazar2'>";
		echo "Name: "."<input type='text' name='name'>".'<br><br>';
		echo "<input type='submit' name='submit'></form></center>".'<br>'.'<br></div><br>';
		echo"<center><div class='bazar'><h1>Remove Member</h1><form method='POST' action='addmember.php?action=remove2'>";
		echo "Name: "."<input type='text' name='name'>".'<br><br>';
		echo "<input type='submit' name='submit'></form></center>"."<br></div><br>";
	}elseif($action=='bazar2'){
		$name=mysqli_real_escape_string($conn, $_POST['name']);
        $sql="INSERT INTO members(name,messid) VALUES('$name','$messid')";
		if(mysqli_query($conn,$sql)){
	    echo "<center><big>New Member Added successfully!</center></big>"."<br>"."<br>";
		}else{
			echo "Error";
	    }

	}elseif ($action='remove2') {
		$name=mysqli_real_escape_string($conn, $_POST['name']);
        $sql="DELETE FROM members WHERE name='$name' AND messid='$messid'";
		if(mysqli_query($conn,$sql)){
	    echo "<center><big>Member Removed successfully!</center></big>"."<br>"."<br>";
		}else{
			echo "Error";
	    }
	}
	?>
    </div>
</body>
</html>