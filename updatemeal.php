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
    $sql="SELECT * FROM members WHERE messid=$messid";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
    ?>
    <?php
    if(isset($_POST['Submit'])){
    	$count=count($_POST["id"]);
	    for($i=0;$i<$count;$i++){
	    	$sql1="UPDATE members SET name='" . $_POST['name'][$i] . "', given='" . $_POST['amount'][$i] . "', meals='" . $_POST['meal'][$i] . "' WHERE id='" . $_POST['id'][$i] . "' AND messid=$messid";
	    	$result1=mysqli_query($conn,$sql1);
	    }
	    header("Refresh:0");
	}
	?>
	<h1>Update Meals</h1>
	<form name="form1" method="post" action="">
		<table>
			<thead>
				<tr>
	                <th></th>
	                <th>Name</th>
	                <th>Given</th>
	                <th>Meals</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        	while($rows=mysqli_fetch_array($result)){
	        		?>
	        		<tr>
	        			<td>
	        				<input name="id[]" size="2" type="text" id="id" value="<?php echo $rows['id']; ?>" hidden>
	        			</td>
	        			<td>
	        				<input name="name[]" type="text" id="name" size="6" value="<?php echo $rows['name']; ?>" readonly>
	        			</td>
	        			<td>
	        			    <input name="amount[]" type="text" size="5" id="lastname" value="<?php echo $rows['given']; ?>">
	        		    </td>
	        		    <td>
	        			    <input name="meal[]" size="5" type="text" id="email" value="<?php echo $rows['meals']; ?>">
	        		    </td>
	        	    </tr>
	            <?php
	            }
	            ?>
	        </tbody>
	    </table>
	    <center>
        <input type="submit" name="Submit" value="Submit"></center>
    </form><br>
</div>
</body>
</html>