<?php

require __DIR__ . '/../vendor/autoload.php';

use Headless\Inc\FactoryPilotValidation;

/**
 * Simple test for FactoryPilotValidation helper.
 */
function assertTrue(bool $condition, string $message): void
{
    if (! $condition) {
        fwrite(STDERR, $message . PHP_EOL);
        exit(1);
    }
}

assertTrue(FactoryPilotValidation::isValid('abc123'), 'Expected abc123 to be valid');
assertTrue(! FactoryPilotValidation::isValid(''), 'Expected empty string to be invalid');
assertTrue(! FactoryPilotValidation::isValid('abc 123'), 'Expected string with space to be invalid');
assertTrue(FactoryPilotValidation::isValid('A1B2C3'), 'Expected A1B2C3 to be valid');

echo 'Success' . PHP_EOL;
exit(0);
