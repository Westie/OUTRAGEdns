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

class ZoneNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'App\\PowerDns\\Api\\Model\\Zone';
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'App\\PowerDns\\Api\\Model\\Zone';
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (isset($data['$ref'])) {
            return new Reference($data['$ref'], $context['document-origin']);
        }
        if (isset($data['$recursiveRef'])) {
            return new Reference($data['$recursiveRef'], $context['document-origin']);
        }
        $object = new \App\PowerDns\Api\Model\Zone();
        if (array_key_exists('id', $data)) {
            $object->setId($data['id']);
        }
        if (array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (array_key_exists('type', $data)) {
            $object->setType($data['type']);
        }
        if (array_key_exists('url', $data)) {
            $object->setUrl($data['url']);
        }
        if (array_key_exists('kind', $data)) {
            $object->setKind($data['kind']);
        }
        if (array_key_exists('rrsets', $data)) {
            $values = [];
            foreach ($data['rrsets'] as $value) {
                $values[] = $this->denormalizer->denormalize($value, 'App\\PowerDns\\Api\\Model\\RRSet', 'json', $context);
            }
            $object->setRrsets($values);
        }
        if (array_key_exists('serial', $data)) {
            $object->setSerial($data['serial']);
        }
        if (array_key_exists('notified_serial', $data)) {
            $object->setNotifiedSerial($data['notified_serial']);
        }
        if (array_key_exists('edited_serial', $data)) {
            $object->setEditedSerial($data['edited_serial']);
        }
        if (array_key_exists('masters', $data)) {
            $values_1 = [];
            foreach ($data['masters'] as $value_1) {
                $values_1[] = $value_1;
            }
            $object->setMasters($values_1);
        }
        if (array_key_exists('dnssec', $data)) {
            $object->setDnssec($data['dnssec']);
        }
        if (array_key_exists('nsec3param', $data)) {
            $object->setNsec3param($data['nsec3param']);
        }
        if (array_key_exists('nsec3narrow', $data)) {
            $object->setNsec3narrow($data['nsec3narrow']);
        }
        if (array_key_exists('presigned', $data)) {
            $object->setPresigned($data['presigned']);
        }
        if (array_key_exists('soa_edit', $data)) {
            $object->setSoaEdit($data['soa_edit']);
        }
        if (array_key_exists('soa_edit_api', $data)) {
            $object->setSoaEditApi($data['soa_edit_api']);
        }
        if (array_key_exists('api_rectify', $data)) {
            $object->setApiRectify($data['api_rectify']);
        }
        if (array_key_exists('zone', $data)) {
            $object->setZone($data['zone']);
        }
        if (array_key_exists('account', $data)) {
            $object->setAccount($data['account']);
        }
        if (array_key_exists('nameservers', $data)) {
            $values_2 = [];
            foreach ($data['nameservers'] as $value_2) {
                $values_2[] = $value_2;
            }
            $object->setNameservers($values_2);
        }
        if (array_key_exists('master_tsig_key_ids', $data)) {
            $values_3 = [];
            foreach ($data['master_tsig_key_ids'] as $value_3) {
                $values_3[] = $value_3;
            }
            $object->setMasterTsigKeyIds($values_3);
        }
        if (array_key_exists('slave_tsig_key_ids', $data)) {
            $values_4 = [];
            foreach ($data['slave_tsig_key_ids'] as $value_4) {
                $values_4[] = $value_4;
            }
            $object->setSlaveTsigKeyIds($values_4);
        }
        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getId()) {
            $data['id'] = $object->getId();
        }
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getType()) {
            $data['type'] = $object->getType();
        }
        if (null !== $object->getUrl()) {
            $data['url'] = $object->getUrl();
        }
        if (null !== $object->getKind()) {
            $data['kind'] = $object->getKind();
        }
        if (null !== $object->getRrsets()) {
            $values = [];
            foreach ($object->getRrsets() as $value) {
                $values[] = $this->normalizer->normalize($value, 'json', $context);
            }
            $data['rrsets'] = $values;
        }
        if (null !== $object->getSerial()) {
            $data['serial'] = $object->getSerial();
        }
        if (null !== $object->getNotifiedSerial()) {
            $data['notified_serial'] = $object->getNotifiedSerial();
        }
        if (null !== $object->getEditedSerial()) {
            $data['edited_serial'] = $object->getEditedSerial();
        }
        if (null !== $object->getMasters()) {
            $values_1 = [];
            foreach ($object->getMasters() as $value_1) {
                $values_1[] = $value_1;
            }
            $data['masters'] = $values_1;
        }
        if (null !== $object->getDnssec()) {
            $data['dnssec'] = $object->getDnssec();
        }
        if (null !== $object->getNsec3param()) {
            $data['nsec3param'] = $object->getNsec3param();
        }
        if (null !== $object->getNsec3narrow()) {
            $data['nsec3narrow'] = $object->getNsec3narrow();
        }
        if (null !== $object->getPresigned()) {
            $data['presigned'] = $object->getPresigned();
        }
        if (null !== $object->getSoaEdit()) {
            $data['soa_edit'] = $object->getSoaEdit();
        }
        if (null !== $object->getSoaEditApi()) {
            $data['soa_edit_api'] = $object->getSoaEditApi();
        }
        if (null !== $object->getApiRectify()) {
            $data['api_rectify'] = $object->getApiRectify();
        }
        if (null !== $object->getZone()) {
            $data['zone'] = $object->getZone();
        }
        if (null !== $object->getAccount()) {
            $data['account'] = $object->getAccount();
        }
        if (null !== $object->getNameservers()) {
            $values_2 = [];
            foreach ($object->getNameservers() as $value_2) {
                $values_2[] = $value_2;
            }
            $data['nameservers'] = $values_2;
        }
        if (null !== $object->getMasterTsigKeyIds()) {
            $values_3 = [];
            foreach ($object->getMasterTsigKeyIds() as $value_3) {
                $values_3[] = $value_3;
            }
            $data['master_tsig_key_ids'] = $values_3;
        }
        if (null !== $object->getSlaveTsigKeyIds()) {
            $values_4 = [];
            foreach ($object->getSlaveTsigKeyIds() as $value_4) {
                $values_4[] = $value_4;
            }
            $data['slave_tsig_key_ids'] = $values_4;
        }
        return $data;
    }
}
