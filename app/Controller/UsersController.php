<?php
class UsersController extends AppController
{
	var $uses=array('Account','Order','OrderDetail');
	var $paginate=array();
	public $components=array('Session');
	// tạo trang login
	function login(){
		if($this->request->is('post')){
			$error='';
			$data=$this->request->data;
			if(!empty($data)){
				$username=$data['username'];
				$password=$data['password'];
				if($this->Account->check_login($username,$password)==true){
					$this->Session->write('username',$username);
					$this->redirect('order');
				}else{
					$error='username hoặc password đã sai vui lòng kiểm tra lại !';
					$this->set('error',$error);
				}
			}
		}
	}
	// xây dựng view logout
	function logout(){
		$this->Session->delete('username');
		$this->redirect('login');
		echo $this->redirect('con');//die();
	}
	// trang hóa đơn sản phảm
	function order(){
		if($this->Session->check('username')){
			$user=$this->Session->read('username');
			$this->set('user',$user);
		}else{
			$this->render('login');
		}
		// khai báo các luật để paginate data ra view
		$this->paginate=array(
			'limit'=>'4',
			'joins'=>$this->Order->join,
			'fields'=>array('Order.*','OrderDetail.*'),
			'order'=>array('id'=>'asc')
		);
			//thực hiện phân trang
		$data=$this->paginate('Order');
		$this->set('data',$data);
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}
	//thực hiện thêm sản phẩm
	function create_product(){
		$error=array();
		if($this->request->is('post')){
			$data=$this->request->data;
			if(!empty($data)){
				$product_name=$data['product_name'];
				$order_code=$data['order_code'];
				$dataOrder_detail=array(
					'order_id'=>null,
					'product_name'=>$data['product_name'],
					'amount'=>$data['amount'],
					'quantity'=>$data['quantity']
				);
				$dataOrder=array(
					'order_code'=>$data['order_code']
				);
				$this->OrderDetail->set($dataOrder_detail);
				$this->Order->set($dataOrder);
				if(!$this->Order->validates()){
					$error['Order']=$this->Order->validationErrors;
				}
				if(!$this->OrderDetail->validates()){
					$error['OrderDetail']=$this->OrderDetail->validationErrors;
				}
				if(empty($error)){
					if($this->OrderDetail->check_product_name($product_name)==false && $this->Order->check_order_code($order_code)==false){
						$this->Order->create();
						if($this->Order->save($dataOrder)){
							$dataOrder_detail['order_id']=$this->Order->id;
							$this->OrderDetail->save($dataOrder_detail);
						}
					}
				}
			}
		}else{
			$this->Session->setFlash('Tạo sản phẩm không thanh công !');
		}
		echo '<pre>';
		print_r($error);
		echo '</pre>';
		$this->set('error',$error);
	}
	function edit($id=null){
			//die($id);
		$data=$this->Order->find('all',array(
			'joins'=>$this->Order->join,
			'conditions'=>array('OrderDetail.id'=>$id),
			'fields'=>array('Order.*','OrderDetail.*')
		));
		$error=array();
		if($this->request->is('post')){
			$dataValue=$this->request->data;
			if(!empty($dataValue)){
				$product_name=$dataValue['product_name'];
				$order_code=$dataValue['order_code'];
				//
				$dataOrder=array(
					'order_code'=>$dataValue['order_code']
				);
				//
				$dataOrderDetail=array(
					'product_name'=> $dataValue['product_name'],
					'amount'=>$dataValue['amount'],
					'quantity'=>$dataValue['quantity']
				);
				$this->Order->set($dataOrder);
				$this->OrderDetail->set($dataOrderDetail);
				if(!$this->Order->validates()){
					$error['Order']=$this->Order->validationErrors;
				}
				if(!$this->OrderDetail->validates()){
					$error['OrderDetail']=$this->OrderDetail->validationErrors;
				}
				if(empty($error)){die($this->Order->check_order_code($order_code));
					if($this->Order->check_order_code($order_code)==false && $this->OrderDetail->check_product_name($product_name)==false){//die($order_code);////////////
						//$dataOrder['order_code'] = '"'.$dataOrder['order_code'].'"';
						$this->Order->id=$data['0']['OrderDetail']['order_id'];
						if($this->Order->save($dataOrder)){
							$this->OrderDetail->id=$id;
							$this->OrderDetail->save($dataOrderDetail);
						}
					}
				}else{
					$this->Session->setFlash('Bạn đã Updatte thành công');
				}
			}
		}else {
			$this->Session->setFlash('Update không thành công vui lòng kiểm tra lại !');
		}

		$this->set('data',$data);
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		echo '<pre>';
		print_r($id);
		echo '</pre>';
		echo '<pre>';
		print_r($dataValue);
		echo '</pre>';
		echo '<pre>';
		print_r($error);
		echo '</pre>';
	}
}
?>