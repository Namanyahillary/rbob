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
	
}
  
?>