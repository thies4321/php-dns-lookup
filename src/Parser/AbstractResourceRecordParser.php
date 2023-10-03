<?php

declare(strict_types=1);

namespace DnsLookup\Parser;

use DnsLookup\Enum\ResourceRecordType;
use DnsLookup\Exception\ResourceRecordParserNotFound;
use DnsLookup\Parser\ResourceRecord\AParserAbstract;

abstract class AbstractResourceRecordParser implements ResourceRecordParser
{
    private const MAPPING = [
        ResourceRecordType::A->name => AParserAbstract::class,
    ];

    public static function getForResourceRecordType(string $resourceRecordType): AbstractResourceRecordParser
    {
        if (! isset(AbstractResourceRecordParser::MAPPING[$resourceRecordType])) {
            throw ResourceRecordParserNotFound::forResourceRecordType($resourceRecordType);
        }

        return new AbstractResourceRecordParser::MAPPING[$resourceRecordType];
    }
}
