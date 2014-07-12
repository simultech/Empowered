<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $loggedIn = false;
	public $active = 'home';
	public $user = array();

	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'posts',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'home',
            )
        )
    );

    public function beforeFilter() {
    	$controller = $this->request->params['controller'];
    	if($controller == 'awareness') {
	    	$this->active = 'awareness';
    	}
    	if($controller == 'information') {
	    	$this->active = 'information';
    	}
    	if($controller == 'community') {
	    	$this->active = 'community';
    	}
    	if($controller == 'users') {
	    	$this->active = 'login';
    	}
    	if($controller == 'profile') {
	    	$this->active = 'profile';
    	}
    	
        $this->Auth->allow('index', 'view','home','awareness','information');
        $this->user = $this->Auth->user();
        if($this->user) {
	        $this->loggedIn = true;
        } else {
	        $this->loggedIn = false;
        }
    }
    
    public function beforeRender() {
	    $this->set('loggedIn',$this->loggedIn);
	    $this->set('user',$this->user);
	    $this->set('active',$this->active);
    }
}
