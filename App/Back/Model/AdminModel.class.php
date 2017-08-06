<?php

/**
 * 后台bg_admin表格操作模型
 */

class AdminModel extends Model{
	/**
	 * 验证管理员的合法性
	 * @param   $name  用户名
	 * @param 	$pass  密码
	 */
	public function check($name,$pass){
		$sql = "select * from bg_admin where admin_name='$name' and admin_pass = md5('$pass')";
		return $this->dao->fetchRow($sql);
	}

	public function updateAdminInfo($id){
		$login_ip = $_SERVER['REMOTE_ADDR'];
		$login_time = time();
		$sql = "update bg_admin set login_ip = '$login_ip',login_time='$login_time',login_nums=login_nums+1 where admin_id=$id";
		return $this->dao->my_query($sql);
	}
}