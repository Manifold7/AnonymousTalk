<?php
/*
作者：王大可
邮箱:albusgao@hotmail.com
*/
session_start();//开启session
header('Content-Type:text/html; charset= utf-8');
	if(isset($_POST["submit"]) && $_POST["submit"] == "登陆")
	{
		$user = $_POST["username"];
		$password = $_POST["password"];
		$password = MD5(MD5($password).'JLUAS');
		if($user == "" || $password == "")
		{
			echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
		}
		else
		{
			mysql_connect("localhost","数据库名称","数据库密码");
			mysql_select_db("nanunions");
			mysql_query("set names 'utf8'");	//设定字符集
			$sql = "select username,password,userID,class,sex from user_phy_list where username = '$_POST[username]' and password = '$password'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);
			if($num)//判断是否一行
			{
				$row = mysql_fetch_array($result);	//将数据以索引方式储存在数组中
				$_SESSION['username']=$row[0];//记录用户保已登录，
				$_SESSION['userID']=$row[2];
				$_SESSION['class']=$row[3];
				$_SESSION['sex']=$row[4];
				mysql_query("UPDATE user_phy_list SET last_IP = '$_SERVER[REMOTE_ADDR]' WHERE username = '$_POST[username]'");
				echo '<h3><a href="freetalk.html" style="text-decoration: none;">freetalkroom</a></h3><br/>';
				
			}
			else
			{
				echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>";
			}
		}
	}
	else
	{
		echo "<script>alert('提交未成功！'); history.go(-1);</script>";
	}

?>