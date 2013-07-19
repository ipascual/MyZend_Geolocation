<?php

namespace Application\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Doctrine\Common\Collections\ArrayCollection;

use MyZend\Document\Document as Document;

/** @ODM\Document(collection="application_test") */
class Test extends Document
{
 	public function __construct($data = null)
    {
    	parent::__construct($data);
    }
	
    /** 
	 * Id
	 * @var MongoId
	 * 
	 * @ODM\Id 
	*/
	
    protected $id;

	/**  
	 * First name
	 * @var String
	 * 
	 * @ODM\String 
	 */
	protected $firstname;

	/**  
	 * Last name
	 * @var String
	 * 
	 * @ODM\String 
	 */
	protected $lastname;

	/** 
	 * Created Date
	 * @var DateTime
	 * 
	 *  @ODM\Date 
	 */
	protected $created_at;
	
	/** 
	 * Updated Date
	 * @var DateTime
	 * 
	 * @ODM\Date 
	 */
	protected $updated_at;
	
	/** ================================================================== **/
	
	/** @ODM\PrePersist */
    public function prePersist()
    {
        $this->created_at = new \DateTime();
    }

	/** @ODM\PreUpdate */
    public function preUpdate()
    {
        $this->updated_at = new \DateTime();
    }


}
