<?php
class InformationController extends AppController {
	
	public function beforeFilter() {
		$this->Auth->allow('index','events','parks','hospitals','allowance','statistics','needs','types');
		parent::beforeFilter();
	}
	
	public function index() {
		
	}
	
	public function events() {
		$blah = file_get_contents('files/style.css');
		$data = array('1','2','3');
		$this->set('data',$data);
		print_r($blah);
	}
	
	public function parks() {
		$rssfeed = 'http://feeds.news.com.au/public/rss/2.0/news_national_3354.xml';
		$data = $this->parseRSS($rssfeed);
		//merge datasets
		$newdata = array();
		//sort by something
		//http://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
		$data = array_merge($data,$newdata);
		$this->set('data',$data);
	}
	
	public function hospitals() {
		
	}
	
	public function allowance() {
		
	}
	
	public function statistics() {
		
	}
	
	public function needs() {
		
	}
	
	public function types() {
		
	}
	
	function parseRSS($rssfeed) {
		$xml = simplexml_load_file($rssfeed);
		$items = array();
		for($i=0; $i<sizeOf($xml->channel->item); $i++) {
			$item = array();
			$item['title'] = $xml->channel->item[$i]->title.'';
			$item['link'] = $xml->channel->item[$i]->link.'';
			$item['description'] = $xml->channel->item[$i]->description.'';
			$item['date'] = $xml->channel->item[$i]->pubDate.'';
			$items[] = $item;
		}
		return $items;
	}
}
?>