<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Zend\InputFilter\Factory;

class TestController extends AbstractActionController
{

	public function alphaAction() {
		$email = $this->email->create();
		$email->addTo("t123@ipascual.com", "Ignacio Pascual");
		$email->setTemplateName("cms/contact");
		$email->setSubject("Contact email");
		$this->email->send($email);
	}

	public function betaAction() {
	}
	
}
