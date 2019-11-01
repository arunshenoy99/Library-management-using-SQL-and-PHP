<?php 
session_start();
if(!isset($_SESSION["q"])){
	header("Location:LOGINLIB.html");
}
if(isset($_GET["username"])&&($_SESSION["q"])==$_GET["username"]){
$dbname="library";
	$root="root";
	$pass="panakkal";
	$host="localhost";
	$conn=new mysqli($host,$root,$pass,$dbname);
	if($conn->connect_error){
		die( $conn->connect_error);
	}
$username=$_GET["username"];
$sql="SELECT * FROM studentlogininfo WHERE  username='".$username."'";
				$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$username=$row["username"];
				$nickname=$row["nickname"];
			}
		}
	}
	else{
		header("Location:LOGINLIB.html");
	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>WELCOME <?php echo $nickname?></title>
	<link rel="stylesheet" type="text/css" href="LOGSLIB.css">
</head>
<body>
	<div id="navbar">
		<a href=<?php echo "LOGSLIB.php?username=".$username;  ?>>MY BOOKS</a>
		<a href="#">MY ACCOUNT</a>
		<a href="CHECKBOOKS.php">CHECK BOOKS</a>
		<a href="LOGINLIB.html" style="float: right;">LOGOUT</a>
	</div>
	<div id="issues">
		<table>
			<tr>
				<th>BOOK ID</th>
				<th>BOOK NAME</th>
				<th>ISSUED DATE</th>
				<th>RETURN DATE</th>
			</tr>
			<?php 
			$sql="SELECT * FROM issues WHERE username='".$username."'";
		$res=$conn->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_assoc()){
				$bid=$row["bid"];
				$bname=$row["bname"];
				$idate=$row["idate"];
				$rdate=$row["rdate"];
				echo "<tr><td>".$bid."</td><td>".$bname."</td><td>".$idate."</td><td>".$rdate."</td></tr>";
			}
		}
		else{
			echo "<tr><td>NONE</td><td>NONE</td><td>NONE</td><td>NONE</td>";
		}
			 ?>
		</table>
		 

	</div>
</body>
</html>