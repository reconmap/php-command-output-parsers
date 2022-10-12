
all:
	composer install

test:
	composer exec phpunit

code-analysis:
	vendor/bin/psalm --report=results.sarif

