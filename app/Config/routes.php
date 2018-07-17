<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'Users', 'action' => 'login'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	// Router::connect('/master_login/:action', array('controller' => 'MasterLogin'));
 //    Router::connect('/login', array('controller' => 'MasterLogin', 'action' => 'login'));
 //    Router::connect('/admin_login', array('controller' => 'MasterLogin', 'action' => 'loginAdmin'));
 //    Router::connect('/auto_login', array('controller' => 'MasterLogin', 'action' => 'auto_login'));
 //    Router::connect('/logout', array('controller' => 'MasterLogin', 'action' => 'logout'));
 //    Router::connect('/check_email', array('controller' => 'MasterLogin', 'action' => 'check_email'));
    
	// Router::connect('/reminder_password', array('controller' => 'MasterLogin', 'action' => 'reminderPassword'));
	// Router::connect('/password_sent', array('controller' => 'MasterLogin', 'action' => 'passwordSent'));	


	// // for all
	// Router::connect('/:controller/:action/*');
	// Router::connect('/search/:action', array('controller' => 'Search'));
	
/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
//	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
// echo CAKE;

	require CAKE . 'Config' . DS . 'routes.php';
