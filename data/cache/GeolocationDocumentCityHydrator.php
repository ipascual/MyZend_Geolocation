<?php

namespace Hydrator;

use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\ClassMetadata;
use Doctrine\ODM\MongoDB\Hydrator\HydratorInterface;
use Doctrine\ODM\MongoDB\UnitOfWork;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ODM. DO NOT EDIT THIS FILE.
 */
class GeolocationDocumentCityHydrator implements HydratorInterface
{
    private $dm;
    private $unitOfWork;
    private $class;

    public function __construct(DocumentManager $dm, UnitOfWork $uow, ClassMetadata $class)
    {
        $this->dm = $dm;
        $this->unitOfWork = $uow;
        $this->class = $class;
    }

    public function hydrate($document, $data, array $hints = array())
    {
        $hydratedData = array();

        /** @Field(type="id") */
        if (isset($data['_id'])) {
            $value = $data['_id'];
            $return = $value instanceof \MongoId ? (string) $value : $value;
            $this->class->reflFields['id']->setValue($document, $return);
            $hydratedData['id'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['name'])) {
            $value = $data['name'];
            $return = (string) $value;
            $this->class->reflFields['name']->setValue($document, $return);
            $hydratedData['name'] = $return;
        }

        /** @Field(type="string") */
        if (isset($data['state'])) {
            $value = $data['state'];
            $return = (string) $value;
            $this->class->reflFields['state']->setValue($document, $return);
            $hydratedData['state'] = $return;
        }

        /** @ReferenceOne */
        if (isset($data['country'])) {
            $reference = $data['country'];
            if (isset($this->class->fieldMappings['country']['simple']) && $this->class->fieldMappings['country']['simple']) {
                $className = $this->class->fieldMappings['country']['targetDocument'];
                $mongoId = $reference;
            } else {
                $className = $this->dm->getClassNameFromDiscriminatorValue($this->class->fieldMappings['country'], $reference);
                $mongoId = $reference['$id'];
            }
            $targetMetadata = $this->dm->getClassMetadata($className);
            $id = $targetMetadata->getPHPIdentifierValue($mongoId);
            $return = $this->dm->getReference($className, $id);
            $this->class->reflFields['country']->setValue($document, $return);
            $hydratedData['country'] = $return;
        }

        /** @Field(type="float") */
        if (isset($data['latitude'])) {
            $value = $data['latitude'];
            $return = (float) $value;
            $this->class->reflFields['latitude']->setValue($document, $return);
            $hydratedData['latitude'] = $return;
        }

        /** @Field(type="float") */
        if (isset($data['longitude'])) {
            $value = $data['longitude'];
            $return = (float) $value;
            $this->class->reflFields['longitude']->setValue($document, $return);
            $hydratedData['longitude'] = $return;
        }
        return $hydratedData;
    }
}