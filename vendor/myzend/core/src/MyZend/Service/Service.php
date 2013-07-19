<?php
namespace MyZend\Service;

use MyZend\Service\Service as Service;

class Service
{

	/**
	 * Find a document by a filter
	 * 
	 * @param $filter array set
	 * @return Document or null
	 */
	public function findOneBy(array $criteria) {
		return $this->dm->getRepository($this->document)->findOneBy($criteria);
	}

	/**
	 * Find documents by a filter
	 * 
	 * @param $filter array set
	 * @return Document or null
	 */
	public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null) {
		return $this->dm->getRepository($this->document)->findBy($criteria, $orderBy, $limit, $offset);
	}
	
	/**
	 * Find all documents in the collection
	 *
	 * @return Document collection 
	 */
	public function findAll() {
		return $this->dm->getRepository($this->document)->findAll();
	}
	
	public function save($entity)  {
		$this->dm->persist($entity);
		$this->dm->flush($entity);
		
		return $entity;
	}
	
	public function remove($entity)  {
		$this->dm->remove($entity);
		$this->dm->flush();
	}
	
	public function getService($collection) {
		$map = $collection->getMapping();
		
		$newService = clone $this;
		$newService->document = $map["targetDocument"];
		return $newService;
	}
	
    /**
     * Add/Del attribute wrapper
     *
     * @param   string $method
     * @param   array $args
     * @return  mixed
     */
    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'add' :
                $key = $this->_underscore(substr($method,3));
				$entity = isset($args[0]) ? $args[0] : null;
				$result = isset($args[1]) ? $args[1] : null;
				$entity->add($key, $result);
                return $entity;
            case 'del' :
                $key = $this->_underscore(substr($method,3));
				$entity = isset($args[0]) ? $args[0] : null;
				$result = isset($args[1]) ? $args[1] : null;
				$entity->del($key, $result);
                return $entity;
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
     * Make sure the object belongs to the current user
     *
     * $this->setMyField($value) === $this->setData('my_field', $value)
     * Uses cache to eliminate unneccessary preg_replace
     *
     * @param Object $obj
	 * @param User $user
	 * @param string $action
     * @return no return
     */
	public function isAllow($obj, $user, $action = null){
		if (($obj != null && $obj->getOwner() && $user != null && $obj->getOwner()->getId() != $user->getId())) {
			throw new \Exception("There was an error on your request.");
		} 
	}

	
}