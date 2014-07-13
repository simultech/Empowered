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
	public $uses = array('Ingest');

	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => '/',
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
    	if($controller == 'register') {
	    	$this->active = 'register';
    	}
        $this->Auth->allow('index', 'view','home','awareness','information','viewpost','getCarerAllowancePaymentsReceived');
        $this->user = $this->Auth->user();
        if(isset($this->user['User'])) {
	        $this->user = $this->user['User'];
        }
        if($this->user) {
	        $this->loggedIn = true;
        } else {
	        $this->loggedIn = false;
        }
    }

    public function findIngests($keywords) {
	    $ingest = $this->Ingest->find('first',array('conditions'=>array('keywords LIKE "%'.$keywords.'%"'),'limit'=>'1','order'=>'rand()'));
	    if(empty($ingest)) {
		    $ingest['Ingest'] = null;
	    }
	    return $ingest['Ingest'];
    }

    public function saveIngest($content,$backlink,$source) {
    	//$this->saveIngest('hello how are you today I am good thanks bye','http://google.com','Government Data');
    	$keywords = array_diff(split(' ', strtolower(preg_replace("/[^A-Za-z ]/", '',$content))),$this->stopwords);
	    $signature = md5($content.$backlink.$source);
	    $data = array(
	    	'content'=>$content,
	    	'source'=>$source,
	    	'backlink'=>$backlink,
	    	'signature'=>$signature,
	    	'keywords'=>$keywords
	    );
	    try {
		    $this->Ingest->save($data);
		} catch (Exception $e) {

		}
    }

    public function beforeRender() {
	    $this->set('loggedIn',$this->loggedIn);
	    $this->set('user',$this->user);
	    $this->set('active',$this->active);
    }

    var $stopwords = array("i", "a", "about", "above", "above", "across", "after", "afterwards", "again", "against", "all", "almost", "alone", "along", "already", "also","although","always","am","among", "amongst", "amoungst", "amount",  "an", "and", "another", "any","anyhow","anyone","anything","anyway", "anywhere", "are", "around", "as",  "at", "back","be","became", "because","become","becomes", "becoming", "been", "before", "beforehand", "behind", "being", "below", "beside", "besides", "between", "beyond", "bill", "both", "bottom","but", "by", "call", "can", "cannot", "cant", "co", "con", "could", "couldnt", "cry", "de", "describe", "detail", "do", "done", "down", "due", "during", "each", "eg", "eight", "either", "eleven","else", "elsewhere", "empty", "enough", "etc", "even", "ever", "every", "everyone", "everything", "everywhere", "except", "few", "fifteen", "fify", "fill", "find", "fire", "first", "five", "for", "former", "formerly", "forty", "found", "four", "from", "front", "full", "further", "get", "give", "go", "had", "has", "hasnt", "have", "he", "hence", "her", "here", "hereafter", "hereby", "herein", "hereupon", "hers", "herself", "him", "himself", "his", "how", "however", "hundred", "ie", "if", "in", "inc", "indeed", "interest", "into", "is", "it", "its", "itself", "keep", "last", "latter", "latterly", "least", "less", "ltd", "made", "many", "may", "me", "meanwhile", "might", "mill", "mine", "more", "moreover", "most", "mostly", "move", "much", "must", "my", "myself", "name", "namely", "neither", "never", "nevertheless", "next", "nine", "no", "nobody", "none", "noone", "nor", "not", "nothing", "now", "nowhere", "of", "off", "often", "on", "once", "one", "only", "onto", "or", "other", "others", "otherwise", "our", "ours", "ourselves", "out", "over", "own","part", "per", "perhaps", "please", "put", "rather", "re", "same", "see", "seem", "seemed", "seeming", "seems", "serious", "several", "she", "should", "show", "side", "since", "sincere", "six", "sixty", "so", "some", "somehow", "someone", "something", "sometime", "sometimes", "somewhere", "still", "such", "system", "take", "ten", "than", "that", "the", "their", "them", "themselves", "then", "thence", "there", "thereafter", "thereby", "therefore", "therein", "thereupon", "these", "they", "thickv", "thin", "third", "this", "those", "though", "three", "through", "throughout", "thru", "thus", "to", "together", "too", "top", "toward", "towards", "twelve", "twenty", "two", "un", "under", "until", "up", "upon", "us", "very", "via", "was", "we", "well", "were", "what", "whatever", "when", "whence", "whenever", "where", "whereafter", "whereas", "whereby", "wherein", "whereupon", "wherever", "whether", "which", "while", "whither", "who", "whoever", "whole", "whom", "whose", "why", "will", "with", "within", "without", "would", "yet", "you", "your", "yours", "yourself", "yourselves", "the");
}
