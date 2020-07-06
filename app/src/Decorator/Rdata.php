<?php

namespace App\Decorator;

use App\PowerDns\Api\Model\RRSet;
use Symfony\Component\Yaml\Yaml;

class Rdata implements DecoratorInterface
{
    /**
     *  File
     */
    private $file = './app/conf/RDATA.yml';

    /**
     *  Cached RData info
     */
    private $cache;

    /**
     *  Apply decorator to something
     */
    public function applyTo(object $object): object
    {
        if ($object instanceof RRSet === false) {
            return $object;
        }

        $keys = $this->getKeys($object->getType());

        // explode our tokens
        $object = clone $object;
        $records = $object->getRecords();

        foreach ($records as $index => $record) {
            $tokens = preg_split('/\\s+/', $record->getContent(), count($keys));

            $records[$index] = clone $record;
            $records[$index]->rdata = array_combine($keys, $tokens);
        }

        return $object->setRecords($records);
    }

    /**
     *  Apply decorator to something
     */
    public function revertTo(object $object): object
    {
        if ($object instanceof RRSet === false) {
            return $object;
        }

        $keys = $this->getKeys($object->getType());

        // explode our tokens
        $object = clone $object;
        $records = $object->getRecords();

        foreach ($records as $index => $record) {
            if (isset($record->rdata)) {
                $records[$index] = clone $record;
                $records[$index]->setContent((function ($keys, $record) {
                    $list = [];
                    foreach ($keys as $key) {
                        $list[] = $record->rdata[$key];
                    }
                    return implode(' ', $list);
                })($keys, $record));

                unset($records[$index]->rdata);
            }
        }

        return $object->setRecords($records);
    }

    /**
     *  Get keys
     */
    private function getKeys(string $type)
    {
        if ($this->cache === null) {
            $this->cache = Yaml::parse(file_get_contents($this->file));
        }

        $keys = $this->cache[$type] ?? [];

        // capturing free text fields
        if (($index = array_search(true, $keys, true)) !== false) {
            if ($index == count($keys) - 1) {
                $keys[$index] = '@RDATA';
            }
        }

        return array_map('strtolower', $keys);
    }
}
