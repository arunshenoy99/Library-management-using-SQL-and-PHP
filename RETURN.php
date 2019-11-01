<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$bid=$_POST["bid"];
	$usn=$_POST["username"];
	$dbname="library";
	$root="root";
	$pass="panakkal";
	$host="localhost";
	$conn=new mysqli($host,$root,$pass,$dbname);
	if($conn->connect_error){
		die( $conn->connect_error);
	}
	$sql="SELECT * FROM issues WHERE username='".$usn."' AND bid=".$bid;
	$res=$conn->query($sql);
	if($res->num_rows>0){
		while($row=$res->fetch_assoc()){
			$rdate=$row["rdate"];
		}

	}
	else{
		die( "NO RECORD FOUND");
	}
	$tdate=date("Y-m-d",time());
	$rdate=date("Y-m-d",strtotime($rdate));
	$tdate=date_create($tdate);
	$rdate=date_create($rdate);
	$diff=date_diff($tdate,$rdate);
	if($diff->format("%R%a")>0){
		$fine=0;
	}
	else
	{
		$fine=$diff->format("%R%a");
	}
	$sql1="DELETE FROM issues WHERE username='".$usn."' AND bid=".$bid;
	$sql2="SELECT quantity FROM books WHERE bid=".$bid;
	$res1=$conn->query($sql2);
	if($res1->num_rows>0){
		while($row=$res1->fetch_assoc()){
			$quan=intval($row["quantity"]);

		}
		$quan=$quan+1;
	}
	$sql3="UPDATE books SET quantity=".$quan." WHERE bid=".$bid;
	if($conn->query($sql1)===TRUE&&$conn->query($sql3)===TRUE){
		echo "BOOK RETURNED FINE: ".$fine;
	}
	else{
		echo $conn->error;
	}

}
else{
	header("Location:LOGINLIB.html");
}


 ?>