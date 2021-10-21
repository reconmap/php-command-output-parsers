<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class BurpProProcessorTest extends ParserTestCase
{

    public function testParseVulnerabilities()
    {
        $processor = new BurpproOutputProcessor();
        $vulnerabilities = $processor->parseVulnerabilities($this->getResourceFilePath('burp-2.1.02.xml'));

        $this->assertCount(17, $vulnerabilities);
        $this->assertEquals('Strict Transport Security Misconfiguration', $vulnerabilities[5]->summary);
    }
}
