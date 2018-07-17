<?php
/**
* RunHelper.php
* Component encrypt and decrypt string with blowfish algorithm
* @since 1.0 2011/11/11
* @author Ngoctd
* $Id: $
*/
App::uses('String', 'Utility');
App::uses('Inflector', 'Utility');
App::uses('I18n', 'I18n');

class RunHelper extends  Object {
    
    function getIPAddress() {
        $ip = '';
        if( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) AND strlen($_SERVER['HTTP_X_FORWARDED_FOR'])>6 ){
            $ip = strip_tags($_SERVER['HTTP_X_FORWARDED_FOR']);
        }elseif( !empty($_SERVER['HTTP_CLIENT_IP']) AND strlen($_SERVER['HTTP_CLIENT_IP'])>6 ){
            $ip = strip_tags($_SERVER['HTTP_CLIENT_IP']);
        }elseif(!empty($_SERVER['REMOTE_ADDR']) AND strlen($_SERVER['REMOTE_ADDR'])>6){
            $ip = strip_tags($_SERVER['REMOTE_ADDR']);
        }
        return strip_tags($ip);
    }

    public static function synVariabe($string)
    {
        if (is_string($string)) 
            return Inflector::variable($string);
        elseif (is_array($string)) {
            $out = array();
            foreach ($string as $key=>$val) {
                $out[Inflector::variable($key)] = $val;
            }
            return $out;
        }
        return false;
    }
    
    public static function underscoreVariabe($string)
    {
        if (is_string($string)) 
            return Inflector::underscore($string);
        elseif (is_array($string)) {
            $out = array();
            foreach ($string as $key=>$val) {
                $out[Inflector::underscore($key)] = $val;
            }
            return $out;
        }
        return false;
    }
    
    public static function stringRandom($length = 6)
    {
        $length = is_integer($length) ? $length : 6;
        $str = 'abcdefghijkmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0, $passwd = ''; $i < $length; $i++)
        $passwd .= RunHelper::substr($str, mt_rand(0, RunHelper::strlen($str) - 1), 1);
        return $passwd;
    }

    public static function strlen($str, $charset = 'utf-8')
    {
        if (empty ($str) || is_array($str))
        return false;
        if (function_exists('mb_strlen'))
        return mb_strlen($str, $charset);
        return strlen($str);
    }
    
    public static function substr($str, $start, $length = false, $encoding = 'utf-8')
    {
        if (empty ($str) || is_array($str))
        return false;
        if (function_exists('mb_substr'))
        return mb_substr($str, intval($start), ($length === false ? RunHelper::strlen($str) : intval($length)), $encoding);

        return substr($str, $start, $length);
    }
    
    public static function writeFile($filename, $content, $mode = 'w')
    {
        $ret = true;
        if (!$handle = fopen($filename, $mode)) {
             return false;
        }
        // Write $somecontent to our opened file.
        if (fwrite($handle, $content) === FALSE) {
            return false;
        }
        fclose($handle);
        return $ret;
    }    
    
    public static function getMySqlVersion()
    {
        ob_start();
        phpinfo(INFO_MODULES);
        $info = ob_get_contents();
        ob_end_clean();
        $info = stristr($info, 'Client API version');
        preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match);
        $version = $match[0];
        return $version;
    }
    
    public static function getServerVersion()
    {
        $ver = split("[/ ]",$_SERVER['SERVER_SOFTWARE']);
        $version = "$ver[1] $ver[2]";
        return $version;
    }
    
    public static function convertVietNamToEnglish($str , $is_array = null){
       $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
       );
       foreach($unicode as $nonUnicode=>$uni){
       		if($is_array){
       			foreach ($str as $key => $value){
       				$str[$key] = preg_replace("/($uni)/i", $nonUnicode, $str[$key]);
       			}
       		}else
            	$str = preg_replace("/($uni)/i", $nonUnicode, $str);
       }
       return $str;
    }
    
    public static function getExt($filename)
    {
        if(empty($filename) || $filename == '.' || $filename == '..')
            return false;
        $fileinfo = pathinfo($filename);
        $ext = isset($fileinfo['extension']) ? $fileinfo['extension'] : null;
        if ($ext) return $ext;

        $ext = false;
        if (stripos($filename, ".") !== false) {
            $ext = explode('.', $filename);
            $ext = $ext[count($ext)-1];
        }
        return $ext;
    }
    

}