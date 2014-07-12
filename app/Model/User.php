<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('AppModel', 'Model');

class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'isUnique' => array(
            	'rule' => array('isUnique'),
                'message' => 'This username is already taken'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )
        ),
        'postcode' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Postcode cannot be empty'
            )
        ),
        'state' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'State cannot be empty'
            )
        ),
        'age' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Age cannot be empty'
            )
        ),
        'gender' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Gender cannot be empty'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'user')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new SimplePasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}
}

?>