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
            <li><a class="active" href="#">Tools</a></li>
            <li style="float:right"><a href="manager.php">Dashboard</a></li>
        </ul>
    </div></br>
    <?php 
    $messid=$_SESSION['messid'];
	$sql="SELECT sum(amount) as baz FROM bazar  WHERE messid=$messid";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){ 
        $x=$row['baz'];
    }
    $sql="SELECT sum(meals) as mea FROM members  WHERE messid=$messid";
    $sql1="SELECT meals FROM members WHERE messid=$messid";
    $query=mysqli_query($conn, $sql1);
    $rows=mysqli_num_rows($query);
    $result = mysqli_query($conn, $sql1);
    if ($rows!==0) {
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){ 
            $y=$row['mea'];
            $rate=$x / $y;
        }
    }else{
        $rate='0';
    }
    ?>
    <div class="bazar">
    	<h1>Individual cost</h1><br>
    	<div class="table">
            <table>
	            <thead>
                    <tr>
                        <th>Name</th>
	                    <th>Given</th>
	                    <th>Expense</th>
	                    <th>Final calc</th>
	                </tr>
	            </thead>
	            <tbody>
	            <?php 
		        if($qry = mysqli_query($conn,"SELECT * FROM members WHERE messid=$messid")){
			        while($show = mysqli_fetch_assoc($qry)){
				        echo "<tr>";
                        echo "<td>".$show['name']."</td>";			
                        echo "<td>";
				        $xy=$show['given'];
				        echo $xy."</td>";
                        echo "<td>";$munna=$show['meals'];
					    $cost=$munna*$rate;
					    echo round ($cost,0);
                        "</td>";
					    echo "<td>";
					    $final=$xy - $cost;
					    echo round ($final,0);			
                        echo "</tr>";
                    }
                }
	            ?>
	            </tbody>
            </table>
            <br>
        </div>
    </div>
</body>
</html>