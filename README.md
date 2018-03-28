# AnonymousTalk
简单在线聊天，基于php+mysql。

基本功能齐全，有注册与登录页面，以及3个聊天室。分别为normal.php AnonymousTalk.php YHJTalk.php。
normal.php为普通的聊天房间。
AnonymousTalk.php是匿名聊天。
YHJTalk.php需要权限才能进入。


有四个脚本需要输入数据库名和密码。文件夹talk里面的两个。loginincheck和register。

mysql需要4个表
user_phy_list

	1	userID	smallint(5)
	2	username	varchar(24)	utf8_general_ci	
	3	password	varchar(60)	utf8_general_ci
	4	sex	tinyint(1)	
	5	last_ip	varchar(24)	utf8_general_ci	
	6	last_niming	int(6)		
	7	class	smallint(2)	
	8	last_yhj	int(6)		
	9	last_boy	int(6)		
	10	last_girl	int(6)	
	11	last_normal	int(6)	

talk_sci（talk_yhj,talk_noraml）

	1	number	int(10)	
	2	username	varchar(24)	utf8_general_ci	
	3	time	varchar(24)	utf8_general_ci	
	4	line	varchar(1000)	utf8_general_ci	
	5	sex	tinyint(1)	
