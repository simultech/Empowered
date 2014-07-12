<?php

class RegisterController extends AppController {

	public $uses = array('User');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'register');
    }

	public function index() {
        if ($this->request->is('post')) {
            $this->User->create();
            $data = $this->request->data;
            if($data['User']['is_carer'] == 'on') {
	            $data['User']['is_carer'] = 1;
            }
            if($data['User']['is_disabled'] == 'on') {
	            $data['User']['is_disabled'] = 1;
            }
            $data['User']['role'] = 'user';
            if ($this->User->save($data)) {
            	$this->Auth->login($data);
                $this->Session->setFlash(__('Thank you joining our community!'));
                return $this->redirect('/');
            }
            $this->Session->setFlash(
                __('This username is already taken.')
            );
        }
    }
}