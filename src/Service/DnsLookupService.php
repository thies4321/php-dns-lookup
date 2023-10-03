<?php

declare(strict_types=1);

namespace DnsLookup\Service;

use DnsLookup\Entity\ResourceRecord;
use DnsLookup\Enum\ResourceRecordType;
use DnsLookup\Exception\UnsupportedRecordType;
use DnsLookup\Parser\AbstractResourceRecordParser;

use function array_merge;
use function dns_get_record;

use const DNS_A;
use const DNS_AAAA;

final class DnsLookupService
{
    private const RESOURCE_RECORD_MAPPING = [
        ResourceRecordType::A->name => DNS_A,
        ResourceRecordType::AAAA->name => DNS_AAAA,
    ];

    public function lookup(string $hostname, string $resourceRecordType, array $authoritativeNameServers = []): array
    {
        if (! isset(self::RESOURCE_RECORD_MAPPING[$resourceRecordType])) {
            throw UnsupportedRecordType::forResoureRecordType($resourceRecordType);
        }

        $dnsLookupResults = dns_get_record($hostname, self::RESOURCE_RECORD_MAPPING[$resourceRecordType], $authoritativeNameServers);

        if (empty($dnsLookupResults)) {
            return [];
        }

        return AbstractResourceRecordParser::getForResourceRecordType($resourceRecordType)->parse($dnsLookupResults);
    }

    /**
     * @return ResourceRecord[]
     *
     * @throws UnsupportedRecordType
     */
    public function lookupCollection(string $hostname, array $resourceRecordTypes, array $authoritativeNameServers = []): array
    {
        $result = [];

        foreach ($resourceRecordTypes as $resourceRecordType) {
            $resourceRecords = $this->lookup($hostname, $resourceRecordType, $authoritativeNameServers);

            if (empty($resourceRecords)) {
                continue;
            }

            $result = array_merge($result, $resourceRecords);
        }

        return $result;
    }
}
