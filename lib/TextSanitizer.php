<?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 * 
 * Multi-licensed: BSD 3-Clause | Apache 2.0 | GNU LGPL v3 | HLNC License (http://bloxtor.com/LICENSE_HLNC.md)
 * Choose one license that best fits your needs.
 *
 * Original PHP CSS and JS Files Optimizer Repo: https://github.com/a19836/phpcssandjsfilesoptimizer/
 * Original Bloxtor Repo: https://github.com/a19836/bloxtor
 *
 * YOU ARE NOT AUTHORIZED TO MODIFY OR REMOVE ANY PART OF THIS NOTICE!
 */

class TextSanitizer {
		
	/**
	* mbStrSplit: returns the multibyte character list of a string. 
	* This function splits a multibyte string into an array of characters. Comparable to str_split().
	* A (simpler) way to extract all characters from a UTF-8 string to array.
	*/
	public static function mbStrSplit($str) {
		# Split at all position not after the start: ^
		# and not before the end: $
		return function_exists("mb_str_split") ? mb_str_split($str) : preg_split('//u', $str, null, PREG_SPLIT_NO_EMPTY);
	}
	
	/**
	* isCharEscaped: checks if a char is escaped given its position 
	*/
	public static function isCharEscaped($str, $index) {
		$escaped = false;
		
		if (is_numeric($str))
			$str = (string)$str; //bc of php > 7.4 if we use $sql[$i] gives an warning
		
		for ($i = $index - 1; $i >= 0; $i--) {
			if ($str[$i] == "\\")
				$escaped = !$escaped;
			else
				break;
		}
		
		return $escaped;
	}
	
	/**
	* isCharEscaped: checks if a char is escaped given its position 
	*/
	public static function isMBCharEscaped($str, $index, $text_chars = null) {
		$escaped = false;
		$text_chars = $text_chars ? $text_chars : self::mbStrSplit($str);
		
		for ($i = $index - 1; $i >= 0; $i--) {
			if ($text_chars[$i] == "\\")
				$escaped = !$escaped;
			else
				break;
		}
		
		return $escaped;
	}
}	

?>
