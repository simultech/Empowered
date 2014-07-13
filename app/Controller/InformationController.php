<?php
class InformationController extends AppController {

	public $uses = array('Comment','User');

	public function beforeFilter() {
		$this->Auth->allow('index','events','parks','hospitals','allowance','statistics','needs','types');
		$this->userslist = $this->User->find('list',array('fields'=>array('id','username')));
		parent::beforeFilter();
	}

	public function index() {
		//parks
		$data = $this->parseXML(getcwd().'/files/parks.xml');
		foreach($data as &$item) {
			$item['state'] = 'qld';
			$item['date'] = html_entity_decode(substr($item['description'],0,strpos($item['description'],'&lt;br')));
			$item = $this->commentit($item);
		}
		$this->set('data',$data);
	}
	
	public function savecomment() {
		$data = array(
			'user_id'=>$this->user['id'],
			'comment'=>$_POST['text'],
			'sig'=>$_POST['sig'],
		);
		if($this->Comment->save($data)) {
			$html = '<div class="com"><p>'.$_POST['text'].'</p><p class="commeta">Posted by you just now.</p></div>';
			echo $html;
		} else {
			echo '{"saved":"false"}';
		}
		die();
	}

	public function parks() {
		/*
		$rssfeed = 'http://feeds.news.com.au/public/rss/2.0/news_national_3354.xml';
		$data = $this->parseRSS($rssfeed);
		//merge datasets
		$newdata = array();
		//sort by something
		//http://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
		$data = array_merge($data,$newdata);
		$this->set('data',$data);
		*/
		/*
		$parkStringOne = file_get_contents("file/dataset_park_facilties_part_1.csv");
		$data = csv_to_array($parkStringOne, ',');
		$parkStringTwo = file_get_contents("file/dataset_park_facilties_part_2.csv");
		$dataTwo = csv_to_array($parkStringTwo, ',');
		array_merge($data, $dataTwo);
		$this->set('data', $data);
		*/

		//fields
		//PR_NO, PARK_NAME, NODE_ID, NODE_USE, NODES_NAME, ITEM_ID, ITEM_TYPE, ITEMS_NAME, DESCRIPTION, EASTING	NORTHING, ORIG_FID, LONGITUDE, LATITUDE

		$header = NULL;
		$data = array();
		if (($handle = fopen("files/dataset_park_facilties_part_1.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;

				//laziest way to check for both DISABLED and DISABILITY
				} else if (strpos($row[7],"DISABL") !== false
						|| strpos($row[8],"isabl") !== false) {
						if(strpos($row[8], "small sign") === false) {
					//we only want info for parks with disabled access/whatnot
					$row = $this->commentit($row);
					$data[] = $row;
					}
				}
			}
			fclose($handle);
		}
		$header = NULL;
		//do it again for part 2
		if (($handle = fopen("files/dataset_park_facilties_part_2.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else if (strpos($row[7],"DISABL") !== false
						|| strpos($row[8],"isabl") !== false) {
					$row = $this->commentit($row);
					$data[] = $row;
				}
			}
			fclose($handle);
		}
		$this->set('data',$data);
	}
	
	function commentit($item) {
		$item['sig'] = md5(print_r($item,true));
			$item['comments'] = $this->Comment->findAllBySig($item['sig']);
			foreach($item['comments'] as &$comment) {
				$comment['Comment']['user_id'] = @$this->userslist[$comment['Comment']['user_id']];
			}
		return $item;
	}
	
	var $userslist = array();

	public function hospitals() {
		$this->userslist = $this->User->find('list',array('fields'=>array('id','username')));
		$geolookup = json_decode(file_get_contents('files/geo_cache.txt'));
		$csv = file_get_contents('files/immunisation_clincs.csv');
		$lines = split("\n", $csv);
		$data = array();
		foreach($lines as $line) {
			$item = array();
			$offset = 0;
			$cols = split(',',$line);
			if($cols[0] == 'id' || sizeOf($cols) < 3) {
				continue;
			}
			$item['name'] = '';
			for($i=1; $i<sizeOf($cols)-5; $i++) {
				$item['name'] .= $cols[$i];
			}
			$item['name'] = str_replace('"', '', $item['name']);
			$item['lat'] = $cols[sizeOf($cols)-2];
			$item['lng'] = $cols[sizeOf($cols)-1];
			$item['title'] = 'Immunisation Clinic';
			$item['state'] = 'qld';
			$item = $this->commentit($item);
			$data[] = $item;
		}
		$togeocache = $geolookup;
		$csv = file_get_contents('files/publichospitalsinaihwhospitalsdatabase1213.csv');
		$lines = split("\n", $csv);
		foreach($lines as $line) {
			$item = array();
			$offset = 0;
			$cols = split(',',$line);
			if($cols[0] == 'State' || sizeOf($cols) < 3) {
				continue;
			}
			$item['title'] = $cols[1].' '.$cols[4];
			$item['state'] = strtolower($cols[0]);
			$item['address'] = $cols[6].' '.$cols[7].' '.$cols[0];
			$item['name'] = $cols[1].' - '.$item['address'];
			$hash = 'z'.md5($item['address']);
			if(!isset($geolookup->$hash)) {
				$addr = str_replace(" ", "+", $item['address'].' Australia');
				$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$addr.'&key=AIzaSyCbsqfxbxr3WXtWEbMmNpA9uYPUDah9dO4';
				$geo = json_decode(file_get_contents($url));
				try {
					$item['lat'] = $geo->results[0]->geometry->location->lat;
					$item['lng'] = $geo->results[0]->geometry->location->lng;
					$togeocache->$hash = array($item['lat'],$item['lng']);
				} catch (Exception $e) {
					echo '<h1>google API limit hit</h1>';
					print_r(json_encode($togeocache));
					die();
				}
			} else {
				$obj = $togeocache->$hash;
				$item['lat'] = $obj[0];
				$item['lng'] = $obj[1];
			}
			$item = $this->commentit($item);
			$data[] = $item;
		}
		$geolookup = file_put_contents('files/geo_cache.txt', json_encode($togeocache));

		$this->set('data',$data);
	}

