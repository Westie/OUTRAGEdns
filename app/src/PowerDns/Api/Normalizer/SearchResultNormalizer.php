<?php

namespace App\PowerDns\Api\Normalizer;

use function array_key_exists;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SearchResultNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'App\\PowerDns\\Api\\Model\\SearchResult';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'App\\PowerDns\\Api\\Model\\SearchResult';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $object = new \App\PowerDns\Api\Model\SearchResult();
        if (array_key_exists('content', $data)) {
            $object->setContent($data['content']);
        }
        if (array_key_exists('disabled', $data)) {
            $object->setDisabled($data['disabled']);
        }
        if (array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (array_key_exists('object_type', $data)) {
            $object->setObjectType($data['object_type']);
        }
        if (array_key_exists('zone_id', $data)) {
            $object->setZoneId($data['zone_id']);
        }
        if (array_key_exists('zone', $data)) {
            $object->setZone($data['zone']);
        }
        if (array_key_exists('type', $data)) {
            $object->setType($data['type']);
        }
        if (array_key_exists('ttl', $data)) {
            $object->setTtl($data['ttl']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getContent()) {
            $data['content'] = $object->getContent();
        }
        if (null !== $object->getDisabled()) {
            $data['disabled'] = $object->getDisabled();
        }
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getObjectType()) {
            $data['object_type'] = $object->getObjectType();
        }
        if (null !== $object->getZoneId()) {
            $data['zone_id'] = $object->getZoneId();
        }
        if (null !== $object->getZone()) {
            $data['zone'] = $object->getZone();
        }
        if (null !== $object->getType()) {
            $data['type'] = $object->getType();
        }
        if (null !== $object->getTtl()) {
            $data['ttl'] = $object->getTtl();
        }
        return $data;
    }
}
