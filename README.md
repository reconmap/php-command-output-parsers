# Reconmap command output parsers library

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
