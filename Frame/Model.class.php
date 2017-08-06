<?php 

class Model{
	protected $dao;//用户保存数据库操作对象
	//初始化数据库操作对象
	//私有方法
	protected function initDAO(){
		//include './Frame/MySQLDB.class.php';
		//初始化MySQL
		$config = $GLOBALS['conf']['db'];
		//$this->dao = MySQLDB::getInstance($config);
		switch ($GLOBALS['conf']['App']['dao']) {
			case 'mysql': $dao_class = 'MySQLDB';break;
			case 'pdo' : $dao_class = 'PDODB';
		}
		$this->dao = $dao_class::getInstance($config);
	}
	public function __construct(){
		$this->initDAO();
	}
}