<?php
	class Account extends AppModel
	{
		var $name='Account';
		// hàm kiểm tra sự tồn tại của $username và password trước khi login
		function check_login($username,$password){
			$this->find('all',array(
					'conditions'=>array('username' => $username,'password'=>$password)));
			if($this->getNumrows()==0){
				return false;
			}else return true;
		}
		// thiết lập các luật để cầu hình validate cho việc thêm sản phẩm
		var $validate=array(array(
			'product_name'=>array(
				'role'=>'/^[a-z0-9]?(?=.*[a-z])(?=.*\d).{5,31}$/i',
				'message'=>'Username ít nhất 5 ký tự bao gồm ký tự số và chữ cái'
			),
			'amount'=>array(
				'role'=>'//i',
				'message'=>'Số tiền lớn hơn 0, nguyên dương bé hơn 1 tỷ'
			)
		));
	}
?>