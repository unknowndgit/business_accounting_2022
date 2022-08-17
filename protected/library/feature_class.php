<?php
class feature {
	private $address = null;
	private	$encryptkey = 'SHIFTCRYPT';
	/**
	 *
	 * @param
	 *       	 type 0 return first character of string in capital letter.
	 *
	 * @param
	 *       	 type 1 return first character of all word in capital letter.
	 *
	 * @param
	 *       	 type 2 return all character of string in small letters.
	 *
	 * @param
	 *       	 type 3 return all character of string in capital letters.
	 *
	 * @param
	 *       	 type 4 return first character of string in small letter.
	 *
	 * @param
	 *       	 type 5 return first character of all word in capital letter
	 *       	 (also convert other characters in small).
	 *
	 */
	public function textstyler($string, $type) {

		$str = trim ( preg_replace ( '/[^A-Za-z0-9\-]/', ' ', $string ) ); // Removes
		                                                                   // special
		                                                                   // chars.

		if ($type == 0) {
			return ucfirst ( $str );
		} elseif ($type == 1) {
			return ucwords ( $str );
		} elseif ($type == 2) {
			return strtolower ( $str );
		} elseif ($type == 3) {
			return strtoupper ( $str );
		} elseif ($type == 4) {
			return lcfirst ( $str );
		} elseif ($type == 5) {
			return ucwords ( strtolower ( $str ) );
		}
	}
	/**
	 *
	 * @param $string is
	 *       	 string
	 * @param $replacer is
	 *       	 the replace character which replace space from string.
	 */
	public function space_replacer($string, $replacer) {
		return str_replace ( ' ', $replacer, $string );
	}
	/**
	 *
	 * @param $string is
	 *       	 the string
	 * @return where new line in your string it replace with spaces string
	 *         return
	 */
	public function remove_newline($string) {
		return trim ( preg_replace ( '/\s+/', ' ', $string ) );
	}
	// distance calculator
	function getDistanceFromLatLonInKm($lat1, $lon1, $lat2, $lon2) {
		$R = 6371; // Radius of the earth in km
		$dLat = deg2rad ( $lat2 - $lat1 ); // deg2rad below
		$dLon = deg2rad ( $lon2 - $lon1 );
		$a = sin ( $dLat / 2 ) * sin ( $dLat / 2 ) + cos ( deg2rad ( $lat1 ) ) * cos ( deg2rad ( $lat2 ) ) * sin ( $dLon / 2 ) * sin ( $dLon / 2 );
		$c = 2 * (atan2 ( sqrt ( $a ), sqrt ( 1 - $a ) ));
		$distance = $R * $c; // Distance in km
		return $distance;
	}
	// get areas less than given kilometers and returns array
	function getcoveredareas_array($lat1, $lon1, $deliveryareasarray = array(), $kms) {
		foreach ( $deliveryareasarray as $key => $val ) {
			$dis = $this->getDistanceFromLatLonInKm ( $lat1, $lon1, $val ['lat'], $val ['lng'] );
			if ((($dis * .17) + $dis) <= $kms) {
				$getselected [] = $val ['id'];
				$getregion [] = $val ['region'];
			}
		}
		return (array_combine ( $getselected, $getregion ));
	}

	function getOS() {

		$user_agent=$_SERVER['HTTP_USER_AGENT'];

		$os_platform    =   "Unknown OS Platform";

		$os_array       =   array(
				'/windows nt 6.2/i'     =>  'Windows 8',
				'/windows nt 6.1/i'     =>  'Windows 7',
				'/windows nt 6.0/i'     =>  'Windows Vista',
				'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
				'/windows nt 5.1/i'     =>  'Windows XP',
				'/windows xp/i'         =>  'Windows XP',
				'/windows nt 5.0/i'     =>  'Windows 2000',
				'/windows me/i'         =>  'Windows ME',
				'/win98/i'              =>  'Windows 98',
				'/win95/i'              =>  'Windows 95',
				'/win16/i'              =>  'Windows 3.11',
				'/macintosh|mac os x/i' =>  'Mac OS X',
				'/mac_powerpc/i'        =>  'Mac OS 9',
				'/linux/i'              =>  'Linux',
				'/ubuntu/i'             =>  'Ubuntu',
				'/iphone/i'             =>  'iPhone',
				'/ipod/i'               =>  'iPod',
				'/ipad/i'               =>  'iPad',
				'/android/i'            =>  'Android',
				'/blackberry/i'         =>  'BlackBerry',
				'/webos/i'              =>  'Mobile'
		);

		foreach ($os_array as $regex => $value) {

			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}

		}

