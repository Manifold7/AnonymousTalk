<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
.error {color: #FF0000;}
</style>
<title>sign up</title>
<link href="css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta name="keywords" content="App Sign in Form,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements"./>-->
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</script>
<!--webfonts-->
<!--//webfonts-->
</head>
<body>


<?php
/*
作者：王大可
邮箱:albusgao@hotmail.com
*/



// 定义变量并设置为空值
$done_post=true;
$passwordErr=$usernameErr=$nameErr =$genderErr= "";
$password=$username= $gender="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   
   if (empty($_POST["username"])&&!empty($_POST["password"])) {
     $usernameErr = "用户名和密码必须同时填写的";
	 $done_post=false;
   } else {
     $username = test_input($_POST["username"]);
   }
   
   if (empty($_POST["password"])&&!empty($_POST["username"])) {
     $passwordErr = "密码和用户名必须同时填写的";
	 $done_post=false;
   } else {
     $password = test_input($_POST["password"]);
	 $password = MD5(MD5($password).'JLUAS');
   }
   if (empty($_POST["gender"])) {
     $genderErr = "性别是必选的";
	 $done_post=false;
   } else {
     $gender = test_input($_POST["gender"]);
	 if($gender==female)
	 {
	 	$sex=2;
	 }
	 else if($gender==male)
	 {
	 	$sex=1;
	 }
   }
   


if($done_post){
$i=0;
$con = mysql_connect("localhost","数据库名称","数据库密码");//connect the datebase
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("nanunions", $con);
mysql_query("set names 'utf8'");	//设定字符集


$sql1 = "select userID from user_phy_list where username = '$username' ";
$result1 = mysql_query($sql1);
$num1 = mysql_num_rows($result1);
if($num1>0)//判断是否一行
{
	echo "<script>alert('用户名已存在！');history.go(-1);</script>";
				
}
else
{
	$result = mysql_query("SELECT * FROM user_phy_list ORDER BY userID DESC");


	while($row = mysql_fetch_array($result))
	{
	  	if($i==0){
		$userID=$row['userID']+1;
		break;
		}
	  	
		$i++;
	}

	date_default_timezone_set("Asia/Shanghai");
	$join_date=date("Y-m-d H:i:s");
	mysql_query("INSERT INTO user_phy_list (userID, password, username,sex,last_ip) VALUES ('$userID', '$password', '$username','$sex','$_SERVER[REMOTE_ADDR]')");
	mysql_close($con);
	exit( '<h2><a href="index.html" style="text-decoration: none;">注册成功.返回登陆</a></h2><br/>');

}
  
}

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   $qian=array("'",'"');
   $data=str_replace($qian,'',$data);
   return $data;
}
?>


	<h1>JHY学派</h1>
	<h2>吾爱真理</h2>
		<div class="app-cam">
			<div class="cam"><img src="images/cam.png" class="img-responsive" alt="" /></div>
			
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<input type="text" class="text" name="username" value="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'username';}" >
				<span class="error">*<?php echo $usernameErr;?></span>
				<br><br>
				<input type="password" name="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
				<span class="error">*<?php echo $passwordErr;?></span>
   				<br><br>
				<input type="radio" name="gender" value="female">女性
			    <input type="radio" name="gender" value="male">男性
			    <span class="error">* <?php echo $genderErr;?></span>
			    <br><br>
				<p><span class="error">* 必需的字段</span></p>
				<div class="submit"><input type="submit" name="submit" value="提交" ></div>
			</form>
		</div>
	<!--start-copyright-->
   		<div class="copy-right">
				<p>Copyright &copy; 2016.Company name All rights reserved. JHY学派</a></p>
		</div>
	<!--//end-copyright-->
</body>
</html>