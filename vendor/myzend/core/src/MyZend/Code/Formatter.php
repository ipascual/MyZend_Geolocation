<?php
namespace MyZend\Code;

class Formatter {

	protected $locale;
	protected $currency;
	protected $area;
	
	const AREA_UNIT_SQM = "sqm";
	const AREA_UNIT_SQF = "sqf";
	
	const FORMAT_CURRENCY = "currency";
	const FORMAT_CURRENCY_DECIMALS = "currency_decimals";
	const FORMAT_DATE = "date";
	const FORMAT_NUMBER = "number";
	const FORMAT_PERCENTAGE = "percentage";
	const FORMAT_AREA = "area";
	
	public function __construct($locale = null, $currency = null, $area = null) {
		$this->locale = ($locale == null) ? "en_US" : $locale; 
		$this->currency = ($currency == null) ? "USD" : $currency;
		$this->area = ($area == null) ? self::AREA_UNIT_SQM : $area;
	}

	public function filter($type, $value) {

		switch($type) {
			case self::FORMAT_CURRENCY:
				$value = round($value);
				$format = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);
				$format->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 0);
				$value = $format->formatCurrency($value, $this->currency);
				break;
			case self::FORMAT_CURRENCY_DECIMALS:
				$format = new \NumberFormatter($this->locale, \NumberFormatter::CURRENCY);
				$value = $format->formatCurrency($value, $this->currency);
				break;
			case self::FORMAT_DATE:
	            $format = new \IntlDateFormatter($this->locale, \IntlDateFormatter::SHORT, \IntlDateFormatter::NONE, date_default_timezone_get(), \IntlDateFormatter::GREGORIAN, null);
				$value = $format->format($value);
				break;
			case self::FORMAT_NUMBER:
				$format = new \Zend\I18n\Filter\NumberFormat($this->locale, \NumberFormatter::DECIMAL, \NumberFormatter::TYPE_DEFAULT);
				$value = $format->filter($value);
				break;
			case self::FORMAT_PERCENTAGE:
				//$format =  new \NumberFormatter($this->locale, \NumberFormatter::PERCENT);
				//$value = $format->format(0.03, \NumberFormatter::TYPE_DEFAULT);
				$format = new \Zend\I18n\Filter\NumberFormat($this->locale, \NumberFormatter::DECIMAL, \NumberFormatter::TYPE_DEFAULT);
				$value = $format->filter($value);
				$value = number_format((float)$value, 2); //force period
				$value = $value . "%";
				break;
			case self::FORMAT_AREA:
				$value = (string)$value;
				$value = $value . " ".$this->getAreaLabel();
				break;
		}
		
		return $value;
	}

	public function getLocale() {
		return $this->locale;	
	}
	
	public function getCurrency() {
		return $this->currency;	
	}

	public function getArea() {
		return $this->area;	
	}
	
	public function getAreaLabel() {
		if($this->area == self::AREA_UNIT_SQM) {
			return "Sq M";
		}
		else {
			return "Sq Ft";
		}
	}
	
	public function getAreaLongLabel() {
		if($this->area == self::AREA_UNIT_SQM) {
			return "Square Metre";
		}
		else {
			return "Square Feet";
		}
	}

	public function getCurrencyLabel() {
		$currency = "$";

		switch($this->currency) {
			case "EUR":
				$currency = "€";
				break;
			case "GBP":
				$currency = "£";
				break;
			case "JPY":
				$currency = "¥";
				break;
			case "AUD":
			case "NZD":
			case "USD":
			default:
				$currency = "$";
				break;
		}
		
		return $currency;
	}

}