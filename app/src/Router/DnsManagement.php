<?php

namespace App\Router;

use App\Decorator\Rdata;
use App\Driver\DriverInterface;
use App\PowerDns\Api\Model\Record;
use App\PowerDns\Api\Model\RRSet;
use App\Response\TwigResponseFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface;

class DnsManagement
{
    /**
     *  Container
     */
    private $container;

    /**
     *  Called when connecting an app to this controller provider.
     */
    public function __invoke(RouteCollectorProxyInterface $app)
    {
        // get
        $routes = [
            'zones' => 'listZones',
            'zones/{zoneId}' => 'listZone',
        ];

        foreach ($routes as $route => $method) {
            $app->get($route, [ $this, $method ]);
        }

        // post
        $routes = [
            'zones/{zoneId}' => 'putZone',
        ];

        foreach ($routes as $route => $method) {
            $app->post($route, [ $this, $method ]);
        }

        $this->container = $app->getContainer();
    }

    /**
     *  Get all zones
     */
    public function listZones(Request $request, Response $response, array $arguments)
    {
        $results = $this->container->get(DriverInterface::class)->listZones('localhost');

        $context = [
            'view' => 'objects/zones/grid.twig',
            'results' => $results,
        ];

        return TwigResponseFactory::withResponse($this->container, $request, $response, 'index.twig', $context);
    }

    /**
     *  Get a zone
     */
    public function listZone(Request $request, Response $response, array $arguments)
    {
        $zone = $this->container->get(DriverInterface::class)->listZone('localhost', $arguments['zoneId'].'.');

        $records = [
            'soa' => collect($zone->getRRSets())->filter(function (RRSet $rrset) {
                return $rrset->getType() === 'SOA';
            })->map(function (RRSet $rrset) {
                return $this->container->get(Rdata::class)->applyTo($rrset);
            }),
            'list' => collect($zone->getRRSets())->filter(function (RRSet $rrset) {
                return $rrset->getType() !== 'SOA';
            }),
        ];

        $context = [
            'view' => 'objects/zones/edit.twig',
            'zone' => $zone,
            'records' => $records,
        ];

        return TwigResponseFactory::withResponse($this->container, $request, $response, 'index.twig', $context);
    }

    /**
     *  Update a zone
     */
    public function putZone(Request $request, Response $response, array $arguments)
    {
        $zone = $this->container->get(DriverInterface::class)->listZone('localhost', $arguments['zoneId'].'.');
        $post = $request->getParsedBody();

        if (!empty($post['kind'])) {
            $zone->setKind($post['kind']);
        }

        $rrsets = [];

        if (!empty($post['records'])) {
            foreach ($post['records'] as $record) {
                $fqdn = $record['name'].'.'.$zone->getName();
                $key = $fqdn.'@'.$record['type'];

                // does an RRSet exist
                if (!isset($rrsets[$key])) {
                    $rrset = new RRSet();

                    $rrset->setName($record['name'] ?? '');
                    $rrset->setType($record['type'] ?? '');
                    $rrset->setTtl($record['ttl'] ?? '');
                    $rrset->setRecords([]);

                    $rrsets[$key] = $rrset;
                } else {
                    $rrset = $rrsets[$key];
                }

                // create new record
                // if it's an SOA record, we will need to restore RDATA
                $rr = new Record();

                if ($record['type'] === 'SOA') {
                    $rr->rdata = $record;
                } elseif (!empty($record['content'])) {
                    $rr->setContent($record['content']);
                }

                $list = $rrset->getRecords() ?? [];
                $list[] = $rr;

                $rrset->setRecords($list);

                if ($record['type'] === 'SOA') {
                    $rrsets[$key] = $this->container->get(Rdata::class)->revertTo($rrset);
                }
            }
        }

        $zone->setRRSets(array_values($rrsets));

        $this->container->get(DriverInterface::class)->putZone('localhost', $arguments['zoneId'].'.', $zone);
    }
}
