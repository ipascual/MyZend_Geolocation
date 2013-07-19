<?php
/**
*
* Useful Php Functions
*
* @author: Ignacio Pascual
*/

/**
 * Return true if a $haystack starts with $needle.
 * 
 * @param string $needle
 * @param string $haystack
 * 
 * @return boolean
 */
function startsWith($needle, $haystack)
{
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

/**
 * Return true if a $haystack ends with $needle
 * 
 * @param string $needle
 * @param string $haystack
 * 
 * @return boolean
 */
function endsWith($needle, $haystack)
{
    $length = strlen($needle);
    $start  = $length * -1; //negative
    return (substr($haystack, $start) === $needle);
}

/**
 * If any content of the array $haystack is the start string of $needle
 * 
 * @param array $haystack
 * @param string $needle
 * 
 * @return boolean
 */
function inArrayStartsWith($haystack, $needle) {
	$match = false;
	foreach($haystack as $value) {
		if(startsWith($value, $needle)) {
			$match = true;
		}
	}
	return $match;
}

/**
 * Returns an string clean of UTF8 characters. It will convert them to a similar ASCII character
 * www.unexpectedit.com
 */
function cleanString($text) {
	// 1) convert á ô => a o
	$text = preg_replace("/[áàâãªä]/u","a",$text);
	$text = preg_replace("/[ÁÀÂÃÄ]/u","A",$text);
	$text = preg_replace("/[ÍÌÎÏ]/u","I",$text);
	$text = preg_replace("/[íìîï]/u","i",$text);
	$text = preg_replace("/[éèêë]/u","e",$text);
	$text = preg_replace("/[ÉÈÊË]/u","E",$text);
	$text = preg_replace("/[óòôõºö]/u","o",$text);
	$text = preg_replace("/[ÓÒÔÕÖ]/u","O",$text);
	$text = preg_replace("/[úùûü]/u","u",$text);
	$text = preg_replace("/[ÚÙÛÜ]/u","U",$text);
	$text = preg_replace("/[’‘‹›‚]/u","'",$text);
	$text = preg_replace("/[“”«»„]/u",'"',$text);
	$text = str_replace("–","-",$text);
	$text = str_replace(" "," ",$text);
	$text = str_replace("ç","c",$text);
	$text = str_replace("Ç","C",$text);
	$text = str_replace("ñ","n",$text);
	$text = str_replace("Ñ","N",$text);

	//2) Translation CP1252. &ndash; => -
	$trans = get_html_translation_table(HTML_ENTITIES);
	$trans[chr(130)] = '&sbquo;';    // Single Low-9 Quotation Mark
	$trans[chr(131)] = '&fnof;';    // Latin Small Letter F With Hook
	$trans[chr(132)] = '&bdquo;';    // Double Low-9 Quotation Mark
	$trans[chr(133)] = '&hellip;';    // Horizontal Ellipsis
	$trans[chr(134)] = '&dagger;';    // Dagger
	$trans[chr(135)] = '&Dagger;';    // Double Dagger
	$trans[chr(136)] = '&circ;';    // Modifier Letter Circumflex Accent
	$trans[chr(137)] = '&permil;';    // Per Mille Sign
	$trans[chr(138)] = '&Scaron;';    // Latin Capital Letter S With Caron
	$trans[chr(139)] = '&lsaquo;';    // Single Left-Pointing Angle Quotation Mark
	$trans[chr(140)] = '&OElig;';    // Latin Capital Ligature OE
	$trans[chr(145)] = '&lsquo;';    // Left Single Quotation Mark
	$trans[chr(146)] = '&rsquo;';    // Right Single Quotation Mark
	$trans[chr(147)] = '&ldquo;';    // Left Double Quotation Mark
	$trans[chr(148)] = '&rdquo;';    // Right Double Quotation Mark
	$trans[chr(149)] = '&bull;';    // Bullet
	$trans[chr(150)] = '&ndash;';    // En Dash
	$trans[chr(151)] = '&mdash;';    // Em Dash
	$trans[chr(152)] = '&tilde;';    // Small Tilde
	$trans[chr(153)] = '&trade;';    // Trade Mark Sign
	$trans[chr(154)] = '&scaron;';    // Latin Small Letter S With Caron
	$trans[chr(155)] = '&rsaquo;';    // Single Right-Pointing Angle Quotation Mark
	$trans[chr(156)] = '&oelig;';    // Latin Small Ligature OE
	$trans[chr(159)] = '&Yuml;';    // Latin Capital Letter Y With Diaeresis
	$trans['euro'] = '&euro;';    // euro currency symbol
	ksort($trans);

	foreach ($trans as $k => $v) {
		$text = str_replace($v, $k, $text);
	}

	// 3) remove <p>, <br/> ...
	$text = strip_tags($text);

	// 4) &amp; => & &quot; => '
	$text = html_entity_decode($text);

	// 5) remove Windows-1252 symbols like "TradeMark", "Euro"...
	$text = preg_replace('/[^(\x20-\x7F)]*/','', $text);

	$targets=array('\r\n','\n','\r','\t');
	$results=array(" "," "," ","");
	$text = str_replace($targets,$results,$text);

	return ($text);
}

/**
 * Returns a string limited by number and followed by "..." if needed.
 * 
 * @param string $string to limit
 * @param integer $limit number of characters to print.
 * 
 * @return string
 */
function strLimit($string, $limit) {
	if(function_exists("mb_substr")) {
		if(mb_strlen($string) > $limit) { 
			return mb_substr($string, 0, $limit, 'utf-8') . "...";
		}
		else {
			return $string;
		}
	}
	else {
		if(strlen($string) > $limit) {
			return substr($post->post_content, 0, $limit);
		}
		else {
			return $string;
		}
	}
}
