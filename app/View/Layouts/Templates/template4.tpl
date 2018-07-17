<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>{$pagetitle}</title>
        <link href="{$smarty.const.SITE_URL}css/style.css" rel="stylesheet" type="text/css" media="all" />
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
        <link type="text/css" rel="stylesheet" href="{$smarty.const.SITE_URL}css/domain/change_pass.css"/>
        <link type="text/css" rel="stylesheet" href="/email-server/fontawesome/css/font-awesome.min.css">
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
               <!-- <div style="margin-left:22px;"  class="logo">
                    <img src="https://domain.tenten.vn/images/n_logo.png">
                </div> -->
                <div class="right_header">
                    <i class="fa fa-user" aria-hidden="true"></i> {$accountInfo['login_id']} 
                    <a href="{$smarty.const.SITE_URL}/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát</a>
                </div>
            </div>
            <!-- End #header -->

            {$content_for_layout}
            <div id="footer" style="font-style:normal !important">
                <div id="footer" style="font-style: normal!important; margin-top: 20px">
                    <div class="footer_login">
                       <!--  Bản quyền thuộc về Công Ty Cổ Phần GMO-Z.com RUNSYSTEM. Thành viên của tập đoàn GMO Internet TSE:9449. -->
                    </div>
                </div>
            </div>
            <!-- End #footer -->
            {$sql_dump}
        </div>
        <!--- End #wrapper -->
    </body>
</html>