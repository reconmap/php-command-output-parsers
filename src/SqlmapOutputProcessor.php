<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class SqlmapOutputProcessor extends AbstractCommandParser implements VulnerabilityParser
{

    public function parseVulnerabilities(string $path): array
    {
        $vulnerabilities = [];

        $logContent = file_get_contents($path);

        if (stripos($logContent, 'sqlmap identified the following injection point(s)') !== false) {
            preg_match('/Parameter: (.+)/', $logContent, $matches);
            $parameter = $matches[1];
            $vulnerability = new Vulnerability;
            $vulnerability->summary = "SQL injection";
            $vulnerability->description = "SQL can be injected using parameter '$parameter'";
            $vulnerabilities[] = $vulnerability;
        }

        return $vulnerabilities;
    }
}
