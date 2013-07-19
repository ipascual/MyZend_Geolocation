<?php
namespace MyZend\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\InputFilter\InputFilter;

class InputErrors extends AbstractHelper
{
    public function html($errors)
    {
    	if(($errors) && is_array($errors)) {
			echo "<p style='color: red'>";
			foreach ($errors as $error) {
				$this->printInputFilter($error);
	    	}
			echo "</p>";
		}
    }
	
	private function printInputFilter($filter) {
		if($filter instanceof InputFilter) {
			foreach($filter->getInvalidInput() as $error) {
				$this->printInputFilter($error);
			}
		}
		else {
			$this->printError($filter);
		}
	}
	
	private function printError($error) {
		echo '['.$error->getName().']<br />';
		foreach($error->getMessages() as $err) {
			echo $err.'<br />';	
		}
	}
	
}
