<?php 
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$bid=intval($_POST["bid"]);
	$bname=$_POST["bname"];
	$quantity=intval($_POST["quantity"]);
	$servername='localhost';
$username='root';
$password='panakkal';
$dbname="library";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
	die("connection failed");
}
$sql="INSERT INTO books(bid,bname,quantity) VALUES (".$bid.",'".$bname."',".$quantity.");";
if($conn->query($sql)===TRUE){
	echo $bid." sucessfully added";
}
else{
	echo "fail";
}
}

 ?>