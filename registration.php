<?php
session_start();
if(isset($_SESSION["loggedin2"]) || isset($_SESSION["loggedin2"]) == true){
    header("location: index.php");
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
<body><br/>
	<div class='bazar'>
    <?php
    if(!isset($_GET['action'])){
	    header('Location: registration.php?action=main');
	}else if(isset($_GET['action'])){
	    $action=$_GET['action'];
	}
    if($action=='main'){
	echo"<h1>Registration Form</h1>";
    echo'<div class="rules">Allowed characters in username and password are a-z and 0-9'.'<br/>';
    echo'Username must contain at least 4 characters'.'<br/>';
    echo'Password must contain at least 5 characters'.'<br/>';
    echo'Username must not contain capitals'.'<br/></div><br><center>';
    echo'<div class="login-form"><form action="registration.php?action=usub" method="post">'.'Username'.'<br/>'.'<form action="registration.php?action=usub" method="post">'.'<input type="text" name="username" maxlength="20"/>'.'<br/>'.'<input type="submit" value="Next"/>'.'</form></div>'.'<br/>'.'<br/></center>';
    }elseif($action=='usub'){
	$username=$_POST['username'];
	if (!preg_match('/^[a-z0-9]+$/', $username)){ 
	    header('Location: registration.php?action=preg');
	}
    if(strlen($username)<4){
	header('Location: registration.php?action=strlen');
	}
    if(isset($_POST['username'])){
	    require 'config.php';
        $sql="select * from users where username= '$username' ";
        $result=mysqli_query($conn, $sql);
        $rows=mysqli_num_rows($result);
        if($rows==1){
	        echo "<h1>Registration Form</h1>".'<br>';
	        echo '<big>Username '.'<b>'.$username.'</b>'.' is not available!'.'<br></big>'.'<br>'.'<h3>'."<a href='registration.php'>Go Back</a>".'</h3>';
	    }elseif($rows==0){
	    	echo'<h1>Registration Form</h1>'.'<br><center>';
	    	echo"<form method='POST' action='registration.php?action=validation'>";
            echo "Username:<br>"."<input type='text' name='username' value='$username' readonly><br>";
            echo"<br>";
            echo "Password:<br>"."<input type='password' name='password1'><br>"."<br>"."Confirm Password:<br>"."<input type='password' name='password2'>"."<br>";
                echo"‌‌‌‌‌‌‌‍<input type='submit' value='Submit'></center>"."<br>"."<br>";
            }
        }
    }elseif($action=='validation'){
	    $username=mysqli_real_escape_string($conn, $_POST['username']);
	    $password1=mysqli_real_escape_string($conn, $_POST['password1']);
	    $password2=mysqli_real_escape_string($conn, $_POST['password2']);
	        if(empty($password1) || empty($password2)){
	        	header('Location: registration.php?action=passerror');
	        }if(strlen($password1)<5 || strlen($password2)<5){
	        	header('Location: registration.php?action=passstr');
	        }elseif($password1==$password2){
	        	require('config.php');
	        	$query="INSERT INTO users (username, password) VALUES ('$username', '$password1') ";
	        	if(mysqli_query($conn, $query)){
	        		header('Location: registration.php?action=success');
	        	}
	        }else{
	        	header('Location: registration.php?action=passerror');
	        }
	    }elseif($action=='strlen' ){
	    	echo'<h1>Error</h1>';
	    	echo 'Username must have at least 4 characters!'.'<br>'.'<br>'.'<h3>'.'<a href="registration.php">Go Back</a>'.'</h3>';
	    }elseif($action=='preg'){
	    	echo'<h1>Error</h1>';
	    	echo 'Username can only contain a-z(small letter) and 0-9.'.'<br>'.'<br>'.'<h3>'.'<a href="registration.php">Go Back</a>'.'</h3>';
	    }elseif($action=='passerror' ){
	    	echo'<h1>Error</h1>';
	    	echo 'Please input both Password carefully!'.'<br>'.'<br>'.'<h3>'.'<a href="registration.php">Go Back</a>'.'</h3>';
	    }elseif($action=='success'){
	    	echo'<h1>Registration Success</h1>'.'<br>';
	    	echo '<center>'.'Thanks For Joining Here  :)'.'<br><br>'.'<a href="index.php" style="font-size: 20px; text-decoration: none; border: 2px solid black; border-radius: 10px; padding: 3px; color: white; background-color: black;">Login</a>'.'</center>'.'<br>'.'<br>';
	    }elseif($action=='passstr'){
	    	echo'<h1>Error</h1>';
	    	echo 'Password must contain at least 5 Characters!'.'<br>'.'<br>'.'<h3>'.'<a href="registration.php">Go Back</a>'.'</h3>';
	    }
	?>
    </div>
</body>
</html>