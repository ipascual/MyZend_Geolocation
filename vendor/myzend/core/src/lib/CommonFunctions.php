<?php
/**
*
* Useful Php Functions
*
* @author: Ignacio Pascual
*/

/**
 * Kill and debug the execution
 * 
 * @param $object
 * 
 */
function _d($object = null) {
    die(var_dump($object));
}

/**
 * Log variables to a file.
 * $name will highlight the record.
 * 
 * @param object $object
 * @param string $name
 * 
 * @return null
 */
function ilog($object, $name = null) {
	@mkdir("./data/logs");
    $h = fopen("./data/logs/ilog.log", "a");
    if($name) {
        fwrite($h, $name." >>> ");
    }
    fwrite($h, print_r($object, true).PHP_EOL);
    fclose($h);
}

/**
 * Concert Array variable to stdClass
 * 
 * @param array $array
 * 
 * @return object stdClass
 */
function arrayToObject($array) {
	if(!is_array($array)) {
		return $array;
	}

	$object = new stdClass();
	if (is_array($array) && count($array) > 0) {
		foreach ($array as $name=>$value) {
			$name = trim($name);
			if (!empty($name)) {
				$object->$name = arrayToObject($value);
			}
		}
		return $object;
	}
	else {
		return FALSE;
	}
}
