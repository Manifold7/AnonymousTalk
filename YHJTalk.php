<!DOCTYPE html>
<?php 
session_start();//开启session
?>
<html>
<head>
<meta charset="UTF-8">
<meta content="width=device-width,height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
<style>

* {   
                margin: 0;   
                padding: 0;   
                list-style: none;   
                font-family: '微软雅黑'   
            }   
            #container {   
                /*width: 450px;   
                height: 780px;*/
				width : 100%;
				height : 90%;   
                background: -moz-linear-gradient(-45deg, #183850 0, #183850 25%, #192c46 50%, #22254c 75%, #22254c 100%);
  				background: -webkit-linear-gradient(-45deg, #183850 0, #183850 25%, #192c46 50%, #22254c 75%, #22254c 100%);
				background-repeat: no-repeat;
				background-attachment: fixed;  
                margin:  auto 0;   
                position: relative;   
                /*box-shadow: 20px 20px 55px #777;   */
            }   
            .header {   
                background: #000;   
                height: 40px;   
                color: #fff;   
                line-height: 34px;   
                font-size: 20px;   
                padding: 0 10px;   
            }   
            .footer {    
                height: 50px;   
                background: #666;   
                bottom: 0;   
                padding: 10px;   
            }   
            .footer input {   
                width: 60%;   
                height: 45px;   
                outline: none;   
                font-size: 20px;   
                text-indent: 10px;   
                position: absolute;   
                border-radius: 6px;   
                right: 80px;   
            }   
            .footer span {   
                display: inline-block;   
                width: 62px;   
                height: 48px;   
                background: #ccc;   
                font-weight: 900;   
                line-height: 45px;   
                cursor: pointer;   
                text-align: center;   
                position: absolute;   
                right: 10px;   
                border-radius: 6px;   
            }   
            .footer span:hover {   
                color: #fff;   
                background: #999;   
            }   
            #user_face_icon {   
                display: inline-block;   
                background: red;   
                width: 60px;   
                height: 60px;   
                border-radius: 30px;   
                position: absolute;   
                bottom: 6px;   
                left: 14px;   
                cursor: pointer;   
                overflow: hidden;   
            }   
            img {   
                width: 60px;   
                height: 60px;   
            }   
            .content {   
                font-size: 20px;   
               /* width: 435px;   */
                height: 500px;   
                overflow: auto;   
                padding: 5px;   
            }   
            .content li {   
                margin-top: 10px;   
                padding-left: 10px;   
                width: 91%;   
                display: block;   
                clear: both;   
                overflow: hidden;   
            }   
            .content li img {   
                float: left;   
            }   
            .content li span{   
                background: #fff;   
                padding: 10px;   
                border-radius: 10px;   
                float: left; 
                margin: 6px 10px 0 10px;   
                max-width: 65%;   
                border: 1px solid rgba(25, 147, 147, 0.2);   
                box-shadow: 0 0 3px rgba(25, 147, 147, 0.2); 
            }   
            .content li img.imgleft {    
                float: left;    
            }   
            .content li img.imgright {    
                float: right;    
            }   
            .content li span.spanleft {    
                float: left;   
                background: #065FB9;
				position: relative;   
                top: -10px;      
            }   
            .content li span.spanright {    
                float: right;   
                background: #065FB9;   
            }   
			.content li p {    
                float: left; 
				font-size:x-small; 
				color : #fff;
            }   

</style>
	<title>YHJRoom</title>
</head>
<body>
<?php 
/*
作者：王大可
邮箱:albusgao@hotmail.com
*/


if(empty($_SESSION['username']))
{
	exit('<h1><a href="index.html" style="text-decoration: none;"><span class="error">登录异常！！！请重新登陆！！！</a></h1><br/>');
}
else if($_SESSION['class']<5)
{
	exit('<h1><a href="index.php" style="text-decoration: none;"><span class="error">您没有权限！</a></h1><br/>');
}

?>
<script type = "text/javascript">



	function accepttalk()
	{
	
	
		var xmlhttp;//AJAX获取聊天信息
		if (window.XMLHttpRequest)
 		{// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
		else
		{// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
  		{
  			if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
				var talkreport= xmlhttp.responseText;
				var lines = eval('('+talkreport+')');
				
				for (var i=lines[0].length-1; i>-1; i--)
				{
						var str=""+lines[0][i];
						
					   	/*if(str.indexOf("http") > 0 ){
							document.getElementById("line").innerHTML +="<img src='"+str+"' />";
						}*/
						if(lines[2][i]=='benren'){
							document.getElementById("line").innerHTML +='<li><span class = "spanright">'+str+'</span></li>';
						}
						else
						{
							document.getElementById("line").innerHTML +='<li><p>'+lines[2][i]+'</p><br/><span class = "spanleft">'+str+'</span></li>';
						}
						 
						
				}
				//contentcontent.scrollTop=content.scrollHeight;   // 内容过多时,将滚动条放置到最底端  
    			

    		}
  		}	
		xmlhttp.open("GET","talk/accepttalk.php?room=2",true);
		xmlhttp.send();
	}
	
function onloadtalk(line){
	var xmlhttp;//AJAX发出聊天信息
	if (window.XMLHttpRequest)
 	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
	else
	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
		
    	}
  	}	
	xmlhttp.open("GET","talk/sendtalk.php?line="+line+"&room=2",true);
	xmlhttp.send();
	document.getElementById("talk").value="";
}
function onloadeq(){
	var xmlhttp;//AJAX发出公式
	if (window.XMLHttpRequest)
 	{// code for IE7+, Firefox, Chrome, Opera, Safari
  		xmlhttp=new XMLHttpRequest();
  	}
	else
	{// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
		
    	}
  	}
	var img_url="http://latex.codecogs.com/gif.latex?"+document.getElementById("code").value;
	img_url=img_url.replace(/\\/g,"\\\\");
	xmlhttp.open("GET","talk/sendtalk.php?line="+img_url,true);
	xmlhttp.send();
	document.getElementById("talk").value="";
}


