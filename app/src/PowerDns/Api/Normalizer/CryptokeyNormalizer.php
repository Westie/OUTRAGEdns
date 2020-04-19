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

class CryptokeyNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'App\\PowerDns\\Api\\Model\\Cryptokey';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'App\\PowerDns\\Api\\Model\\Cryptokey';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $object = new \App\PowerDns\Api\Model\Cryptokey();
        if (array_key_exists('type', $data)) {
            $object->setType($data['type']);
        }
        if (array_key_exists('id', $data)) {
            $object->setId($data['id']);
        }
        if (array_key_exists('keytype', $data)) {
            $object->setKeytype($data['keytype']);
        }
        if (array_key_exists('active', $data)) {
            $object->setActive($data['active']);
        }
        if (array_key_exists('published', $data)) {
            $object->setPublished($data['published']);
        }
        if (array_key_exists('dnskey', $data)) {
            $object->setDnskey($data['dnskey']);
        }
        if (array_key_exists('ds', $data)) {
            $values = [];
            foreach ($data['ds'] as $value) {
                $values[] = $value;
            }
            $object->setDs($values);
        }
        if (array_key_exists('privatekey', $data)) {
            $object->setPrivatekey($data['privatekey']);
        }
        if (array_key_exists('algorithm', $data)) {
            $object->setAlgorithm($data['algorithm']);
        }
        if (array_key_exists('bits', $data)) {
            $object->setBits($data['bits']);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getType()) {
            $data['type'] = $object->getType();
        }
        if (null !== $object->getId()) {
            $data['id'] = $object->getId();
        }
        if (null !== $object->getKeytype()) {
            $data['keytype'] = $object->getKeytype();
        }
        if (null !== $object->getActive()) {
            $data['active'] = $object->getActive();
        }
        if (null !== $object->getPublished()) {
            $data['published'] = $object->getPublished();
        }
        if (null !== $object->getDnskey()) {
            $data['dnskey'] = $object->getDnskey();
        }
        if (null !== $object->getDs()) {
            $values = [];
            foreach ($object->getDs() as $value) {
                $values[] = $value;
            }
            $data['ds'] = $values;
        }
        if (null !== $object->getPrivatekey()) {
            $data['privatekey'] = $object->getPrivatekey();
        }
        if (null !== $object->getAlgorithm()) {
            $data['algorithm'] = $object->getAlgorithm();
        }
        if (null !== $object->getBits()) {
            $data['bits'] = $object->getBits();
        }
        return $data;
    }
}
