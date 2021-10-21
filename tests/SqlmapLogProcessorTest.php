<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class SqlmapLogProcessorTest extends ParserTestCase
{

    public function testParseVulnerabilities()
    {
        $processor = new SqlmapOutputProcessor();
        $vulnerabilities = $processor->parseVulnerabilities($this->getResourceFilePath('sqlmap-log-example.txt'));
        $this->assertCount(1, $vulnerabilities);
        $this->assertEquals("SQL can be injected using parameter 'username (POST)'", $vulnerabilities[0]->description);
    }
}
