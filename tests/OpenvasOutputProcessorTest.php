<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class OpenvasOutputProcessorTest extends ParserTestCase
{

    public function testParseVulnerabilities()
    {
        $processor = new OpenvasOutputProcessor();
        $vulnerabilities = $processor->parseVulnerabilities($this->getResourceFilePath('openvas-v7.xml'));
        $this->assertCount(6, $vulnerabilities);
        $this->assertEquals('The configuration of this services should be changed sothat it does not support the listed weak ciphers anymore.', $vulnerabilities[4]->remediation);
        $this->assertEquals('This routine search for weak SSL ciphers offered by a service.', $vulnerabilities[4]->summary);
    }

    public function testParseVulnerabilitiesIncludingCvssData()
    {
        $processor = new OpenvasOutputProcessor();
        $vulnerabilities = $processor->parseVulnerabilities($this->getResourceFilePath('openvas-v7.xml'));

        $this->assertCount(6, $vulnerabilities);
        $this->assertEquals('AV:N/AC:M/Au:N/C:N/I:P/A:N', $vulnerabilities[5]->cvss_vector);
    }
}
