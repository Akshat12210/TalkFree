<?php
include('config.php');
include('api.php');
$arr['topic']='Counselling Session with ';
$arr['start_date']=date('2022-04-24');
$arr['duration']=60;
$arr['password']='123';
$arr['type']='2';
//2 -> for schedule
$result=createMeeting($arr);
if(isset($result->id)){
	$link= "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
	$pass= "Password: ".$result->password."<br/>";
	//echo "Start Time: ".$result->start_time."<br/>";
	//echo "Duration: ".$result->duration."<br/>";
}else{
	echo '<pre>';
	print_r($result);
}
?>