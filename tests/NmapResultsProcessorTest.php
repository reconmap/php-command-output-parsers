<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class NmapResultsProcessorTest extends ParserTestCase
{

    public function testParseVulnerabilities()
    {
        $processor = new NmapOutputProcessor();
        $vulnerabilities = $processor->parseVulnerabilities($this->getResourceFilePath('nmap-output-example.xml'));
        $this->assertCount(4, $vulnerabilities);
        $this->assertEquals("The port 3306 is open and could be used by an attacker to get into your system. Unless you need this port open consider shutting the service down or restricting access using a firewall.", $vulnerabilities[2]->description);
        $this->assertEquals("The port 8080 is open and could be used by an attacker to get into your system. Unless you need this port open consider shutting the service down or restricting access using a firewall.", $vulnerabilities[3]->description);
    }
}
