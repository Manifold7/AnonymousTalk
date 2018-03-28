<?php
/*
作者：王大可
邮箱:albusgao@hotmail.com
*/
header('Content-Type:text/html; charset= utf-8');
session_start();//开启session

$room=$_GET["room"];

$i=$accept_no=0;
$con = mysql_connect("localhost","数据库名称","数据库密码");//connect the datebase
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("nanunions", $con);
mysql_query("set names 'utf8'");	//设定字符集

if($room==1){
	$sql1 = "select username,last_niming from user_phy_list where userID = '$_SESSION[userID]'";
}
else if ($room==2){
	$sql1 = "select username,last_yhj from user_phy_list where userID = '$_SESSION[userID]'";

}
else if ($room==3){
	$sql1 = "select username,last_normal from user_phy_list where userID = '$_SESSION[userID]'";

}


$result1 = mysql_query($sql1);
$row1 = mysql_fetch_array($result1);	//将数据以索引方式储存在数组中
	
if($room==1){
	$result = mysql_query("SELECT * FROM talk_sci ORDER BY number DESC");
}
else if ($room==2){
	$result = mysql_query("SELECT * FROM talk_yhj ORDER BY number DESC");
}
else if ($room==3){
	$result = mysql_query("SELECT * FROM talk_noraml ORDER BY number DESC");
}


while($row = mysql_fetch_array($result))
  {	
	$no[$i]=(int)$row['number'];
	$accept_no=$no[0]-(int)$row1[1]-1;
	if($accept_no>30)
	{
		$accept_no=30;
	}
	if($i>$accept_no)
	{
	$i=0;
	$no_onlond = $no[0];
	
	if($room==1){
		mysql_query("UPDATE user_phy_list SET last_niming = '$no_onlond' WHERE userID = '$_SESSION[userID]'");
	}
	else if ($room==2){
		mysql_query("UPDATE user_phy_list SET last_yhj = '$no_onlond' WHERE userID = '$_SESSION[userID]'");

	}
	else if ($room==3){
		mysql_query("UPDATE user_phy_list SET last_normal = '$no_onlond' WHERE userID = '$_SESSION[userID]'");

	}
	
	break;
	}
	$line[0][$i]=$row['line'];
	$line[1][$i]=$row['time'];
	if($_SESSION['username']==$row['username']){
		$line[2][$i]='benren';
	}
	else
	{
		$line[2][$i]=$row['username'];
	}	
	$line[3][$i]=$row['sex'];
	$i++;
  }
echo json_encode($line);
mysql_close($con);

?>