<?php

declare(strict_types=1);

namespace DnsLookup\Exception;

use Exception;

use function sprintf;

final class ResourceRecordParserNotFound extends Exception
{
    public static function forResourceRecordType(string $resourceRecordType): self
    {
        return new self(sprintf('No available parser found for RR type [%s]', $resourceRecordType));
    }
}
