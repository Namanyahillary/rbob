<?php
echo get_serial_number();
function get_serial_number(){
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
?>