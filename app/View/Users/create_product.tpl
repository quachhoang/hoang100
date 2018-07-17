<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thêm sản phẩm</title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/register.css">
</head>
<body>
	<div class="content">
		<div class="login"><b>Thêm sản phẩm</b></div>
		<form action="" method="post" name="register">
			<div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label">Tên sản phẩm</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="Username" placeholder="Tên sản phẩm" required="" name="product_name">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label">Số tiền</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputPassword3" placeholder="Số tiền" required="" name="amount">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label">Số lượng</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputEmail3" placeholder="Số lượng" required="" name="quantity">
				</div>
			</div>
			<div class="form-group row">
				<label for="inputPassword3" class="col-sm-2 col-form-label">Mã đơn hàng</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="inputPassword3" placeholder="Mã đơn hàng" required="" name="order_code">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-sm-10 inputt">
					<button type="submit" name="submit" class="btn btn-primary">Sign in</button>
				</div>
			</div>
		</form>
	</div>
</body>
</html>