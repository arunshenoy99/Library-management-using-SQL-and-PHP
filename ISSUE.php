<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$bid=$_POST["bid"];
	$usn=$_POST["username"];
	$idate=date("Y-m-d");
	$x=strtotime("+15 days");
	$rdate=date("Y-m-d",$x);
	$dbname="library";
	$root="root";
	$pass="panakkal";
	$host="localhost";
	$conn=new mysqli($host,$root,$pass,$dbname);
	if($conn->connect_error){
		die( $conn->connect_error);
	}
	$sql1="SELECT * FROM books WHERE bid=".$bid;
	$sql2="SELECT * FROM studentlogininfo WHERE username='".$usn."'";
	$result1=$conn->query($sql1);
	$result2=$conn->query($sql2);
	if($result1->num_rows>0){
		if($result2->num_rows>0){
			while($row=$result1->fetch_assoc()){
				$quantity=$row["quantity"];
				$bname=$row["bname"];
			}
			if (intval($quantity)==0){
				echo "NO BOOKS AVAILABLE CURRENTLY";
			}
			else{
				$quantity=intval($quantity);
				$quantity=$quantity-1;
				$sql3="INSERT INTO issues(bid,bname,idate,rdate,username) VALUES (".$bid.",'".$bname."','".$idate."','".$rdate."','".$usn."')";
				$sql4="UPDATE books SET quantity=".$quantity." WHERE bid=".$bid;
				if(($conn->query($sql3)&&$conn->query($sql4))==TRUE){
					echo "BOOK SUCESSFULLY ISSUED TO BE RETURNED BY ".$rdate;
				}
				else{
					echo "ERROR";
				}

			}

		}
		else{
			echo "PLEASE ASK THE STUDENT TO SIGNUP";
		}


	}
	else{
		echo "PLEASE CHECK THE BOOK ID";
	}
}
else{
	echo "PLEASE LOGIN HERE AGAIN <a href='LOGINLIB.html'>LOGIN</a>";
}


 ?>