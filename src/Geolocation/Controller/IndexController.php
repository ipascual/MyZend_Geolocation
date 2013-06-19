<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Geolocation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController {

	public function indexAction() {
		d($this->geolocationHelper->lookupGeolocation("barcelona"));
		return new ViewModel();
	}

	public function addAction() {
		return new ViewModel();
	}

	public function lookupAction() {
		$googleMapsHelper = $this->googleMapsHelper;
		$googleMapsHelper->forwardSearch($this->getRequest()->getPost()->get('address'));
		if ($this->googleMapsHelper->getStatus() == $googleMapsHelper::OK) {
			$geoData = $googleMapsHelper->getGeoData();
			$result = array(
				'data' => $geoData,
				'succes_message' => 'Geolocation was found!',
				'error' => FALSE,
				'error_message' => ''
			);
		} else {
			$result = array(
				'data' => NULL,
				'succes_message' => '',
				'error' => TRUE,
				'error_message' => 'Geolocation was not found.'
			);
		}
		return new JsonModel($result);
	}

}
