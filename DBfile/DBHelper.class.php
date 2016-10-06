<?php
class DBHepler{
	//服务器名称
	private $serverName;
	//用户名
	private $userName;
	//密码
	private $userPwd;
	//数据库名称
	private $dbName;
	//数据库连接标识
	private $link;
	
	/**
	 * 构造函数，初始化字段
	 */
	function __construct(){
	
		$this->serverName="117.34.95.168";
		$this->userName="wm";
		$this->userPwd="";
		$this->dbName="wmeng";
		$this->ConnectDB();
	}
	
	/**
	 * 连接数据库的方法
	 */
	function ConnectDB(){
		$this->link=@mysql_connect($this->serverName,$this->userName,
				$this->userPwd) or die("数据库连接失败");
		@mysql_select_db($this->dbName) or die("找不到指定的数据库");
	}
	
	/**
	 * 执行增删改的方法
	 * @param  $sql 要执行的sql语句
	 * @return boolean 执行成功返回true,失败返回false
	 */
	function ExecuteDML($sql){
		mysql_query("set names utf8");
		$res=mysql_query($sql);
		if($res){
			$affRows=mysql_affected_rows($this->link);
			if($affRows){
				return true;
			
			}else{
				return false;
			}		
			
		}else{
				return false;
			}
		
	}
	
	/**
	 * 执行查询的方法
	 * @param unknown $sql  要执行的sql语句
	 * @return 执行成功，返回查询结果集的二维数组，失败返回false
	 */
	function ExecuteDQL($sql){
		mysql_query("set names utf8");
		$res=mysql_query($sql);
		$allArr=array();
		if($res){
			while (($arr=mysql_fetch_assoc($res))!=false){
				$allArr[]=$arr;
		
			}
			return $allArr;
		}else{
			return false;
		}
	}
	
	/**
	 * 析构函数，用来关闭数据库连接
	 */
	function __destruct(){
		@mysql_close($this->link);
	}
}
?>
