
.PHONY: test
test:
	XDEBUG_MODE=coverage vendor/bin/phpunit
