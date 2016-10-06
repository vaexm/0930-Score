<?php
session_start();
// header("Content-Type:text/html;charset=utf8;");
include './DBfile/DBHelper.class.php';
$db=new DBHepler();
//用户名
$username="";
//积分
$score=0;
if(isset($_GET["tel"])){
	$username=$_GET["tel"];	
	//查询用户积分
	$sql="select score from cas_user where username='{$username}'";
	$res=$db->ExecuteDQL($sql);
    $score=$res[0]["score"];
}
$_SESSION["score"]=$score;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>积分查询页面</title>

<style type="text/css">
html,body{
margin:0; padding:0;
width:100%;
height:100%;
}
#div_search{
/*margin-left:35%;
margin-top:3%;*/
width:100%;height:32%;
}
#div_show{
width:60%;
height:50%;
margin-left:20%;padding-top:5%;font-size:3em; text-align:center;
/* display:none; */                
}
#div_Bottom{
width:100%;
height:68%;
background-color:#FE5720;
}
#div_show p{

}
</style>
</head>
<body>
<div id="div_search">
<!--<form>
<input type="text" id="tel" name="uname" value="<?php echo $username;?>"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="btn" id="sub" value="查询"/>
</form>-->
<img src="./images/score.jpg" width="100%"/>
</div>
<div id="div_Bottom">
<div id="div_show">
             <p>欢迎你:&nbsp;<?php echo $username;?></p>
             <p>你目前所拥有积分为:<?php echo $score."分";?></p>
             <a href="ScoreShop.php">点击进入e+优品积分商城进行兑换....</a>
</div>
</div>

</body>
</html>