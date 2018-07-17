<?php
class OrderDetail extends AppModel
{
	var $name='OrderDetail';
	public $useTable = 'order_detail';
		// thiết lập các luật để cầu hình validate cho việc thêm sản phẩm(table:Order_detail)
	var $validate=array(
		'product_name'=>array(
			'rule'=>'/^[a-z0-9]?(?=.*[a-z])(?=.*\d).{5,31}$/i',
			'message'=>'Tên sản phẩm ít nhất 5 ký tự bao gồm ký tự số và chữ cái'
		),
		'amount'=>array(
			'rule'=>'/^[^0](?=.*\d).{1,8}$/i',
			'message'=>'Số tiền lớn hơn 0, nguyên dương bé hơn 1 tỷ'
		),
		'quantity'=>array(
			'rule'=>'/^(?=.*\d)[^0].{1,3}$/i',
			'message'=>'Số lượng phải nằm trong khoảng từ 1 tới 100'
		)
	);
			//xây dựng hàm kiểm tra sự tồn tại của order_code
	function check_product_name($product_name){
			//print_r($product_name)
		$this->find('all',array(
			'conditions'=>array('product_name'=>$product_name)
		));
		if($this->getNumrows()==0){
			return false;
		}else return true;
	}
}
?>