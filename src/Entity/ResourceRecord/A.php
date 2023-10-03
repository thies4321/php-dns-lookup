<?php

declare(strict_types=1);

namespace DnsLookup\Entity\ResourceRecord;

use DnsLookup\Entity\ResourceRecord;

use function sprintf;

final  readonly class A extends ResourceRecord
{
    private string $ip;

    public function __construct(string $host, string $class, int $ttl, string $type, string $ip)
    {
        parent::__construct($host, $class, $ttl, $type);

        $this->ip = $ip;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function toString(): string
    {
        return sprintf('%s %d %s %s %s', $this->host, $this->ttl, $this->class, $this->type, $this->ip);
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
