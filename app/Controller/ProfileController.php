<?php
class ProfileController extends AppController {
	
	public $uses = array('User');
	
	public function index() {
		if ($this->request->is('post')) {
            $this->User->create();
            $data = $this->request->data;
            $data['User']['id'] = $this->user['id'];
            if(isset($data['User']['is_carer']) && $data['User']['is_carer'] == 'on') {
	            $data['User']['is_carer'] = 1;
            } else {
	            $data['User']['is_carer'] = 0;
            }
            if(isset($data['User']['is_disabled']) && $data['User']['is_disabled'] == 'on') {
	            $data['User']['is_disabled'] = 1;
            } else {
	            $data['User']['is_disabled'] = 0;
            }
            if($data['User']['password'] == '') {
	            unset($data['User']['password']);
            }
            $data['User']['role'] = 'user';
            if ($this->User->save($data)) {
                $this->Session->setFlash(__('Profile Updated'));
                return $this->redirect(array('controller'=>'profile','action'=>'index'));
            }
            $this->Session->setFlash(
                __('This username is already taken.')
            );
        }
		$profile = $this->User->findById($this->user['id']);
		$this->set('profile',$profile);
	}
	
}
?>