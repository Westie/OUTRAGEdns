<?php

namespace App\PowerDns\Api\Normalizer;

use function array_key_exists;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RRSetNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'App\\PowerDns\\Api\\Model\\RRSet';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'App\\PowerDns\\Api\\Model\\RRSet';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \App\PowerDns\Api\Model\RRSet();
        if (array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (array_key_exists('type', $data)) {
            $object->setType($data['type']);
        }
        if (array_key_exists('ttl', $data)) {
            $object->setTtl($data['ttl']);
        }
        if (array_key_exists('changetype', $data)) {
            $object->setChangetype($data['changetype']);
        }
        if (array_key_exists('records', $data)) {
            $values = [];
            foreach ($data['records'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'App\\PowerDns\\Api\\Model\\Record', 'json', $context);
            }
            $object->setRecords($values);
        }
        if (array_key_exists('comments', $data)) {
            $values_1 = [];
            foreach ($data['comments'] as $value_1) {
                $values_1[] = $this->denormalizer->denormalize($value_1, 'App\\PowerDns\\Api\\Model\\Comment', 'json', $context);
            }
            $object->setComments($values_1);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getType()) {
            $data['type'] = $object->getType();
        }
        if (null !== $object->getTtl()) {
            $data['ttl'] = $object->getTtl();
        }
        if (null !== $object->getChangetype()) {
            $data['changetype'] = $object->getChangetype();
        }
        if (null !== $object->getRecords()) {
            $values = [];
            foreach ($object->getRecords() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['records'] = $values;
        }
        if (null !== $object->getComments()) {
            $values_1 = [];
            foreach ($object->getComments() as $value_1) {
                $values_1[] = $this->normalizer->normalize($value_1, 'json', $context);
            }
            $data['comments'] = $values_1;
        }
        return $data;
    }
}
