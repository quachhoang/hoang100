<?php
class PagerComponent extends Component {
	public $components = array('Session');
    public $controller; 
    
    var $now_page;
    var $max_page;
    var $start_row;
    var $strnavi;
    var $strresult;
    var $arrPagenavi = array();
    var $limit;
    var $total_row;
    var $pageUrl;

    //called before Controller::beforeFilter()
    function initialize(&$controller, $settings = array()) {
        // saving the controller reference for later use
        $this->controller =& $controller;
    }
    
    /*
	 * $items: array data
	 * $pageno Current page
	 * $per_page : number record in page
	 */
	function Pager($total_row, $limit, $now_page =1, $func_name = '', $pageUrl = '', $params = array(), $navi_max = 10){
        $this->arrPagenavi['mode'] = 'search';
        if (empty($pageUrl)) {
            $pageUrl = htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES);
            if (! empty($params)) {
                $pageUrl .= "?";
                foreach ($params as $key=>$val)
                {
                    $pageUrl .= "&$key=$val";
                }
            }
        }
        else
        {
            if (stripos($pageUrl, '?') === FALSE && $func_name == '') {
                $pageUrl .= "?";
            }
        }
        $this->pageUrl = $pageUrl;

        $now_page = trim($now_page);
        $now_page = $now_page && is_numeric($now_page) ? $now_page : 1;
        $this->now_page = $now_page;

        $this->arrPagenavi['now_page'] = $this->now_page;

        $this->limit = $limit;
        $this->total_row = $total_row;
        $this->max_page = ceil($total_row/$limit);

        if($this->max_page > 0 && isset($_REQUEST['pageno']) && $now_page > $this->max_page ) {
            if(!isset($_REQUEST['isAjax']))
                $this->controller->redirect(SITE_URL);
            else{
                die('Truy cập trang không tồn tại!');
                exit;
            }
        }

        if($this->max_page < $this->now_page) {
            $this->now_page = 1;
        }

        $this->start_row = ($this->now_page - 1) * $limit;

        if (!($this->start_row < $total_row && $this->start_row >= 0)) {
            $this->start_row = 0;
        }

        if($total_row > 1) {
            $before = "";
            $next = "";
            if ($this->now_page > 1) {
                if($func_name !='') {
                    $before.= "<a class=\"page\" href=\"". $this->pageUrl . "\" onclick=\"$func_name('" . (($this->now_page) - 1) . "'); return false;\"> Trước</a> ";
                }else{
                    $before.="<a class=\"page\" href=\"".  $this->pageUrl . "&pageno=" . (($this->now_page) - 1) . "\">Trước</a> ";
                }
                $this->arrPagenavi['before'] = ($this->now_page) - 1;
            }else{
                $this->arrPagenavi['before'] = $this->now_page;
            }

            if ($this->now_page < $this->max_page) {
                if($func_name !='') {
                    $next.= "<a class=\"page\" href=\"". $this->pageUrl . "\" onclick=\"$func_name('" . (($this->now_page) + 1) . "'); return false;\">Tiếp</a> ";
                }else{
                    $next.="<a class=\"page\" href=\"".  $this->pageUrl . "&pageno=" . (($this->now_page) + 1) . "\">Tiếp</a> ";
                }
                $this->arrPagenavi['next'] = ($this->now_page) + 1;
            }else{
                $this->arrPagenavi['next'] = $this->now_page;
            }

            if($navi_max == "" || $navi_max > $this->max_page) {
                $disp_max = $this->max_page;
            } else {
                $disp_max = $this->now_page + $navi_max - 1;
                if($disp_max > $this->max_page) {
                    $disp_max = $this->max_page;
                }
            }
            if($this->max_page > $navi_max) {
                if($navi_max == "" ||  ceil($navi_max/2) > $this->now_page) {
                    $disp_min = 1;
                } else {
                    $disp_min = $this->now_page - ceil($navi_max/2) + 1;
                }
                $disp_max = $disp_min + $navi_max -1;
                if($disp_max > $this->max_page) {
                    $disp_max = $this->max_page;
                    $disp_min = $this->max_page - $navi_max + 1;
                }
            }else {
                $disp_min = 1;
                $disp_max = $this->max_page;
            }

                
            $this->arrPagenavi['arrPageno'] = array();
            $page_number = "";
            for ($i=$disp_min; $i <= $disp_max; $i++) {

                if($i != $disp_max) {
                    $sep = " | ";
                } else {
                    $sep = "";
                }

                if ($i == $this->now_page) {
                    $page_number .= "<strong class=\"current\">$i</strong>";
                } elseif($func_name !='') {
                    $page_number.="<a class=\"page\" href=\"".  $this->pageUrl . "\" onclick=\"$func_name('$i'); return false;\">$i</a>";
                }else{
                    $page_number.="<a class=\"page\" href=\"".  $this->pageUrl . "&pageno=$i\">$i</a> ";
                }

                $page_number.=$sep;

                $this->arrPagenavi['arrPageno'][$i] = $i;
            }
            $lastPage = $firstPage = '';
            if ($this->max_page > $navi_max){
                if($this->now_page != $this->max_page){
                    if($func_name !='') {
                        $lastPage.= "<a class=\"page\" href=\"". $this->pageUrl . "\" onclick=\"$func_name('" . ($this->max_page) . "'); return false;\"> Cuối</a> ";
                    }else{
                        $lastPage.="<a class=\"page\" href=\"".  $this->pageUrl . "&pageno=" . ($this->max_page) . "\"> Cuối</a> ";
                    }
                }
                if($this->now_page != 1){
                    if($func_name !='') {
                        $firstPage.= "<a class=\"page\" href=\"". $this->pageUrl . "\" onclick=\"$func_name('" . (1) . "'); return false;\">Đầu</a> ";
                    }else{
                        $firstPage.="<a class=\"page\" href=\"".  $this->pageUrl . "&pageno=" . (1) . "\">Đầu</a> ";
                    }
                }
            }

            if ($before || $next) {
                $this->strnavi = $firstPage. $before .$page_number .$next . $lastPage;
            }
        }else{
            $this->arrPagenavi['arrPageno'][0] = 1;
            $this->arrPagenavi['before'] = 1;
            $this->arrPagenavi['next'] = 1;
        }
        
