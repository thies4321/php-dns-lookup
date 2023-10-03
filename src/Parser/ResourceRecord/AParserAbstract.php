<?php

namespace DnsLookup\Parser\ResourceRecord;

use DnsLookup\Entity\ResourceRecord\A;
use DnsLookup\Parser\AbstractResourceRecordParser;
use function array_map;

final class AParserAbstract extends AbstractResourceRecordParser
{
    public function parse(array $dnsLookupResults): array
    {
        return array_map(function (array $dnsLookupResult) {
            return new A();
        }, $dnsLookupResults);
    }
}
