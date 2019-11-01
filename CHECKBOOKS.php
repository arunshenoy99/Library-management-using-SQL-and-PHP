<?php 
session_start();
if(!isset($_SESSION["q"])){
	header("Location:LOGINLIB.html");
}
$dbname="library";
	$root="root";
	$pass="panakkal";
	$host="localhost";
	$conn=new mysqli($host,$root,$pass,$dbname);
	if($conn->connect_error){
		die( $conn->connect_error);
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>BOOKS</title>
 	<link rel="stylesheet" type="text/css" href="LOGSLIB.css">
 </head>
 <body>
 <div id="navbar">
		<a href=<?php echo "LOGSLIB.php?username=".$_SESSION["q"]; ?>>MY BOOKS</a>
		<a href="#">MY ACCOUNT</a>
		<a href="CHECKBOOKS.php">CHECK BOOKS</a>
		<a href="LOGINLIB.html" style="float: right;">LOGOUT</a>
	</div>
	<div id="issues">
		<table>
			<tr>
				<th>BOOK ID</th>
				<th>BOOK NAME</th>
				<th>QUANTITY</th>
			</tr>
			<?php 
			$sql="SELECT * FROM books";
		$res=$conn->query($sql);
		if($res->num_rows>0){
			while($row=$res->fetch_assoc()){
				$bid=$row["bid"];
				$bname=$row["bname"];
				$quan=$row["quantity"];
				echo "<tr><td>".$bid."</td><td>".$bname."</td><td>".$quan."</td></tr>";
			}
		}
		else{
			echo "<tr><td>NONE</td><td>NONE</td><td>NONE</td><td>NONE</td>";
		}
			 ?>
		</table>
 </body>
 </html>