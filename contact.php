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
		    <li><a class="active" href="contact.php">Contact Us</a></li>
            <li><a href="#">Tools</a></li>
            <li style="float:right"><a href="manager.php">Dashboard</a></li>
        </ul>
    </div></br>
    <div class="bazar">
        <?php
        $messid=$_SESSION['messid'];
        if(isset($_GET['action'])){
            $action=$_GET['action'];
        }else{
            $action='main';
        }
        if($action=='main'){
            echo"<center><h1>Contact Us</h1><br><p style='font-size: 20px;'>If You have any Complain/Suggestions please feel free to contact us</p><form method='POST' action='contact.php?action=bazar2'>";
            echo "Name: "."<input type='text' name='name'>".'<br><br>';
            echo "Email: "."<input type='text' name='email'>".'<br><br>';
            echo "Message: "."<input type='text' name='message'>".'<br><br>';
            echo "<input type='submit' name='submit'></form></center>".'<br>'.'<br></div><br>';
        }elseif($action=='bazar2'){
            $name=mysqli_real_escape_string($conn, $_POST['name']);
            $email=mysqli_real_escape_string($conn, $_POST['email']);
            $message=mysqli_real_escape_string($conn, $_POST['message']);
            $sql="INSERT INTO contacts(name, email, message, messid) VALUES('$name','$email', '$message', '$messid')";
            if(mysqli_query($conn,$sql)){
                echo "<center><big>Thanks for Contacting us!</center></big>"."<br>"."<br>";
            }else{
                echo "Error";
            }
        }
        ?>
    </div>
</body>  
</html>