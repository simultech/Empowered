<?php
class InformationController extends AppController {

	public function beforeFilter() {
		$this->Auth->allow('index','events','parks','hospitals','allowance','statistics','needs','types');
		parent::beforeFilter();
	}

	public function index() {
		//parks
		$data = $this->parseXML('files/parks.xml');
		foreach($data as &$item) {
			$item['state'] = 'qld';
			$item['date'] = html_entity_decode(substr($item['description'],0,strpos($item['description'],'&lt;br')));
		}
		$this->set('data',$data);
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
					//we only want info for parks with disabled access/whatnot
					$data[] = $row;
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
					$data[] = $row;
				}
			}
			fclose($handle);
		}
		$this->set('data',$data);
	}

	public function hospitals() {
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
			$data[] = $item;
		}
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
					$data_postcode[] = array($row[0], $row[5], $row[6], $row[7], $row[10]);
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
					$data_lga[] = array($row[1], $row[6], $row[7], $row[8], $row[11]);
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
					$data_state[] = array($row[0], $row[5], $row[6], $row[7], $row[10]);
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
