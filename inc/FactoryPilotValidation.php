<?php

namespace Headless\Inc;

/**
 * Class FactoryPilotValidation
 *
 * Provides a deterministic helper for validating theme input.
 */
class FactoryPilotValidation
{
    /**
     * Determine if the given input is a valid alphanumeric string.
     *
     * @param string $input The input to validate.
     * @return bool True if input contains only letters and numbers, false otherwise.
     */
    public static function isValid(string $input): bool
    {
        return (bool) preg_match('/^[a-zA-Z0-9]+$/', $input);
    }
}
