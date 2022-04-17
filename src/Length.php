<?php

declare(strict_types=1);

namespace RochaMarcelo\MetricsConversion;

class Length
{
    public const CENTIMETER = 'cm';
    public const FEET = 'ft';
    public const INCH = 'in';
    public const KILOMETER = 'km';
    public const METER = 'm';
    public const MILE = 'mi';
    public const MILLIMETER = 'mm';
    public const YARD = 'yd';

    /**
     * @var string[]
     */
    public const LIST = [
        self::CENTIMETER,
        self::FEET,
        self::INCH,
        self::KILOMETER,
        self::METER,
        self::MILE,
        self::MILLIMETER,
        self::YARD,
    ];

    /**
     * @var float|int
     */
    private $value;

    /**
     * @var string
     */
    private string $unit;

    /**
     * @param float|int $value The length value.
     * @param string $unit The base unit of the value.
     */
    public function __construct($value, string $unit)
    {
        if (!in_array($unit, self::LIST)) {
            throw new \InvalidArgumentException(sprintf('Invalid length unit "%s".', $unit));
        }
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @return float
     */
    public function toCentimeters(): float
    {
        return LengthTable::convert($this->value, $this->unit, self::CENTIMETER);
    }

    /**
     * @return float
     */
    public function toFeet(): float
    {
        return LengthTable::convert($this->value, $this->unit, self::FEET);
    }

    /**
     * @return float
     */
    public function toInches(): float
    {
        return LengthTable::convert($this->value, $this->unit, self::INCH);
    }

    /**
     * @return float
     */
    public function toKilometers(): float
    {
        return LengthTable::convert($this->value, $this->unit, self::KILOMETER);
    }

    /**
     * @return float
     */
    public function toMeters(): float
    {
        return LengthTable::convert($this->value, $this->unit, self::METER);
    }

    /**
     * @return float
     */
    public function toMiles(): float
    {
        return LengthTable::convert($this->value, $this->unit, self::MILE);
    }

    /**
     * @return float
     */
    public function toMillimeters(): float
    {
        return LengthTable::convert($this->value, $this->unit, self::MILLIMETER);
    }

    /**
     * @return float
     */
    public function toYards(): float
    {
        return LengthTable::convert($this->value, $this->unit, self::YARD);
    }

    /**
     * @param string $unitTo The unit to convert to, see LengthTable::convert
     * @return float
     */
    public function to(string $unitTo): float
    {
        return LengthTable::convert($this->value, $this->unit, $unitTo);
    }
}
