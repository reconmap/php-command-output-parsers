<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

interface HostParser
{
    public function parseHost(string $path): array;
}
