<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
	session_start();
	$dbname="library";
	$root="root";
	$pass="panakkal";
	$host="localhost";
	$conn=new mysqli($host,$root,$pass,$dbname);
	if($conn->connect_error){
		die( $conn->connect_error);
	}
	$sql="INSERT INTO ip(IP) VALUES ('".$ipaddress."');";
	$conn->query($sql);
	$username=$_POST["username"];
	$password=$_POST["password"];
	if(strpos($username,"admin")!==false)
	{
		$sql="SELECT * FROM adminslogininfo WHERE  username='".$username."'";
				$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($password==$row["password"]){
					$_SESSION["q"]=$username;
					echo "LOGIN ADMIN SUCESSFUL";
				}
				else{
				echo "PLEASE CHECK PASSWORD";
			}

			}

		}
		else{
			echo 'PLEASE <a href="SIGNUPLIB.html" style="text-decoration:none;">SIGNUP</a>';
		}

	}
	else{
		$sql="SELECT * FROM studentlogininfo WHERE  username='".$username."'";
				$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				if($password==$row["password"]){

					$_SESSION["q"]=$username;
					echo "LOGIN SUCESSFUL";
				}
				else{
				echo "PLEASE CHECK PASSWORD";
			}

			}
		}
		else{
			echo 'PLEASE <a href="SIGNUPLIB.html" style="text-decoration:none;">SIGNUP</a>';
		}
	}
}


 ?>