		return $os_platform;

	}
	/* get all time zones in an array
	 * */
	function get_timezones() {
		$zones_array = array();
		$timestamp = time();
		foreach(timezone_identifiers_list() as $key => $zone) {
			date_default_timezone_set($zone);
			$zones_array[$key]['zone'] = $zone;
			$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
		}
		return $zones_array;
	}

	function getBrowser() {

		$user_agent=$_SERVER['HTTP_USER_AGENT'];

		$browser        =   "Unknown Browser";

		$browser_array  =   array(
				'/msie/i'       =>  'IE',
				'/firefox/i'    =>  'Firefox',
				'/safari/i'     =>  'Safari',
				'/chrome/i'     =>  'Chrome',
				'/opera/i'      =>  'Opera',
				'/netscape/i'   =>  'Netscape',
				'/maxthon/i'    =>  'Maxthon',
				'/konqueror/i'  =>  'Konqueror',
				'/mobile/i'     =>  'Handheld Browser'
		);

		foreach ($browser_array as $regex => $value) {

			if (preg_match($regex, $user_agent)) {
				$browser    =   $value;
			}

		}

		return $browser;

	}


	function createDateRangeArray($strDateFrom,$strDateTo)
	{
		// takes two dates formatted as YYYY-MM-DD and creates an
		// inclusive array of the dates between the from and to dates.

		// could test validity of dates here but I'm already doing
		// that in the main script

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
	}
	public function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != "." && $object != ".." ){
					if (filetype($dir."/".$object) == "dir")
							self::rrmdir($dir."/".$object);
					else unlink   ($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}
	public function forecast($address)
	{
	    $BASE_URL = "http://query.yahooapis.com/v1/public/yql";
	    $yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="'.$address.'")';
	    $yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json&store=env";
	    // Make call with cURL
	    $session = curl_init($yql_query_url);
	    curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
	    $json = curl_exec($session);
	    // Convert JSON to PHP object
	    $phpObj =  (array)(json_decode($json));
	    $query=(array)$phpObj['query'];
	    $results=(array)$query['results'];
	    // print_r($results);
	    $channel=(array)$results['channel'];
	    $item=(array)$channel['item'];
	   return($item['forecast']);
	}


/**
 * @param
 * encrypt('192', md5($encryptkey,true));
 */
	public function encrypt($id, $key=NULL)
	{
	    if($key==NULL)
	    {
	        $key= md5($encryptkey,true);
	    }
	    $id = base_convert($id,10, 36); // Save some space
	    $data = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $id, 'ecb');
	    $data = bin2hex($data);

	    return $data;
	}
	/**
	 * @param
	 * decrypt($e, md5($encryptkey,true));
	 */
	public function decrypt($encrypted_id, $key=NULL)
	{
	    if($key==NULL)
	    {
	        $key= md5($encryptkey,true);
	    }
	    $data = pack('H*', $encrypted_id); // Translate back to binary
	    $data = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $data, 'ecb');
	    $data = base_convert($data, 36, 10);

	    return $data;
	}

	public function convertPHPSizeToBytes($sSize)
	{
	    if ( is_numeric( $sSize) ) {
	        return $sSize;
	    }
	    $sSuffix = substr($sSize, -1);
	    $iValue = substr($sSize, 0, -1);
	    switch(strtoupper($sSuffix)){
	        case 'P':
	            $iValue *= 1024;
	        case 'T':
	            $iValue *= 1024;
	        case 'G':
	            $iValue *= 1024;
	        case 'M':
	            $iValue *= 1024;
	        case 'K':
	            $iValue *= 1024;
	            break;
	    }
	    return $iValue;
	}

	public function getMaximumFileUploadSize()
	{
	    return min(self::convertPHPSizeToBytes(ini_get('post_max_size')), self::convertPHPSizeToBytes(ini_get('upload_max_filesize')));
	}
	
	function cardType($number)
	{
	    $number=preg_replace('/[^\d]/','',$number);
	    if (preg_match('/^3[47][0-9]{13}$/',$number))
	    {
	        return 'american_express';
	    }
	    elseif (preg_match('/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/',$number))
	    {
	        return 'diners_club';
	    }
	    elseif (preg_match('/^6(?:011|5[0-9][0-9])[0-9]{12}$/',$number))
	    {
	        return 'discover';
	    }
	    elseif (preg_match('/^(?:2131|1800|35\d{3})\d{11}$/',$number))
	    {
	        return 'jcb';
	    }
	    elseif (preg_match('/^5[1-5][0-9]{14}$/',$number))
	    {
	        return 'mastercard';
	    }
	    elseif (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/',$number))
	    {
	        return 'visa';
	    }
	    else
	    {
	        return 'Unknown';
	    }
	}
	function getLocationInfoByIp($ip){
	    //function to return country name of given $ipaddress

	    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
	    if($ip_data && $ip_data->geoplugin_countryName != null){
	        $result['country'] = $ip_data->geoplugin_countryCode;
	        $result['city'] = $ip_data->geoplugin_city;
	    }
	    $country_short=$result['country'];
	    //  $country_name=Locale::getDisplayRegion('sl-Latn-'.$country_short.'-nedis', 'en');
	    return $country_short;
	}

}
?>