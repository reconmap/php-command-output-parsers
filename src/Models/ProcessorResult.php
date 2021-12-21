<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers\Models;

class ProcessorResult
{
    public function __construct(
        private array $assets = [],
        private array $vulnerabilities = []) {
    }

    public function addAsset(Asset $asset) {
        $this->assets[] = $asset;
    }

    public function getAssets(): array {
        return $this->assets;
    }

    public function addVulnerability(Vulnerability $vulnerability) {
        $this->vulnerabilities[] = $vulnerability;
    }

    public function getVulnerabilities(): array {
        return $this->vulnerabilities;
    }
}
