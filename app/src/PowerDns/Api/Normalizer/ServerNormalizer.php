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

class ServerNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'App\\PowerDns\\Api\\Model\\Server';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'App\\PowerDns\\Api\\Model\\Server';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $object = new \App\PowerDns\Api\Model\Server();
        if (array_key_exists('type', $data)) {
            $object->setType($data['type']);
        }
        if (array_key_exists('id', $data)) {
            $object->setId($data['id']);
        }
        if (array_key_exists('daemon_type', $data)) {
            $object->setDaemonType($data['daemon_type']);
        }
        if (array_key_exists('version', $data)) {
            $object->setVersion($data['version']);
        }
        if (array_key_exists('url', $data)) {
            $object->setUrl($data['url']);
        }
        if (array_key_exists('config_url', $data)) {
            $object->setConfigUrl($data['config_url']);
        }
        if (array_key_exists('zones_url', $data)) {
            $object->setZonesUrl($data['zones_url']);
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
        if (null !== $object->getDaemonType()) {
            $data['daemon_type'] = $object->getDaemonType();
        }
        if (null !== $object->getVersion()) {
            $data['version'] = $object->getVersion();
        }
        if (null !== $object->getUrl()) {
            $data['url'] = $object->getUrl();
        }
        if (null !== $object->getConfigUrl()) {
            $data['config_url'] = $object->getConfigUrl();
        }
        if (null !== $object->getZonesUrl()) {
            $data['zones_url'] = $object->getZonesUrl();
        }
        return $data;
    }
}
