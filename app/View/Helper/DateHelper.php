<?php
class DateHelper extends AppHelper {
	public function date($date){
		$date = strtotime($date);
		return date('d/m/Y', $date);
	}
}