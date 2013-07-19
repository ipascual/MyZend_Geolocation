<?php
namespace MyZend\View\Helper;

use Zend\View\Helper\AbstractHelper;

class FlashMessenger extends AbstractHelper
{
    public function html()
    {
        $flashMessenger = new \Zend\Mvc\Controller\Plugin\FlashMessenger();

		//Error		
		if($flashMessenger->setNamespace("error")->hasMessages()) {
			foreach($flashMessenger->setNamespace("error")->getMessages() as $msg) {
				$html = '<div class="alert alert-error"><i class="icon-remove-sign"></i>' . PHP_EOL;
				$html .= $msg . PHP_EOL;	
				$html .= "</div>" . PHP_EOL;
			}
			echo $html;
		}
		//Notice		
		if($flashMessenger->setNamespace("notice")->hasMessages()) {
			foreach($flashMessenger->setNamespace("notice")->getMessages() as $msg) {
				$html = '<div class="alert alert-info"><i class="icon-exclamation-sign"></i>' . PHP_EOL;
				$html .= $msg . PHP_EOL;	
				$html .= "</div>" . PHP_EOL;
			}
			echo $html;
		}
		//Success		
		if($flashMessenger->setNamespace("success")->hasMessages()) {
			foreach($flashMessenger->setNamespace("success")->getMessages() as $msg) {
				$html = '<div class="alert alert-success"><i class="icon-ok-sign"></i>' . PHP_EOL;
				$html .= $msg . PHP_EOL;	
				$html .= "</div>" . PHP_EOL;
			}
			echo $html;
		}
    }
}
