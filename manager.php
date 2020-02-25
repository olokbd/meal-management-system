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
    <?php
	if(isset($_GET['action'])){
	$action=$_GET['action'];
	}else{
		$action='main';
	}
	if($action=='main'){
        echo "<div class='bazar'>";
        echo'<h1>Update Bazar</h1>';
        echo'<p><big>Tip: </big>Update BazarList Everyday.</br></br>To Update BazarList<br><br><a href="updatebazar.php">Click Here</a></p></div><br>';
        echo "<div class='bazar'>";
        echo'<h1>Manage Members</h1>';
        echo'<p><big>Tip: </big>Add or Remove Member here.</br></br>To Add or Remove Member<br><br><a href="addmember.php">Click Here</a></p></div><br>';
        echo "<div class='bazar'>";
        echo "<h1>Update Member's Data</h1>";
        echo'<p><big>Tip: </big>Update Meals & Given amount of each Member Everyday.</br></br>To Update Meals & Given Amount<br><br><a href="updatemeal.php">Click Here</a></p></div><br>';'<br>'.'<br>'.'<br><br>';
        echo "<a href='manager.php?action=logout' style='float: right; font-size: 20px; text-decoration: none; border: 2px solid black; border-radius: 10px; padding: 3px; color: white; background-color: black;'>Log Out</a>"."<br><br>";
    }elseif($action=='logout'){
	    session_unset();
	    session_destroy();
	    echo'<center><h1>LogOut</h1>You Have Successfully Logged Out ! :)</center>'.'<br>'.'<br>';
	}
	
	?>
    </div>
</body>
</html>