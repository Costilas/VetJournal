<?php

namespace App\Support\Visit;

/**
 * Utility class for formatting and preparing parameter values such as weight and temperature.
 *
 * This class provides methods for:
 * - Converting stored numeric values to human-readable format
 * - Preparing raw user input for consistent storage
 */
final class ParametersFormatter
{
    /**
     * Scaling factor used to store weight as integer (e.g. kilograms * 1000).
     *
     * @var int
     */
    private static int $weightScale = 1000;

    /**
     * Scaling factor used to store temperature as integer (e.g. Celsius * 10).
     *
     * @var int
     */
    private static int $temperatureScale = 10;

    /**
     * Converts a stored temperature value into a human-readable format.
     *
     * For example: 215 (stored) → 21 (view)
     *
     * @param int $temperature Temperature value stored in the database
     * @return float Human-readable temperature value
     */
    public static function formatTemperatureForView(int $temperature): float
    {
        return $temperature / self::$temperatureScale;
    }

    /**
     * Converts a stored weight value into a human-readable format.
     *
     * For example: 12000 (stored) → 12 (view)
     *
     * @param int $weight Weight value stored in the database
     * @return float Human-readable weight value
     */
    public static function formatWeightForView(int $weight): float
    {
        return $weight / self::$weightScale;
    }

    /**
     * Prepares a temperature value from user input for storage.
     *
     * For example: "21.5" → 215 (stored)
     *
     * @param string $temperature Raw temperature input from the user
     * @return int Scaled temperature value suitable for storage
     */
    public static function prepareTemperatureForStore(string $temperature): int
    {
        return self::prepareNumericData($temperature) * self::$temperatureScale;
    }

    /**
     * Prepares a weight value from user input for storage.
     *
     * For example: "12.5" → 12500 (stored)
     *
     * @param string $weight Raw weight input from the user
     * @return int Scaled weight value suitable for storage
     */
    public static function prepareWeightForStore(string $weight): int
    {
        return self::prepareNumericData($weight) * self::$weightScale;
    }

    /**
     * Normalizes numeric string input into a float value.
     *
     * This method handles common formatting issues like commas and spaces.
     *
     * @param string $string Raw numeric string input
     * @return float Parsed numeric value
     */
    private static function prepareNumericData(string $string): float
    {
        $prepared = self::stringCleaner($string);

        return floatval($prepared);
    }

    /**
     * Cleans a string by removing extra spaces and normalizing decimal separators.
     *
     * Converts both commas and periods to a single dot, and trims surrounding whitespace.
     *
     * @param string $string The string to clean
     * @return string Cleaned numeric string
     */
    private static function stringCleaner(string $string): string
    {
        return trim(str_replace([',', '.'], '.', $string), ' .');
    }
}
