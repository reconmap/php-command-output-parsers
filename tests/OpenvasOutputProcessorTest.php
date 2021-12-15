<?php declare(strict_types=1);

namespace Reconmap\CommandOutputParsers;

class OpenvasOutputProcessorTest extends ParserTestCase
{
    private OpenvasOutputProcessor $processor;

    public function setUp(): void {
        $this->processor = new OpenvasOutputProcessor();
    }

    public function dataProviderTestFiles(): array {
        return [
            ['openvas-test0.xml', 6],
            ['openvas-test1.xml', 20],
            ['openvas-test2.xml', 26],
        ];
    }

    /**
     * @dataProvider dataProviderTestFiles
     */
    public function testVulnerabilitiesParsing(string $fileName, int $expectedVulnerabilitiesCount)
    {
        $vulnerabilities = $this->processor->parseVulnerabilities($this->getResourceFilePath($fileName));
        $this->assertCount($expectedVulnerabilitiesCount, $vulnerabilities);
    }

    public function testParseHostsAndPorts()
    {
        $vulnerabilities = $this->processor->parseVulnerabilities($this->getResourceFilePath('openvas-test1.xml'));
        $this->assertEquals((object)['name' => '192.168.122.230', 'port' => '135/tcp'], $vulnerabilities[0]->host);

    }

    public function testParseVulnerabilities()
    {
        $vulnerabilities = $this->processor->parseVulnerabilities($this->getResourceFilePath('openvas-test0.xml'));
        $this->assertCount(6, $vulnerabilities);
        $this->assertEquals('The configuration of this services should be changed sothat it does not support the listed weak ciphers anymore.', $vulnerabilities[4]->remediation);
        $this->assertEquals('This routine search for weak SSL ciphers offered by a service.', $vulnerabilities[4]->summary);
    }

    public function testParseVulnerabilitiesIncludingCvssData()
    {
        $vulnerabilities = $this->processor->parseVulnerabilities($this->getResourceFilePath('openvas-test0.xml'));

        $this->assertCount(6, $vulnerabilities);
        $this->assertEquals('AV:N/AC:M/Au:N/C:N/I:P/A:N', $vulnerabilities[5]->cvss_vector);
    }
}
