<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../pages_css/bootstrap.min.css">
	<link rel="stylesheet" href="../pages_css/page.css">
	<script src="../page_js/bootstrap.min.js"></script>
	<script src="../page_js/jquery.min"></script>
	
</head>
<body>
	<div class="container-fluid">
		<div class="row content">
			<div class="col-sm-3 sidenav">
				<h5><b>Chickenrain Xin chào</b></h5>
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="" title="">Trang chủ</a></li>
					<li><a href="create_product" title="">Thêm sản phẩm</a></li>
					<li><a href="" title="">Đăng ký thành viên</a></li>
					<li><a href="logout">logout</a></li>
				</ul><br>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search Blog..">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</span>
				</div>
			</div>

			<div class="col-sm-9">
				<h2><small>Danh sách Đơn hàng</small></h2>
				<hr>
				<div class="container container1">
					<table class="table">
						<thead class="thead-dark">
							<tr>
								<th>STT</th>
								<th>order_code</th>
								<th>product_name</th>
								<th>amount</th>
								<th>quantity</th>
								<th>status</th>
								<th>edit/delete</th>
							</tr>
						</thead>
						<tbody>
							{foreach $data as $key => $value}
							<tr>
								<th>{$key+1}</th>
								<th>{$value.Order.order_code}</th>
								<th>{$value.OrderDetail.product_name}</th>
								<th>{$value.OrderDetail.amount}</th>
								<th>{$value.OrderDetail.quantity}</th>
								<th>{$value.OrderDetail.status}</th>
								<th><a href="../users/edit/{$value.OrderDetail.id}" title="">edit</a> | <a href="" title="">delete</a></th>
							</tr>
							{/foreach}
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<footer class="container-fluid">
		<p>Footer Text</p>
	</footer>
</body>
</html>