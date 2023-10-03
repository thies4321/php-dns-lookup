<?php

declare(strict_types=1);

namespace DnsLookup\Exception;

use Exception;

use function sprintf;

final class UnsupportedRecordType extends Exception
{
    public static function forResoureRecordType(string $resourceRecordType): self
    {
        return new self(sprintf('RR type [%s] is not supported', $resourceRecordType));
    }
}