	public function allowance() {
		$header = NULL;
		$data_postcode = array();
		if (($handle = fopen("files/march2104paymentrecipientsbypostcodeandpaymenttype.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else {
					//postcode, carer allowance, carer allowance child health care card only, carer payment, disability support pension
					if($row[0] != '') {
						$stuff = array($row[0], $row[5], $row[6], $row[7], $row[10]);
/* 						$stuff = $this->commentit($stuff); */
						$data_postcode[] = $stuff;
					}
				}
			}
			fclose($handle);
		}
		$this->set('data_postcode', $data_postcode);

		$header = NULL;
		$data_lga = array();
		if (($handle = fopen("files/march2104paymentrecipientsby2014localgovernmentarealgaandpaymenttype.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else {
					//lga name, carer allowance, carer allowance child health care card only, carer payment, disability support pension
					if($row[1] != '') {
						$stuff = array($row[1], $row[6], $row[7], $row[8], $row[11]);
/* 						$stuff = $this->commentit($stuff); */
						$data_lga[] = $stuff;
					}
				}
			}
			fclose($handle);
		}
		$this->set('data_lga', $data_lga);

		$header = NULL;
		$data_state_sex = array();
		if (($handle = fopen("files/march2104paymentrecipientsbypaymenttypebystateandterritorybysex.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else if (strpos($row[0],"Carer") !== false
						|| strpos($row[0],"Disability") !== false) {
/* 					$row = $this->commentit($row); */
					$data_state_sex[] = $row;
				}
			}
			fclose($handle);
		}
		$this->set('data_state_sex', $data_state_sex);

		$header = NULL;
		$data_state_martial = array();
		if (($handle = fopen("files/march2104paymentrecipientsbypaymenttypebystateandterritorybymaritalstatus.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else if (strpos($row[0],"Carer") !== false
						|| strpos($row[0],"Disability") !== false) {
/* 					$row = $this->commentit($row); */
					$data_state_marital[] = $row;
				}
			}
			fclose($handle);
		}
		$this->set('data_state_martial', $data_state_martial);

		$header = NULL;
		$data_state_indigenous = array();
		if (($handle = fopen("files/march2104paymentrecipientsbypaymenttypebystateandterritorybyindigenousindicator.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else if (strpos($row[0],"Carer") !== false
						|| strpos($row[0],"Disability") !== false) {
/* 					$row = $this->commentit($row); */
					$data_state_indigenous[] = $row;
				}
			}
			fclose($handle);
		}
		$this->set('data_state_indigenous', $data_state_indigenous);

		$header = NULL;
		$data_state_age = array();
		if (($handle = fopen("files/march2104paymentrecipientsbypaymenttypebystateandterritorybyagegroup.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else if (strpos($row[0],"Carer") !== false
						|| strpos($row[0],"Disability") !== false) {
/* 					$row = $this->commentit($row); */
					$data_state_age[] = $row;
				}
			}
			fclose($handle);
		}
		$this->set('data_state_age', $data_state_age);

		$header = NULL;
		$data_state = array();
		if (($handle = fopen("files/march2104paymentrecipientsbypaymenttypeandstateandterritory.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else {
					//state, carer allowance child health care card only, carer payment, disability support pension
					if($row[0] != '') {
						$data_state[] = array($row[0], $row[5], $row[6], $row[7], $row[10]);
					}
				}
			}
			fclose($handle);
		}
		$this->set('data_state', $data_state);

	}

	public function statistics() {

	}

	public function needs() {

	}

	public function types() {
		ini_set('memory_limit','256M');
		$header = NULL;
		$data = array();
		if (($handle = fopen('files/expenditure-funding-social-services-2012-13.csv', 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;

				//laziest way to check for both DISABLED and DISABILITY
				} else {
					$data[] = $row;
				}
			}
			fclose($handle);
		}
		$this->set('data',$data);
	}

	function parseXML($rssfeed) {
		$limit = 50;
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
				'img'=>substr($itemdata,strpos($itemdata,'&lt;img src')+13,strpos($itemdata,'" width')-strpos($itemdata,'&lt;img src=')-13),
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
