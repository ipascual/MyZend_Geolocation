<?php

namespace MyZend\Document;

class Document
{

	/**
	 * Initialize the class with all data from array.
	 * 
	 * @param array $data
	 */	
	public function __construct($data = null) {
		if($data) {
			$this->setOptions($data);
		}
        return $this;
	}
	
    /**
     * Set/Get Add/Del attribute wrapper
	 * 
	 * Set
	 * $user->setName("Ignacio")
	 * 
	 * Get
	 * $user->getName();
	 * $user->getPhonenumbers(3);
	 * 
	 * Add
	 * $user->addPhonenumbers($phone)
	 * 
	 * Del
	 * $entity->delPhonenumbers($phone)
	 * 
     *
     * @param   string $method
     * @param   array $args
     * @return  mixed
     */
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get' :
                $key = $this->_underscore(substr($method,3));
				$index = isset($args[0]) ? $args[0] : null;
		    	//Try to find a property
		    	if(($index === null) && isset($this->$key)) {
		    		return $this->$key;
		    	}
				//Try to find a matched id inside a collection
				if($index !== null) {
					$found = null;
					foreach($this->$key as $doc) {
						if($doc->getId() == $index) {
							$found = $doc;
						}
					}
					return $found;
				}
				return "";
            case 'set' :
                $key = $this->_underscore(substr($method,3));
				$result = isset($args[0]) ? $args[0] : null;
				$this->$key = $result;
                return $result;
            case 'inc' :
                $key = $this->_underscore(substr($method,3));
				$result = isset($args[0]) ? $args[0] : null;
				$this->$key = $this->$key + 1;
                return $result;
        }
        throw new \Exception("Invalid method ".$method);
    }
	
    /**
     * Converts field names for setters and geters
     *
     * $this->setMyField($value) === $this->setData('my_field', $value)
     * Uses cache to eliminate unneccessary preg_replace
     *
     * @param string $name
     * @return string
     */
    protected function _underscore($name)
    {
        $result = strtolower(preg_replace('/(.)([A-Z])/', "$1_$2", $name));
        return $result;
    }

	/**
	 * Add a $value to an array $attribute.
	 * 
	 * @param string $attribute
	 * @param Object $value
	 * 
	 */	
	public function add($attribute, $value) {
		//$property = $this->$attribute;
		
		//$property[] = $value;
		$this->$attribute->add($value);
		
		//$this->$attribute = $property;
	}

	/**
	 * Delete a $value to an array $attribute.
	 * 
	 * @param string $attribute
	 * @param Object $value
	 * 
	 */	
	public function del($attribute, $value) {	
		foreach($this->$attribute as $doc) {
			if($doc->getId() == $value->getId()) {
				$this->$attribute->removeElement($doc);
			}
		}
	}
	

	/**
	 * Set all values from $options to each property.
	 * 
	 * @param $data array set
	 * @return $this
	 */	
    public function setOptions(array $data)
    {
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
        return $this;
    }

	/**
	 * Set property value
	 * 
	 * @param $data Object
	 * @return $this
	 */	
    public function setOption($property, $value)
    {
		$this->$property = $value;
		
        return $this;
    }
    
    	
    /**
     * Export all class properties to array
     * E.g.: ["full_name"] => "Ignacio Pascual" 
     * 
     * Check all variables if exists the method getVariable() then is added to the Array.
     * 
     */
    public function toArray($attributes = array(), $formatter = null) {
    	$values = array();
		
		foreach (get_object_vars($this) as $key => $val) {
			// filter by properties
			$included = true;
			if(count($attributes)) {
				$included = false;
				$className = strtolower(get_class($this));
				$className = end(explode("\\", $className));
				if(isset($attributes[$className]) && in_array($key, $attributes[$className])) {
					$included = true;
				}
			}
			if($included) {
				// object
				if(is_object($val)) {
					if(method_exists($val, "getIterator")) {
						foreach($val->getIterator() as $subVal) {
							$values[$key][] = $subVal->toArray($attributes, $formatter);
						}
					}
					else if(method_exists($val, "toArray")) {
						$values[$key] = $val->toArray($attributes, $formatter);
					}
					else if(get_class($val) == "DateTime") {
						// output
						if($formatter && (method_exists($this, "format"))) {
							$values[$key] = $this->format($key, $formatter);
						}
						else {
		   					$values[$key] = $val;
						}
					}
					else {
						@$values[$key] = $val;
					}
				}
				else {
					// output
					if($formatter && (method_exists($this, "format"))) {
						$values[$key] = $this->format($key, $formatter);
					}
					else {
	   					$values[$key] = $val;
					}
				}
			}
    	}
		
        return $values;
    }

	
}