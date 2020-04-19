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

class TSIGKeyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'App\\PowerDns\\Api\\Model\\TSIGKey';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'App\\PowerDns\\Api\\Model\\TSIGKey';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $object = new \App\PowerDns\Api\Model\TSIGKey();
        if (array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (array_key_exists('id', $data)) {
            $object->setId($data['id']);
        }
        if (array_key_exists('algorithm', $data)) {
            $object->setAlgorithm($data['algorithm']);
        }
        if (array_key_exists('key', $data)) {
            $object->setKey($data['key']);
        }
        if (array_key_exists('type', $data)) {
            $object->setType($data['type']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getAlgorithm()) {
            $data['algorithm'] = $object->getAlgorithm();
        }
        if (null !== $object->getKey()) {
            $data['key'] = $object->getKey();
        }
        return $data;
    }
}
