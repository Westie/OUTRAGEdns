<?php

namespace App\PowerDns\Api\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    protected $normalizers = ['App\\PowerDns\\Api\\Model\\Server' => 'App\\PowerDns\\Api\\Normalizer\\ServerNormalizer', 'App\\PowerDns\\Api\\Model\\Zone' => 'App\\PowerDns\\Api\\Normalizer\\ZoneNormalizer', 'App\\PowerDns\\Api\\Model\\RRSet' => 'App\\PowerDns\\Api\\Normalizer\\RRSetNormalizer', 'App\\PowerDns\\Api\\Model\\Record' => 'App\\PowerDns\\Api\\Normalizer\\RecordNormalizer', 'App\\PowerDns\\Api\\Model\\Comment' => 'App\\PowerDns\\Api\\Normalizer\\CommentNormalizer', 'App\\PowerDns\\Api\\Model\\TSIGKey' => 'App\\PowerDns\\Api\\Normalizer\\TSIGKeyNormalizer', 'App\\PowerDns\\Api\\Model\\ConfigSetting' => 'App\\PowerDns\\Api\\Normalizer\\ConfigSettingNormalizer', 'App\\PowerDns\\Api\\Model\\SimpleStatisticItem' => 'App\\PowerDns\\Api\\Normalizer\\SimpleStatisticItemNormalizer', 'App\\PowerDns\\Api\\Model\\StatisticItem' => 'App\\PowerDns\\Api\\Normalizer\\StatisticItemNormalizer', 'App\\PowerDns\\Api\\Model\\MapStatisticItem' => 'App\\PowerDns\\Api\\Normalizer\\MapStatisticItemNormalizer', 'App\\PowerDns\\Api\\Model\\RingStatisticItem' => 'App\\PowerDns\\Api\\Normalizer\\RingStatisticItemNormalizer', 'App\\PowerDns\\Api\\Model\\SearchResultZone' => 'App\\PowerDns\\Api\\Normalizer\\SearchResultZoneNormalizer', 'App\\PowerDns\\Api\\Model\\SearchResultRecord' => 'App\\PowerDns\\Api\\Normalizer\\SearchResultRecordNormalizer', 'App\\PowerDns\\Api\\Model\\SearchResultComment' => 'App\\PowerDns\\Api\\Normalizer\\SearchResultCommentNormalizer', 'App\\PowerDns\\Api\\Model\\SearchResult' => 'App\\PowerDns\\Api\\Normalizer\\SearchResultNormalizer', 'App\\PowerDns\\Api\\Model\\Metadata' => 'App\\PowerDns\\Api\\Normalizer\\MetadataNormalizer', 'App\\PowerDns\\Api\\Model\\Cryptokey' => 'App\\PowerDns\\Api\\Normalizer\\CryptokeyNormalizer', 'App\\PowerDns\\Api\\Model\\Error' => 'App\\PowerDns\\Api\\Normalizer\\ErrorNormalizer', 'App\\PowerDns\\Api\\Model\\CacheFlushResult' => 'App\\PowerDns\\Api\\Normalizer\\CacheFlushResultNormalizer'];
    protected $normalizersCache = [];

    public function supportsDenormalization($data, $type, $format = null)
    {
        return array_key_exists($type, $this->normalizers);
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $class, $format, $context);
    }

    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }

    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;
        return $normalizer;
    }
}
