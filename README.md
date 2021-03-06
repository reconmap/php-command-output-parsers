[![codecov](https://codecov.io/gh/reconmap/php-command-output-parsers/branch/master/graph/badge.svg?token=t3ODnO2R8u)](https://codecov.io/gh/reconmap/php-command-output-parsers)

# Reconmap security command output parsers library

## Supported tools

- Burp
- Metasploit
- Nessus
- Nmap
- Nuclei
- OpenVAS
- Qualys
- SQLmap
- Subfinder
- TestSSL
- ZAP

## Requirements

* PHP8.1
* Composer

## Usage

```shell
composer require reconmap/command-output-parsers
```

## Examples

### Nessus

```php
$processor = new NessusOutputProcessor();
$vulnerabilities = $processor->parseVulnerabilities('resources/nessus.xml'); # Returns 5 vulnerabilities
echo $vulnerabilities[4]->remediation); # Prints 'Protect your target with an IP filter.'
```
