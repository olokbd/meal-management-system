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
    <div class="bazar">
    	<h1>Meal Details</h1>
    	<div class="table">
        <table>
	        <thead>
                <tr>
                    <th>MessId</th>
	                <th>Name</th>
	                <th>Meals</th>
	            </tr>`
	        </thead>
	        <tbody>
	        	<?php
                $messid=$_SESSION['messid'];
		        if($qry = mysqli_query($conn,"SELECT * FROM members WhERE messid='$messid'")){
		        	    while($show = mysqli_fetch_assoc($qry)){
				            echo "<tr>";
				            echo "<td>".$show['messid']."</td>";
					        echo "<td>".$show['name']."</td>";		
					        echo "<td>".$show['meals']."</td>";
						    echo "</tr>";
						}
					}
			    ?>
	        </tbody>
        </table>
        <?php
        $sql="SELECT sum(meals) as total FROM members WHERE messid=$messid";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){
            echo "<br>"."<b><i><center><big>";
            echo "Total Meal: ".$row['total'];
            echo "</i></b></center></big><br>";
        }
        ?>
</body>
</html>