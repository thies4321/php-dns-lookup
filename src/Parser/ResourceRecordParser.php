<?php

namespace DnsLookup\Parser;

interface ResourceRecordParser
{
    public function parse(array $dnsLookupResults): array;
}
