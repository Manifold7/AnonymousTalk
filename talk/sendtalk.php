<?php
/*
作者：王大可
邮箱:albusgao@hotmail.com
*/
header('Content-Type:text/html; charset= utf-8');
session_start();//开启session
$line=$_GET["line"];
$room=$_GET["room"];

$line=test_input($line);
function test_input($data) {
   $data = trim($data);
   //$data = stripslashes($data);
   //$data = htmlspecialchars($data);
   $qian=array("'",'"');
   $data=str_replace($qian,'',$data); 
   return $data;
}
date_default_timezone_set("Asia/Shanghai");//设置时区
$time =	date("m-d H:i");
$username = $_SESSION['username'];
$sex = 	$_SESSION['sex'];
$i=0;
$con = mysql_connect("localhost","数据库名称","数据库密码");//connect the datebase
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("nanunions", $con);
mysql_query("set names 'utf8'");	//设定字符集

if($room==1){
	$result = mysql_query("SELECT * FROM talk_sci ORDER BY number DESC");
}
else if ($room==2)
{
	$result = mysql_query("SELECT * FROM talk_yhj ORDER BY number DESC");
}
else if ($room==3)
{
	$result = mysql_query("SELECT * FROM talk_noraml ORDER BY number DESC");
}


while($row = mysql_fetch_array($result))
{
  	if($i==0){
	$number=$row['number']+1;
	break;
	}
  	
	$i++;
}

if($room==1){
	mysql_query("INSERT INTO talk_sci (number,username,time,line,sex) VALUES ('$number','$username','$time','$line','$sex')");

}
else if ($room==2)
{
	mysql_query("INSERT INTO talk_yhj (number,username,time,line,sex) VALUES ('$number','$username','$time','$line','$sex')");

}
else if ($room==3)
{
	mysql_query("INSERT INTO talk_noraml (number,username,time,line,sex) VALUES ('$number','$username','$time','$line','$sex')");

}


mysql_close($con);
?>