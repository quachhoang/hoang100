<?php
class Order extends AppModel
{
	var $name='Order';
	public $useTable = 'orders';
	public $join=array(
		array(
			'table'=>'order_detail',
			'alias'=>'OrderDetail',
			'type'=>'LEFT',
			'conditions'=>array('OrderDetail.order_id=Order.id')
		));
		// thiết lập các luật để cầu hình validate cho việc thêm sản phẩm(table:Order)
	var $validate=array(
		'order_code'=>array(
			'rule'=>'/^(?=.*\d)(?=.*[a-z]).{6,6}$/i',
			'message'=>'Mã đơn hàng gồm 6 ký tự bao gồm số và chữ'
		)
	);
		//xây dựng hàm kiểm tra sự tồn tại của order_code
	function check_order_code($order_code = "",$id = null){
		$conditions = array(
			'order_code'=>$order_code
		);
		if(!empty($id)){
			$conditions['id <>'] = $id
		}
		$this->find('all',array(
			'conditions'=>$conditions
		));
		if($this->getNumrows()==0){
			return false;
		}else return true;
	}
}
?>