window.setInterval("accepttalk()",1000);

function EqEditor(text) {//点击图片生成代码
	document.getElementById("code").value=document.getElementById("code").value+text;
}
function upland() {//获取图片预览
var img_url="http://latex.codecogs.com/gif.latex?"+document.getElementById("code").value;
document.getElementById("Equation").innerHTML="<img src='"+img_url+"' />";
}
</script>

<div id="container">  
            <div class="header">  
                <span style="float: left;">YHJ</span>  
                <span style="float: right;">me</span>  
            </div>  
            <ul class="content" id="line"> 
			</ul>  
            <div class="footer">  
                <!--<div id="user_face_icon">  
                    <img src="http://mcyacg.com/uc_server/data/avatar/000/02/95/96_avatar_big.jpg" alt="">  
                </div>  -->
                <input id="talk" type="text" placeholder="说点什么吧...">  
                <span id="btn" onclick="onloadtalk(talk.value)">发送</span>  
            </div>  
        </div>  

<!--公式编辑模块
<div>
	<h2>Equation Editor</h2>
	<image  type="image" src="pictures/math (20).gif" onclick="EqEditor('\\lim_{}')"></image>
	<image  type="image" src="pictures/math (12).gif" onclick="EqEditor('\\int_{}^{}  ')"></image>
	<image  type="image" src="pictures/math (13).gif" onclick="EqEditor('\\oint   ')"></image>
	<image  type="image" src="pictures/math (15).gif" onclick="EqEditor('\\iint  ')"></image>
	<image  type="image" src="pictures/3f.gif" onclick="EqEditor('\\iiint  ')"></image>
	<image  type="image" src="pictures/math (8).gif" onclick="EqEditor('\\frac{\\partial }{\\partial x}')"></image>
	<image  type="image" src="pictures/math (9).gif" onclick="EqEditor('\\frac{\\partial^2 }{\\partial x^2}')"></image>
	<image  type="image" src="pictures/math (10).gif" onclick="EqEditor('\\frac{\\mathrm{d} }{\\mathrm{d} x}')"></image><br/>

	<image  type="image" src="pictures/math (6).gif" onclick="EqEditor('\\frac{}{}')"></image>
	<image  type="image" src="pictures/math (7).gif" onclick="EqEditor('\\tfrac{}{}')"></image>
	<image  type="image" src="pictures/math (1).gif" onclick="EqEditor('^{}')"></image>
	<image  type="image" src="pictures/math (2).gif" onclick="EqEditor('_{}')"></image>
	<image  type="image" src="pictures/math (3).gif" onclick="EqEditor('_{}^{}')"></image>
	<image  type="image" src="pictures/math (4).gif" onclick="EqEditor('{_{}}^{}')"></image>
	<image  type="image" src="pictures/math (5).gif" onclick="EqEditor('_{}^{}\\textrm{}')"></image>
	<image  type="image" src="pictures/math (24).gif" onclick="EqEditor('\\sqrt[]{}')"></image><br/>


	<image  type="image" src="pictures/math (17).gif" onclick="EqEditor('\\bigcap_{}^{}  ')"></image>
	<image  type="image" src="pictures/math (19).gif" onclick="EqEditor('\\bigcup_{}^{}')"></image>
	<image  type="image" src="pictures/5.gif" onclick="EqEditor('\\subset ')"></image>
	<image  type="image" src="pictures/6.gif" onclick="EqEditor('\\supset ')"></image>
	<image  type="image" src="pictures/15.gif" onclick="EqEditor('\\in ')"></image>
	<image  type="image" src="pictures/16.gif" onclick="EqEditor('\\ni ')"></image>
	<image  type="image" src="pictures/17.gif" onclick="EqEditor('\\notin ')"></image><br/>


	<image  type="image" src="pictures/math (22).gif" onclick="EqEditor('\\sum_{}^{}')"></image>
	<image  type="image" src="pictures/math (26).gif" onclick="EqEditor('\\prod_{}^{}')"></image>
	<image  type="image" src="pictures/asso (1).gif" onclick="EqEditor('\\cong ')"></image>
	<image  type="image" src="pictures/asso (6).gif" onclick="EqEditor('\\leqslant ')"></image>
	<image  type="image" src="pictures/asso (7).gif" onclick="EqEditor('\\geq ')"></image><br/>

	<image  type="image" src="pictures/point (2).gif" onclick="EqEditor('n \\to')"></image>
	<image  type="image" src="pictures/point (4).gif" onclick="EqEditor('\\rightarrow')"></image>
	<image  type="image" src="pictures/point (16).gif" onclick="EqEditor('\\xrightarrow[]{}')"></image><br/>



	<textarea id="code" rows="10" cols="40"></textarea>

	<br/>
	<button type="button" onclick="upland()">生成公式</button><button type="button" onclick="onloadeq()">发送公式</button>
	<p>公式图片：<br/><span id="Equation"></span></p>
</div>-->

</body>
</html>

