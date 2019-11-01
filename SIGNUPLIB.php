<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$fname=$_POST["username"];
	$lname=$_POST["password"];
	$pass=$_POST["nickname"];
}
else{
	die("HA GOTCHA ILLEGAL ENTRY");
}
$servername='localhost';
$username='root';
$password='panakkal';
$dbname="library";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
	die("connection failed");
}
$sql1="SELECT * FROM studentlogininfo WHERE username='".$fname."'";
$res=$conn->query($sql1);
if($res->num_rows>0){
	die("USERNAME ALREADY EXISTS PLEASE CONTACT ADMIN OR LOGIN HERE <a href='LOGINLIB.html'>LOGIN</a>");
}
$sql2="INSERT INTO studentlogininfo(username,password,nickname) VALUES("."'".$fname."'".","."'".$lname."'".","."'".$pass."')";
if($conn->query($sql2)===TRUE){
	echo "lol";
}
else{
	echo "fail".$conn->error;
}

 ?>