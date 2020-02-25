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
<!-- MealRate -->
<?php
$messid=$_SESSION['messid'];
$sql="SELECT sum(amount) as baz FROM bazar WHERE messid=$messid";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)){ 
    $x=$row['baz'];
}
$sql="SELECT sum(meals) as mea FROM members WHERE messid=$messid";
$sql1="SELECT meals FROM members WHERE messid=$messid";
$query=mysqli_query($conn, $sql1);
$rows=mysqli_num_rows($query);
if ($rows!==0) {
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){ 
        $y=$row['mea'];
    }
    $rate=$x / $y;
}else{
    $rate='0';
}
?>
<!-- bazar -->
<?php
$sql="SELECT sum(amount) as total FROM bazar WHERE messid=$messid";
$sql1="SELECT amount FROM bazar WHERE messid=$messid";
$query=mysqli_query($conn, $sql1);
$rows=mysqli_num_rows($query);
if ($rows!==0) {
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){ 
        $bazar = $row['total'];
    }
}else{
    $bazar='0';
}
?>
<!-- Meal -->
<?php
$sql="SELECT sum(meals) as total FROM members WHERE messid=$messid";
$sql1="SELECT meals FROM members WHERE messid=$messid";
$query=mysqli_query($conn, $sql1);
$rows=mysqli_num_rows($query);
$result = mysqli_query($conn, $sql);
if ($rows!==0) {
    while ($row = mysqli_fetch_assoc($result)){
        $meal = $row['total'];
    }
}else{
    $meal='0';
}
?>
<!-- Bank -->
<?php
$sql="SELECT sum(given) as total FROM members WHERE messid=$messid";
$sql1="SELECT given FROM members WHERE messid=$messid";
$query=mysqli_query($conn, $sql1);
$rows=mysqli_num_rows($query);
$result = mysqli_query($conn, $sql);
if ($rows!==0) {
    while ($row = mysqli_fetch_assoc($result)){
        $bank = $row['total'];
    }
}else{
    $bank='0';
}
?>
<body>
    <div class="navbar">
	    <ul>
		    <li><a class="active" href="#">Home</a></li>
		    <li><a href="contact.php">Contact Us</a></li>
            <li><a href="#">Tools</a></li>
            <li style="float:right"><a href="manager.php">Dashboard</a></li>
        </ul>
    </div></br>
    <div class="bazar">
    	<h1>Bazar List</h1><br>
    	<p><big>Tip: </big>Update BazarList everyday.<br><b><i><big>Total Bazar: <?php echo $bazar; ?> TK</big></i></b></br></br>
    	To view bazar details for the entire month<br><br>
        <a href="bazar.php">Click Here</a> </p>
    </div><br>
    <div class="bazar">
    	<h1>Bank</h1><br>
    	<p><big>Tip: </big>Member's Given amount are Stored in this Bank.<br><b><i><big>Total Collected: <?php echo $bank; ?> TK</big></i></b></br></br>
        To view Bank details for the entire month<br><br>
        <a href="bank.php">Click Here</a> </p>
    </div><br>
    <div class="bazar">
    	<h1>Meal Counter</h1><br>
    	<p><big>Tip: </big>Update Meals Everyday.<br><b><i><big>Total Meal: <?php echo $meal; ?></big></i></b></br></br>
        To view Meal details for individuals<br><br>
        <a href="meal.php">Click Here</a> </p>
    </div><br>
    <div class="bazar">
    	<h1>Meal Rate</h1><br>
    	<p><big>Tip: </big>MealRate Generates Automatically!<br><b><i><big><?php echo "<b><i>"; echo "Meal Rate: ".round($rate, 2);echo " TK"."</i></b>"."<br>"; ?></big></i></b></br>
    </div><br>
    <div class="bazar">
    	<h1>Individual Cost</h1><br>
    	<p><big>Tip: </big>You can find whole month's calculation here</br>
        To view individual calculation for the entire month<br><br>
        <a href="cost.php">Click Here</a> </p>
    </div><br>
</body>
</html>