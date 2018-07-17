<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Trang Login</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/login1.css">
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/jquery-3.3.1.slim.min.js"></script>
</head>
<body>
	<div class="content">
   <div class="login"><b>Login</b></div>
      <form method="post" action="" name="login">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputEmail3" placeholder="username" required="" name="username">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" required="" name="password">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 inputt">
            <button type="submit" class="btn btn-primary id="submit" ">Sign in</button>
            <div class="error1">{$error}</div>
          </div>
        </div>
      </form>
  </div>
</body>
</html>