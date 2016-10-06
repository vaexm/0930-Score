<?php
session_start();
//header("Content-Type:text/html;charset=utf8;");
include './DBfile/DBHelper.class.php';
$db=new DBHepler();

//判断是否点击了兑换
if(isset($_GET["uname"]))
{
	//用户名即手机号
	$username=$_GET["uname"];
	//所需积分
	$Needscore=$_GET["score"];
	//兑换券编号
	$cid=$_GET["cid"];
	//用户拥有积分
	$score=$_SESSION["score"];
	//判断该用户积分足不足以兑换所选的券
    if($score<$Needscore){
    	//说明该用户积分不足以兑换他所选的券
    	echo "<script type='text/javascript'>
        			alert('抱歉,你目前积分不足，请选择别的金额的现金券，想获得更多积分，可以通过app签到领取，之后，会有更多获得积分的渠道开通，敬请期待');
        	 </script>";
    }
  /*   window.loaction.href='http://mp.weixin.qq.com/s?__biz=MzA5Mz
     	    gyNjA0NQ==&mid=2649532462&idx=1&sn=86e1735ab1e60ef53c1f42e546ef5b65&scene=0#wechat_redirect'; */
    else{
        //更改用户积分
        $sql="update cas_user set score=score-{$Needscore} where username='{$username}'";
        $res=$db->ExecuteDML($sql);
        //将该用户添加到参与活动的用户表中
        $sql1="insert into act_user(username,cid) VALUES ('{$username}', {$cid})";
        $res1=$db->ExecuteDML($sql1);
        if($res&&$res1){
                echo "<script type='text/javascript'>
        			alert('恭喜你,兑换成功,稍后将跳转到领取页面进行领取');
        			</script>";
                if($cid==1){
		//说明用户兑换的为1元现金券
                  echo "<script type='text/javascript'>
                   window.location.href='http://w.url.cn/s/AfWdiFa';
                  </script>";
                }else if($cid==2){
		 //说明用户兑换的为2元现金券
                   echo "<script type='text/javascript'>
                   alert(2);
                  // window.location.href='';2元现金券的链接
                  </script>";
                }else if($cid==5){
		 //说明用户兑换的为2元现金券
                   echo "<script type='text/javascript'>
                   alert(5);
                  // window.location.href='';5元现金券的链接
                  </script>";
                }else if($cid==10){
		 //说明用户兑换的为2元现金券
                   echo "<script type='text/javascript'>
                   alert(10);
                  // window.location.href='';10元现金券的链接
                  </script>";
                }else if($cid==30){
		 //说明用户兑换的为2元现金券
                   echo "<script type='text/javascript'>
                   alert(30);
                  // window.location.href='';30元现金券的链接
                  </script>";
                }
                 
        	
        	
        }
	else{
        	echo "<script>alert('兑换失败');</script>";
        }
        //header('Location:http://w.url.cn/s/AfWdiFa');
    }
    
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap -->
<link href="./css/bootstrap.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
html,body{
width:100%;height:100%;
}
#tab_cash{
width:90%;height:100%;
border-collapse:collapse;
}
#div_cash{
	width:100%;
	height:84%; 
}
#tab_cash tr td,#tab_cash tr th{
 font-size:0.9em;
 text-align:center;
 border:1px solid #FFDBFF;

}
#div_Welcome{
	margin-top:-5%;
	width:100%;
	height:15%;
}

</style>
<script type="text/javascript">
function isChange(){
	return confirm("你确定要兑换吗?");
} 
</script>
</head>

<body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="./js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="./js/bootstrap.js"></script>
<!--<div id="div1">
<img src="./images/bg.jpg" width="100%" height="100%"/><h1 align="center">e+优品积分商城</h1>
</div>-->
<div id="div_Welcome">
<h3 align="center">e+优品积分商城</h3>
<span font-size='1em'>欢迎你<?php echo $_SESSION["username"]; ?></span>
</div>
<?php 
$sql="select id,cname,score,src from cash";
$res=$db->ExecuteDQL($sql);
// print_r($res);
echo "<div id='div_cash'>";
echo "<table id='tab_cash' align='center'>
		<tr bgcolor='#FFDBFF' height='5%'><th>兑换券</th><th>所需积分</th><th>兑换</th></tr>
		";
foreach ($res as $row){
    echo "<tr height='19%'>";
    echo "<td width='60%'><img src='{$row["src"]}' width='86%'/></td><td width='20%'>{$row['score']}</td>";
    echo "<td width='20%'><a href='ScoreShop.php?uname={$_SESSION["username"]}&cid={$row["id"]}&score={$row["score"]}' onclick='return isChange()'>兑换</a></td>";
    echo "</tr>";
}
echo "</table>";
echo "</div>";
?>
</body>
</html>
