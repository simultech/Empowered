<?php
class InformationController extends AppController {

	public function beforeFilter() {
		$this->Auth->allow('index','events','parks','hospitals','allowance','statistics','needs','types');
		parent::beforeFilter();
	}

	public function index() {

	}

	public function events() {
		//$data = $this->parsestuff('http://www.trumba.com/calendars/brisbane-festival.rss');
		$data = $this->parseXML('files/parks.xml');
		print_r($data);
		die();



		// $data = $this->parseRSS($rssfeed);
		// //merge datasets
		// $newdata = array();
		// //sort by something
		// //http://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
		// $data = array_merge($data,$newdata);
		// $this->set('data',$data);

		// $xml = new XMLReader;
		// $xml->open($rssfeed);
	// 	$xml->read();
	// //	$xml->getAttribute("title");
	// 	$data = $xml->getAttribute('title');
	// 	print $data;
	// 		$reader = new XMLReader();
	// 		$reader->open($rssfeed);
	// 		// $i = 0;
	// 		// $imax = 10;
	// 		// $output = "";
	//
	// 		while ($reader->read() && $reader->name !== 'title');
	//
	// 		while ($reader->name === 'title') {
	// 				echo $reader->name;
	// 		}
	//
	//
	// 		die();
	//
	// 		while ($reader->read()){
	// 		if ($reader->name == "title" && $reader->nodeType ==XMLReader::ELEMENT) {
	// 		  $data = $reader->read();
	// 			print_r($reader);
	// 			print_r($data);
	// 			die();
	// 			 // will get TITLE
	// 		}
	// 	}
	// //	print $data;
	// 	$this->set('data',$data);
			// while ($i++ < $imax) {
			// 	$output += $reader->read();
			// }
			$tree = new RecursiveIteratorIterator(
		    new SimpleXmlIterator($xml),
		    RecursiveIteratorIterator::SELF_FIRST
		);
		$items = array();
		$currentitem = null;
		foreach ($tree as $node) {
				switch($node->getName()) {
				case 'item':
					if($currentitem != null) {
						$items[] = $currentitem;
					}
					$currentitem = array();
					break;
				case 'title': $currentitem['title'] = $node;
				case 'description': $currentitem['description'] = $node;
				case 'link': $currentitem['link'] = $node;
		    //echo $node->getName(), PHP_EOL;
			}
		}
		print_r($items);
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

	public function sequentialReader($rssfeed){
		$xml = new XMLReader;
		$xml->open($rssfeed);

		//$xml->read();
		// while ($xml->read()) {
	  //       if ($xml->nodeType == XMLReader::ELEMENT) {
	  //              // print $xml->name.': ';
		//
	  //       } else if ($xml->nodeType == XMLReader::TEXT) {
	  //               //print $xml->value.PHP_EOL;
	  //       }
		// 		}
		return $xml;
	}

	function parseXML($rssfeed) {
		$limit = 20;
		$data = file_get_contents($rssfeed);
		$len = strlen($data);
		$data = substr($data,strpos($data,'<item>'));
		$items = array();
		$i = 0;
		while(strpos($data,'</item>') > -1) {
			$itemdata = substr($data,0,strpos($data,'</item>')+7);
			$item = array(
				'title'=>substr($itemdata,strpos($itemdata,'<title>')+7,strpos($itemdata,'</title>')-strpos($itemdata,'<title>')-7),
				'description'=>substr($itemdata,strpos($itemdata,'<description>')+13,strpos($itemdata,'</description>')-strpos($itemdata,'<description>')-13),
				'link'=>substr($itemdata,strpos($itemdata,'<link>')+6,strpos($itemdata,'</link>')-strpos($itemdata,'<link>')-6),
				'category'=>substr($itemdata,strpos($itemdata,'<category>')+10,strpos($itemdata,'</category>')-strpos($itemdata,'<category>')-10),
			);
			$data = substr($data,strpos($data,'</item>')+7);
			$i++;
			if($i > $limit) {
				break;
			}
			$items[] = $item;
		}
		return $items;
	}

	function parseRSS($rssfeed) {
		ini_set('memory_limit','128M');
		ini_set('max_execution_time', 300);
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