        if ($this->max_page > 1) {
            if ($this->now_page == ($this->max_page))
            {
                $end_row = $this->total_row;
            }
            else {
                $end_row = $this->now_page * $this->limit;
            }
        }
        else {
            $end_row = $this->total_row;
        }
        $this->strresult = $this->total_row .'Hiển thị từ '. ($this->start_row +1) .' đến '. ($end_row). '';
        return $this->strnavi;
	}
	
    public function getStringNavi($url = '')
    {
        $strnavi = '<table class="tablepagging" width="100%" border="0" >';
        if((int)$this->total_row > 0 ) {
            $strnavi .= '<tr><td>' . $this->strresult . '</td></tr>';
        }
        
         
        $strnavi .= '<tr><td>' .$this->strnavi . '</td></tr>';
        if (! empty($url)) {
            $strnavi = str_replace($this->pageUrl, $url, $strnavi);
        }
        $strnavi .='</table>';
        return $strnavi;
    }

    public function getStringResult()
    {
        return $this->strresult;
    }

    public function getPageNavi()
    {
        return $this->arrPagenavi;
    }

	
	
	// create record per page combobox
	public function createHtmlRPP($keySearch = ''){
		$rpp = isset ($_REQUEST['rpp'])&& is_numeric($_REQUEST['rpp']) ?$_REQUEST['rpp'] : MAX_PER_PAGE;
		$arrRpp = Configure::read('Pager.rpp');
        
		return $this->BlowFish->createHtmlSelect2("rpp", $arrRpp, $rpp,"rpp","rpp srv_calendarY",'onchange="onChangeRpp(this.value);"',FALSE);
	}
	
	// get image asc or desc
	public function createImageOrder($orderName,$keySearch = ''){
		
		//if ($orderName == 0 || $orderName == 2){
			$imgSortName = '<img alt="'.$orderName.'" id="sortName" onClick="onOrderName(1, \'' . $keySearch . '\')" width="15" height="15" src="'.SITE_URL.'images/japan/dom_ico_up.gif">';
		//}
		if ($orderName == 1){
			$imgSortName = '<img alt="'.$orderName.'" id="sortName" onClick="onOrderName(2, \'' . $keySearch . '\')" width="15" height="15" src="'.SITE_URL.'images/japan/dom_ico_down.gif">';
		}
		return $imgSortName;
	}
	
}
?>