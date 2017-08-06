<?php

class PDODB implements I_DAO {
	//定义相关属性
	private $host;
	private $port;
	private $user;
	private $pass;
	private $charset;
	private $dbname;
	private $dsn;
	private $pdo;
	private static $instance;
	//构造方法
	private function __construct($arr){
		//初始化属性
		$this->initParams($arr);
		//初始化dsn
		$this->initDSN();
		//实例化pdo对象
		$this->initPDO();
		//初始化pdo属性
		$this->initAttribute();
	}
	/**
	 * 用于单例对象
	 * @param  array $arr 传递个构造方法的数组参数
	 */
	public static function getInstance($arr){
		if (!self::$instance instanceof self) {
			self::$instance = new self($arr);
		}
		return self::$instance;
	}
	public function initParams($arr){
		//初始化属性
		$this->host = isset($arr['host']) ? $arr['host'] :'localhost';
		$this->port = isset($arr['port']) ? $arr['port'] :'3306';
		$this->user = isset($arr['user']) ? $arr['user'] :'root';
		$this->pass = isset($arr['pass']) ? $arr['pass'] :'';
		$this->charset = isset($arr['charset']) ? $arr['charset'] :'utf8';
		$this->dbname = isset($arr['dbname']) ? $arr['dbname'] :'';
	}
	//初始化dsn
	private function initDSN(){
		$this->dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=$this->charset";
	}
	//初始化dsn，得到一个pdo对象
	private function initPDO(){
		try{
			$this->pdo = new PDO($this->dsn,$this->user,$this->pass);
		}catch(PDOException $e){
			echo "数据库连接失败！<br />";
			echo "错误编号为：" ,$e->getCode(), '<br />';
			echo "错误信息为：" ,$e->getMessage(), '<br />';
			echo "错误文件为：" ,$e->getFile(), '<br />';
			echo "错误行号为：" ,$e->getLine(), '<br />';
			die;
		}
	}
	/**
	 * 初始化PDO对象属性，走异常模式
	 */
	private function initAttribute(){
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	/**
	 * 输出异常信息
	 */
	private function my_error($e){
		echo "SQL语句执行失败！<br />";
		echo "错误编号为：" ,$e->getCode(), '<br />';
		echo "错误信息为：" ,$e->getMessage(), '<br />';
		echo "错误文件为：" ,$e->getFile(), '<br />';
		echo "错误行号为：" ,$e->getLine(), '<br />';
		die;
	}
	/**
	 * my_query方法，实现增删改
	 */
	public function my_query($sql){
		try{
			$result = $this->pdo->exec($sql);
		}catch(PDOException $e){
			$this->my_error($e);
		}
		return $result;
	}

	public function fetchAll($sql){
		try{
			$stmt = $this->pdo->query($sql);
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		}catch(PDOException $e){
			$this->my_error($e);
		}
		return $result;
	}

	public function fetchRow($sql){
		try{
			$stmt = $this->pdo->query($sql);
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
		}catch(PDOException $e){
			$this->my_error($e);
		}
		return $result;
	}

	public function fetchColumn($sql,$i=NULL){
		try{
			$stmt = $this->pdo->query($sql);
			if (is_null($i)) {
				$result = $stmt->fetchColumn();
			}else{
				$result = $stmt->fetchColumn($i);
			}
			$stmt->closeCursor();
		}catch(PDOException $e){
			$this->my_error($e);
		}
		return $result;	
	}

	private function __clone(){

	}
}
