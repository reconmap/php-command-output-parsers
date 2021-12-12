<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class OpenvasOutputProcessor extends AbstractCommandParser implements VulnerabilityParser
{
    /**
     * @param string $path
     * @return array<Vulnerability>
     */
    public function parseVulnerabilities(string $path): array
    {
        $vulnerabilities = [];

        $xml = simplexml_load_file($path);

        foreach ($xml->report->results->result as $rawHost) {
            $host = [
                'name' => (string)$rawHost['host']
            ];

            foreach ($rawHost->nvt as $rawVulnerability) {
                $vulnerability = new Vulnerability();
                $vulnerability->summary = (string)$rawVulnerability->name . ' - ' . (string)$rawVulnerability->cve;

                $tags = explode('|', (string)$rawVulnerability->tags);
                foreach($tags as $tag) {
                    list($key, $value) = explode('=', $tag);
                    switch($key) {
                        case 'cvss_base_vector':
                            $vulnerability->cvss_vector = $value;
                            break;
                        case 'summary':
                            $vulnerability->summary = str_replace("\n", "", $value);
                            break;
                        case 'solution':
                            $vulnerability->remediation = str_replace("\n", "", $value);
                            break;
                    }
                }

                
                $vulnerability->external_refs = (string)$rawVulnerability->xref;
                $vulnerability->description = preg_replace('/^ +/', '', (string)$rawVulnerability->description);

                $risk = strtolower((string)$rawVulnerability->threat);
                $vulnerability->risk = $risk;

                //$vulnerability->remediation = $remediation;
                // Dynamic props
                $vulnerability->host = (object)$host;
                $vulnerability->severity = (string)$rawVulnerability->severity;

                if (isset($rawVulnerability->cvss_base_score)) {
                    $vulnerability->cvss_score = (float)$rawVulnerability->cvss_base_score;
                }
                if (isset($rawVulnerability->cvss_vector)) {
                    $vulnerability->cvss_vector = (string)$rawVulnerability->cvss_vector;
                }

                $vulnerabilities[] = $vulnerability;
            }
        }

        return $vulnerabilities;
    }
}
