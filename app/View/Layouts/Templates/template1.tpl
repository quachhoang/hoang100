<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$pagetitle}</title>
</head>

<script type="text/javascript">
    var SITE_URL = '{$smarty.const.SITE_URL}';
</script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}js/jquery.xml2json.js"></script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}js/jquery.selectboxes.js"></script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}js/jquery.validate.js"></script>

<script type="text/javascript" src="{$smarty.const.SITE_URL}js/common.validate.js"></script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}js/constants.js"></script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}js/japan/message.js"></script>

<script type="text/javascript" src="{$smarty.const.SITE_URL}js/common.js"></script>
<script type="text/javascript" src="{$smarty.const.SITE_URL}js/japan/form.js"></script>

<link type="text/css" rel="stylesheet" href="{$smarty.const.SITE_URL}css/domain/domain.css"/>
<body>
<div id="wrapper">
	<div id="header">
    	<div style="margin-left:22px;" class="logo">
        <!--	<a href="http://tenten.vn/" target="_blank"><img src="{$smarty.const.SITE_URL}images/logo_domain.png" border="0"/></a> -->
        </div>
        <div class="right_header">
        	Bạn đăng nhập với tên miền [{$domainName}] <a href="{$smarty.const.SITE_URL}logins/logout">Thoát</a>
        </div>
    </div><!-- End #header -->
    
            {$content_for_layout}

    <div id="footer" style="font-style:normal !important">
    	<div class="footer_login">
           <!--  Bản quyền thuộc về Công Ty Cổ Phần GMO RUNSYSTEM <br />Thành viên của tập đoàn GMO Internet TSE:9449.<br /> -->
        </div>
    </div><!-- End #footer -->
</div><!--- End #wrapper -->
</body>
</html>