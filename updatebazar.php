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
    $sql="SELECT * FROM bazar WHERE messid=$messid ORDER BY date ASC";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
    ?>
    <?php
    if(isset($_POST['Submit'])){
    	$count=count($_POST["date"]);
	    for($i=0;$i<$count;$i++){
	    	$sql1="UPDATE bazar SET name='" . $_POST['name'][$i] . "', amount='" . $_POST['amount'][$i] . "' WHERE id='" . $_POST['id'][$i] . "' AND messid=$messid";
	    	$result1=mysqli_query($conn,$sql1);
	    }
	    header("Refresh:0");
	}
	?>
	<h1>Update Bazar</h1>
	<form name="form1" method="post" action="">
		<table>
			<thead>
				<tr>
					<th></th>
	                <th>Date</th>
	                <th>Name</th>
	                <th>Amount</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php
	        	while($rows=mysqli_fetch_array($result)){
	        		?>
	        		<tr>
	        			<td>
	        				<input name="id[]" size="1" type="text" id="id" value="<?php echo $rows['id']; ?>" hidden>
	        			</td>
	        			<td>
	        				<input name="date[]" size="2" type="text" id="id" value="<?php echo $rows['date']; ?>" readonly>
	        			</td>
	        			<td>
	        				<input name="name[]" type="text" id="name" size="10" value="<?php echo $rows['name']; ?>">
	        			</td>
	        			<td>
	        			    <input name="amount[]" type="text" size="5" id="lastname" value="<?php echo $rows['amount']; ?>">
	        		    </td>
	        	    </tr>
	            <?php
	            }
	            ?>
	        </tbody>
	    </table>
	    <center>
        <input type="submit" name="Submit" value="Update"></center>
    </form><br>
    <center>Or Add New Bazar Row<br><br>
    	<?php
    	if(isset($_GET['action'])){
	        $action=$_GET['action'];
	    }else{
	    	$action='bazar';
	    }
    	if($action=='bazar'){
		    echo"<center><form method='POST' action='updatebazar.php?action=bazar2'>";
		    echo "Date: "."<input type='text' name='date' maxlength='2'>".'<br><br>';
		    echo "Name: "."<input type='text' name='name'>".'<br><br>';
		    echo "Amount: "."<input type='text' name='amount'>".'<br>';
		    echo "<input type='submit' name='submit' value='Add Raw'></center>".'<br>'.'<br>';
	    }elseif($action=='bazar2'){
		    $date=mysqli_real_escape_string($conn, $_POST['date']);
		    $name=mysqli_real_escape_string($conn, $_POST['name']);
		    $amount=mysqli_real_escape_string($conn, $_POST['amount']);
		    $messid=$_SESSION['messid'];
		    $sql="SELECT * FROM bazar WHERE date='$date' AND messid='$messid' ";
		    $query=mysqli_query($conn, $sql);
            $rows=mysqli_num_rows($query);
            if ($date>31 || $date==0) {
        	    echo "You've entered wrong date.";
            }else{
                if($rows==0){
                    $sql="INSERT INTO bazar(name,amount,date,messid) VALUES('$name','$amount','$date','$messid')";
		            if(mysqli_query($conn,$sql)){
			            echo "<center><big>Bazar list updated successfully!</center></big>"."<br>"."<br>";
			            	header("location: updatebazar.php");
		            }else{
			            echo "Error";
			        }
		        }else{
			        echo "Bazar already exists! You can update it from Update bazar menu.";
		        }
	        }
	    }
	?>
</div>
</body>
</html>