<?php
session_start();
if(isset($_SESSION["loggedin2"]) || isset($_SESSION["loggedin2"])== true){
    header("location: index.php"); 
}else{
	include'config.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name='viewport' content='width=device-width,initial-scale=1'>
    <title>OLOKBD</title>
    <link rel='stylesheet' type='text/css' href='style.css'>
</head>
<body>
</br>
    <div class="bazar">
    	<h1>Login</h1>
    	<center>
    	<div class="login-form">
            <form method='GET'>
                Username:<br><input type='text' name='username'><br>
                Password:<br><input type='password' name='password'><br>
                <input type='submit' value='Login'>
            </form><br/>
            <i>Don't Have an Account ?</i><br>
            <a href='registration.php'>Register</a><br><br><br>
        </div>
        </center>
        <?php
        if(isset($_GET['username']) && isset($_GET['password'])){
	        require 'config.php';
	        $username=mysqli_real_escape_string($conn, $_GET['username']);
	        $password=mysqli_real_escape_string($conn, $_GET['password']);
	        $sql="SELECT * FROM users WHERE username='$username' AND password='$password' ";
            $query=mysqli_query($conn, $sql);
            $rows=mysqli_num_rows($query);
            if($rows==1){
            	$show=mysqli_fetch_assoc($query);
            	$messid=$show['id'];
	            session_start();
	            $_SESSION['loggedin2']= true;
	            $_SESSION['username']=$username;
	            $_SESSION['messid']=$messid;
	            header('Location: index.php');
            }else{
	            echo"<br>"."<h3><center>"."Username or Password does not match !</h3></center>";
	        }
	    }
	    ?>
	</div>
</body>
</html>