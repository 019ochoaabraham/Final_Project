<html>
<head>
<title>Page Title</title>
</head>
<body>
<?php
$host = 'localhost'; // or your host name
$dbname = 'attendance_project_database'; // your database name
$username = 'root'; // your database username
$password = 'Chelseas#10'; // your database password
$con = new mysqli($host,$username,$password,$dbname);
if(mysqli_connect_errno()){
    echo "Failed to connect!";
    exit();
}
$student_id=$_POST["userid"];

$allattend = "SELECT * FROM `attendance` WHERE student_id='$student_id'";
$result = $con->query($allattend);
if($result->num_rows>0){
	while($row = $result->fetch_assoc()){
		if($row["if_attended"] == 1){
			echo"Course Number: ".$row["course_number"]." Attended: Yes   Date:".$row['date']."<br><br>";
		}else{
			echo"Course Number: ".$row["course_number"]." Attended: No   Date:".$row['date']."<br><br>";
		}
	}
	echo"<br>Classes you missed:";
	$allattend = "SELECT * FROM `attendance` WHERE student_id='$student_id' AND if_attended=0";
	$result = $con->query($allattend);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){
			echo"<br>Course Number: ".$row["course_number"]." Date:".$row['date'];
			
		}
	}
		echo "<br><br>";
		echo '<form action= "./student_homepage.php" method = "post">';
		echo '<input type="hidden" name="userid" value=' . $student_id . '>';
		echo '<input type="submit" value="goto homepage">';
		echo "</form>";
	
}
else{
	echo "<h1>Error!</h1>";
	echo "no user found";
}

?>

</body>
</html>