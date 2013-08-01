<?php
namespace Geolocation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController {

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
