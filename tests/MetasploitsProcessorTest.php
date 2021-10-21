<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class MetasploitsProcessorTest extends ParserTestCase
{

    public function testParseVulnerabilities()
    {
        $processor = new MetasploitOutputProcessor();
        $vulnerabilities = $processor->parseVulnerabilities($this->getResourceFilePath('metasploit.xml'));

        $this->assertCount(2, $vulnerabilities);
        $this->assertEquals('exploit/windows/smb/ms08_067_netapi', $vulnerabilities[1]->summary);
    }
}
