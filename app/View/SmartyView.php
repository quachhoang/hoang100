<?php
App::uses('View', 'View');
//App::uses('String', 'Utility');
App::uses('CakeText', 'Utility');

class SmartyView extends View {
		function __construct (&$controller) {
		    parent::__construct($controller);
            if ($controller) {
                $this->theme = $controller->theme;
                $this->layoutPath = $controller->theme;
            }
		    if(!App::import('Vendor', 'Smarty', array('file' => 'smarty'.DS.'SmartyBC.class.php')))
		        die('error Loading Smarty Class');
		    
            $this->Smarty = new SmartyBC();
		    $this->ext= '.tpl';

		    $this->Smarty->plugins_dir = VENDORS.DS.'smarty'.DS.'plugins';
		    $this->Smarty->compile_dir = TMP.'smarty'.DS.'compile'.DS;
		    $this->Smarty->cache_dir = TMP.'smarty'.DS.'cache'.DS;
		    $this->Smarty->error_reporting = 'E_ALL & ~E_NOTICE';
		    $this->Smarty->debugging = false;
            $this->Smarty->caching = false; 
		    $this->Smarty->compile_check = true;
            //$this->Smarty->left_delimiter = '<!--{'; 
            //$this->Smarty->right_delimiter = '}-->'; 

            $this->set('SESSION_ID', @session_id());
            $this->set('SESSION_NAME', @session_name());
            $this->set('TOKEN', CakeText::uuid());
            $this->set('SITE_URL', SITE_URL);
            
            if (! $this->Smarty->get_template_vars('objView')) {
                $this->Smarty->assign('objView', $this);
            }
            
		    $this->viewVars['params'] = $this->params;
		}
        
		protected function _render($___viewFn, $___dataForView = array()) { // I want that element will not use Smarty because they can have some php and developing logic so I use this tree line to process it with the cake rendering. Probably it isn't so nice but I don't know a better way
			$trace=debug_backtrace();
			$caller=array_shift($trace);
			if ($caller==="element") parent::_render($___viewFn, $___dataForView);
			if (empty($___dataForView)) {
		        $___dataForView = $this->viewVars;

		    }

		    extract($___dataForView, EXTR_SKIP);

		    foreach($___dataForView as $data => $value) {
		        if(!is_object($data)) {
		            $this->Smarty->assign($data, $value);
		        }
		    }
		    ob_start();

		    $this->Smarty->display($___viewFn);

		    return ob_get_clean();
		}
		/* protected function _getLayoutFileName($name = null) {

		} */


/**
 * Return all possible paths to find view files in order
 *
 * @param string $plugin The name of the plugin views are being found for.
 * @param boolean $cached Set to true to force dir scan.
 * @return array paths
 * @todo Make theme path building respect $cached parameter.
 */
    protected function _paths($plugin = null, $cached = true) {
        $paths = parent::_paths($plugin, $cached);
        $themePaths = array();

        if (!empty($this->theme)) {
            $count = count($paths);
            for ($i = 0; $i < $count; $i++) {
                if (strpos($paths[$i], DS . 'Plugin' . DS) === false
                    && strpos($paths[$i], DS . 'Cake' . DS . 'View') === false) {
                        if ($plugin) {
                            $themePaths[] = $paths[$i] . $this->theme . DS . 'Plugin' . DS . $plugin . DS;
                        }
                        $themePaths[] = $paths[$i] . $this->theme . DS;
                    }
            }
            $paths = array_merge($themePaths, $paths);
        }
        
        return $paths;
    }

}