<?php
class AwarenessController extends AppController {

	public function index() {
		// $data = getPaymentsReceived($state, $age, "Carer Allowance"
		//$this->set('data',$data);
	}

	function getCarerAllowancePaymentsReceived() {
		return getPaymentsReceived($_POST["state"], $_POST["age"], "Carer Allowance");
	}

	function getCarerAllowanceHCCOnlyPaymentsReceived() {
		return getPaymentsReceived($_POST["state"], $_POST["age"], "Carer Allowance (child hcc only)");
	}

	function getDisabilitySupportPensionPaymentsReceived() {
		return getPaymentsReceived($_POST["state"], $_POST["age"], "Disability Support Pension");
	}

	function getPaymentsReceived() {
		//field is one of "Carer Allowance", "Carer Allowance (child hcc only)", "Carer Payment", "Disability Support Pension"

		if ($age < 24) {
			if ($field = "Disability Support Pension") {
				$index = 2;
			} else {
				$index = 3;
			}
		} else if ($age < 35) {
			$index = 4;
		} else if ($age < 44) {
			$index = 5;
		} else if ($age < 54) {
			$index = 6;
		} else if ($age < 64) {
			$index = 7;
		} else {
			$index = 8;
		}
		if ($state == "ACT") {
			//do nothing lol
		} else if ($state == "NSW") {
			$index += 9;
		} else if ($state == "NT") {
			$index += 18;
		} else if ($state == "QLD") {
			$index += 27;
		} else if ($state == "SA") {
			$index += 36;
		} else if ($state = "TAS") {
			$index += 45;
		} else if ($state == "VIC") {
			$index += 54;
		} else { //if $state == "WA"
			$index += 63;
		}

		$header = NULL;
		if (($handle = fopen("files/march2104paymentrecipientsbypaymenttypebystateandterritorybyagegroup.csv", 'r')) !== FALSE) {
			while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {
				if(!$header) {
					$header = $row;
				} else if ($row[0] == $field) {
					fclose($handle);
					return $row[$index];
				}
			}
		}
	}
}
?>
