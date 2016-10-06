<?php
session_start();
//header("Content-Type:text/html;charset=utf8;");
//包含数据库相关处理文件

include './DBfile/DBHelper.class.php';
$db=new DBHepler();
if(isset($_POST["btn"])){
	$username=$_POST["username"];
 	$_SESSION["username"]=$username;
	if($username==""){
		echo "<script>alert('请输入手机号');
    			</script>";
	}else{
		$sql="select count(userid) as num from cas_user where username='{$username}'";
		$res=$db->ExecuteDQL($sql);
		//  print_r($res);  Array ( [0] => Array ( [num] => 1 ) )
		if($res[0]["num"]){
			//重定向到积分查询页面
			
                        header("Location:SelectScore.php?tel={$username}");
		}else{
			echo "<script>alert('亲,请先下载e+优品app并且注册成功之后才可以参与本活动奥!');
    			window.location.href=' http://a.app.qq.com/o/simple.jsp?pkgname=com.bm.customer.wm';
    			</script>";
		}		
	}
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
<!-- Bootstrap -->
<link href="./css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
//检查输入的手机号是否合法
function Check(){
	var tel=document.getElementById("tel").value;
	if(tel==""){
		alert("请输入手机号");
		document.getElementById("tel").focus();
		return false;
	}
	else{
		//验证手机号码的正则表达式
		if(!(/^1[34578]\d{9}$/.test(tel))){
// 			alert(234);
                alert("你输入的手机号码格式不正确，请重新输入");
			document.getElementById("tel").focus();
			return false;			
		}else{
			 sp.innerHTML="";
			return true;
		} 
	}  
}
</script>
</head>
 <style type="text/css">
    html,body{
      height:100%; width:100%;
    }
    #div1{
		margin:0; padding:0;
		width:100%; background-color:red;height:45%;
                

		}
   #div2{
    color:white;margin-left:10%;
    width:80%;
   }
 </style>

<body> 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="./js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="./js/bootstrap.js"></script>
<div id="div1">
<img src="./images/index.jpg" width="100%"/>
</div>
<div style="background-color:#C0250F;height:55%;">
<form action="#" method="post">
<span style="margin-left:10%;padding-top:30%;"><input type="text" placeholder='请输入手机号' style="text-align:center; width:80%;height:40px;font-size:1.2em;" name="username"  id="tel" onBlur="return Check()" /></span>
<span id= "sp"></span><br/><br/>
<span style="margin-left:10%;"><input type="submit" value="参加" style="width:80%;height:40px;background-color:#FFF521; font-size:1.2em; color:red; font-weight:bold;" name="btn"/></span>
</form>
<div id="div2">
<font style="font-weight:bold;">活动规则:</font><br/>
1、请输入注册“e+优品”时的手机号码；<br/>
2、若没有注册“e+优品”的请先在下方提示框中点
击进入下载注册界面;<br/>
3、所有“e+优品”用户在“我的钱包”里面进入点击“签到”获得2积分;<br/>
4、积分可在本链接积分商城兑换相应的优惠券,在使用“e+优品”购物时使用;<br/>
</div>
</div>
</body>
</html>