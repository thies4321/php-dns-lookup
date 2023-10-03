<?php

namespace DnsLookup\Entity;

abstract readonly class ResourceRecord
{
    protected string $host;
    protected string $class;
    protected int $ttl;
    protected string $type;

    public function __construct(string $host, string $class, int $ttl, string $type)
    {
        $this->host = $host;
        $this->class = $class;
        $this->ttl = $ttl;
        $this->type = $type;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getClass(): string
    {
        return $this->class;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
