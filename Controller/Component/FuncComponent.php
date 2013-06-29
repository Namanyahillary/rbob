<?php
class FuncComponent extends Component {
	
	public function getUID1(){
		return md5(date('Y-m-dh:i:s').($this->getMicrotime()));
	}
	
	private function getMicrotime()	{
		if (version_compare(PHP_VERSION, '5.0.0', '<'))
		{
			return array_sum(explode(' ', microtime()));
		}

		return microtime(true);
	}
	
	public function get_serial_number(){
		$tokens = '0123456789';
		$serial = '';
		for ($i = 0; $i < 2; $i++) {
			for ($j = 0; $j < 2; $j++) {
				$serial .= $tokens[rand(0, 9)];
			}
			/*
			if ($i < 3) {
				$serial .= '-';
			}*/
		}
		return $serial;
	}
	
	function jaja_do_post_request($url, $data, $optional_headers = null){	
		//check SMS gateway response for whether operation succeded.
		//codes='108';success {"success":true,"message":"Message successfull sent","code":108}
		//codes='101';failure {"success":false,"message":"Error: Invalid Username or Password","code":101}
		//codes='104';failure {"success":false,"message":"Error: Insufficient Credit","code":101}
		
		 $params = array('http' => array(
					  'method' => 'POST',
					  'content' => $data
		 ));
		 if ($optional_headers !== null) {
			$params['http']['header'] = $optional_headers;
		 }
		 $ctx = stream_context_create($params);
		 $fp = @fopen($url, 'rb', false, $ctx);
		 if (!$fp) {
			throw new Exception("Problem with $url, $php_errormsg");
		 }
		 $response = @stream_get_contents($fp);
		 if ($response === false) {
			throw new Exception("Problem reading data from $url, $php_errormsg");
		 }
		 return $response;
	}
	
}
  
?>