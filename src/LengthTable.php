<?php

declare(strict_types=1);

namespace RochaMarcelo\MetricsConversion;

class LengthTable
{
    /**
     * @var float[][]
     */
    protected static array $multipliers = [
        Length::INCH => [
            Length::INCH => 1.0,
            Length::MILLIMETER => 25.4,
            Length::CENTIMETER => 2.54,
        ],
        Length::FEET => [
            Length::FEET => 1.0,
            Length::INCH => 12.0,
            Length::MILLIMETER => 304.8,
            Length::CENTIMETER => 30.48,
            Length::METER => 0.3048,
        ],
        Length::YARD => [
            Length::YARD => 1.0,
            Length::INCH => 36.0,
            Length::FEET => 3.0,
            Length::MILLIMETER => 914.4,
            Length::CENTIMETER => 91.44,
            Length::METER => 0.9144,
            Length::KILOMETER => 0.0009144,
        ],
        Length::MILE => [
            Length::INCH => 63360.0,
            Length::FEET => 5280.0,
            Length::YARD => 1760.0,
            Length::MILE => 1.0,
            Length::MILLIMETER => 1609344.0,
            Length::CENTIMETER => 160934.4,
            Length::METER => 1609.344,
            Length::KILOMETER => 1.609344,
        ],
        Length::MILLIMETER => [
            Length::MILLIMETER => 1.0,
        ],
        Length::CENTIMETER => [
            Length::MILLIMETER => 10.0,
            Length::CENTIMETER => 1.0,
        ],
        Length::METER => [
            Length::FEET => 3.280839895,
            Length::MILLIMETER => 1000.0,
            Length::CENTIMETER => 100.0,
            Length::METER => 1.0,
        ],
        Length::KILOMETER => [
            Length::INCH => 39370.1,
            Length::FEET => 3280.84,
            Length::MILLIMETER => 1000000,
            Length::CENTIMETER => 100000,
            Length::METER => 1000,
            Length::KILOMETER => 1.0,
        ],
    ];

    /**
     * @var float[][]
     */
    protected static array $divisors = [
        Length::INCH => [
            Length::FEET => 12.0,
            Length::YARD => 36.0,
            Length::MILE => 63360.0,
            Length::METER => 39.37,
            Length::KILOMETER => 39370.0,
        ],
        Length::FEET => [
            Length::YARD => 3.0,
            Length::MILE => 5280.0,
            Length::KILOMETER => 3280.84,
        ],
        Length::YARD => [
            Length::MILE => 1760.0,
        ],
        Length::MILLIMETER => [
            Length::INCH => 25.4,
            Length::FEET => 304.8,
            Length::YARD => 914.4,
            Length::MILE => 1609344.0,
            Length::CENTIMETER => 10.0,
            Length::METER => 1000.0,
            Length::KILOMETER => 1e+6,
        ],
        Length::CENTIMETER => [
            Length::INCH => 2.54,
            Length::FEET => 30.48,
            Length::YARD => 91.44,
            Length::MILE => 160934.4,
            Length::METER => 100.0,
            Length::KILOMETER => 100000.0,
        ],
        Length::METER => [
            Length::INCH => 0.0254,
            Length::YARD => 0.9144,
            Length::MILE => 1609.344,
            Length::KILOMETER => 1000.0,
        ],
        Length::KILOMETER => [
            Length::YARD => 0.0009144,
            Length::MILE => 1.609344,
        ]
    ];

    /**
     * @param float|int $value The value to convert.
     * @param string $from The value current measure type.
     * @param string $to The measure type to convert.
     * @return float
     */
    public static function convert($value, string $from, string $to): float
    {
        if (isset(static::$multipliers[$from][$to])) {
            return $value * static::$multipliers[$from][$to];
        }
        if (isset(static::$divisors[$from][$to])) {
            return $value / static::$divisors[$from][$to];
        }
        throw new \InvalidArgumentException(
            sprintf('Can\'t convert value from "%s" to "%s"', $from, $to)
        );
    }
}
