<?php

declare(strict_types=1);

namespace RochaMarcelo\MetricsConversion\Test\TestCase;

use RochaMarcelo\MetricsConversion\Length;
use RochaMarcelo\MetricsConversion\LengthTable;

/**
 * @coversDefaultClass \RochaMarcelo\MetricsConversion\LengthTable
 */
class LengthTableTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Test convert method.
     *
     * @param float|int $value The value to test as input for convert metho.
     * @param string $measureFrom The base measure to convert from.
     * @param string $measureTo The measure to convert to.
     * @param float $expectedResult The expected result.
     *
     * @dataProvider dataProviderConvert
     * @covers ::convert
     * @return void
     */
    public function testConvert($value, string $measureFrom, string $measureTo, float $expectedResult)
    {
        $actual = LengthTable::convert($value, $measureFrom, $measureTo);

        $this->assertSame($expectedResult, $actual);
    }

    /**
     * Test convert method with invalid base unit.
     *
     * @covers ::convert
     * @return void
     */
    public function testConvertInvalidBaseUnit()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Can\'t convert value from "kg" to "m"');
        LengthTable::convert(100, 'kg', Length::METER);
    }

    /**
     * Test convert method with invalid target unit.
     *
     * @covers ::convert
     * @return void
     */
    public function testConvertInvalidTargetUnit()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Can\'t convert value from "yd" to "g"');
        LengthTable::convert(100, Length::YARD, 'g');
    }

    /**
     * @return array
     */
    public function dataProviderConvert(): array
    {
        return [
            //From inch
            [1, Length::INCH, Length::INCH, 1,],
            [1, Length::INCH, Length::FOOT, 0.08333333333333333,],
            [1, Length::INCH, Length::YARD, 1 / 36,],
            [1, Length::INCH, Length::MILE, 1.5782828282828E-5,],
            [1, Length::INCH, Length::MILLIMETER, 25.4,],
            [1, Length::INCH, Length::CENTIMETER, 2.54,],
            [1, Length::INCH, Length::METER, 0.025400050800101603,],
            [1, Length::INCH, Length::KILOMETER, 1 / 39370,],
            [10, Length::INCH, Length::INCH, 10,],
            [10, Length::INCH, Length::FOOT, 0.8333333333333334,],
            [10, Length::INCH, Length::YARD, 0.2777777777777778,],
            [10, Length::INCH, Length::MILE, 0.00015782828282828284,],
            [10, Length::INCH, Length::MILLIMETER, 254,],
            [10, Length::INCH, Length::CENTIMETER, 25.4,],
            [10, Length::INCH, Length::METER, 0.25400050800101603,],
            [10, Length::INCH, Length::KILOMETER, 0.000254000508001016,],
            //from feet
            [1, Length::FOOT, Length::INCH, 12,],
            [1, Length::FOOT, Length::FOOT, 1,],
            [1, Length::FOOT, Length::YARD, (1 / 3),],
            [1, Length::FOOT, Length::MILE, (1 / 5280),],
            [1, Length::FOOT, Length::MILLIMETER, 304.8,],
            [1, Length::FOOT, Length::CENTIMETER, 30.48,],
            [1, Length::FOOT, Length::METER, 0.3048,],
            [1, Length::FOOT, Length::KILOMETER, 1 / 3280.84,],
            [10, Length::FOOT, Length::INCH, 120,],
            [10, Length::FOOT, Length::FOOT, 10,],
            [10, Length::FOOT, Length::YARD, (10 / 3),],
            [10, Length::FOOT, Length::MILE, (10 / 5280),],
            [10, Length::FOOT, Length::MILLIMETER, 3048,],
            [10, Length::FOOT, Length::CENTIMETER, 304.8,],
            [10, Length::FOOT, Length::METER, 3.048,],
            [10, Length::FOOT, Length::KILOMETER, 10 / 3280.84,],
            //from yard
            [1, Length::YARD, Length::INCH, 36,],
            [1, Length::YARD, Length::FOOT, 3,],
            [1, Length::YARD, Length::YARD, 1,],
            [1, Length::YARD, Length::MILE, (1 / 1760),],
            [1, Length::YARD, Length::MILLIMETER, 914.4,],
            [1, Length::YARD, Length::CENTIMETER, 91.44,],
            [1, Length::YARD, Length::METER, 0.9144,],
            [1, Length::YARD, Length::KILOMETER, 0.0009144,],
            [10, Length::YARD, Length::INCH, 360,],
            [10, Length::YARD, Length::FOOT, 30,],
            [10, Length::YARD, Length::YARD, 10,],
            [10, Length::YARD, Length::MILE, (10 / 1760),],
            [10, Length::YARD, Length::MILLIMETER, 9144.0,],
            [10, Length::YARD, Length::CENTIMETER, 914.4,],
            [10, Length::YARD, Length::METER, 9.144,],
            [10, Length::YARD, Length::KILOMETER, 0.009144,],
            //from mile
            [1, Length::MILE, Length::INCH, 63360,],
            [1, Length::MILE, Length::FOOT, 5280,],
            [1, Length::MILE, Length::YARD, 1760,],
            [1, Length::MILE, Length::MILE, 1,],
            [1, Length::MILE, Length::MILLIMETER, 1609344,],
            [1, Length::MILE, Length::CENTIMETER, 160934.4,],
            [1, Length::MILE, Length::METER, 1609.344,],
            [1, Length::MILE, Length::KILOMETER, 1.609344,],
            [10, Length::MILE, Length::INCH, 633600,],
            [10, Length::MILE, Length::FOOT, 52800,],
            [10, Length::MILE, Length::YARD, 17600,],
            [10, Length::MILE, Length::MILE, 10,],
            [10, Length::MILE, Length::MILLIMETER, 16093440,],
            [10, Length::MILE, Length::CENTIMETER, 1609344,],
            [10, Length::MILE, Length::METER, 16093.44,],
            [10, Length::MILE, Length::KILOMETER, 16.09344,],
            //from millimeter
            [1, Length::MILLIMETER, Length::INCH, (1 / 25.4),],
            [1, Length::MILLIMETER, Length::FOOT, (1 / 304.8),],
            [1, Length::MILLIMETER, Length::YARD, (1 / 914.4),],
            [1, Length::MILLIMETER, Length::MILE, (1 / 1609344),],
            [1, Length::MILLIMETER, Length::MILLIMETER, 1,],
            [1, Length::MILLIMETER, Length::CENTIMETER, (1 / 10),],
            [1, Length::MILLIMETER, Length::METER, (1 / 1000),],
            [1, Length::MILLIMETER, Length::KILOMETER, (1 / 1e+6),],
            [10, Length::MILLIMETER, Length::INCH, (10 / 25.4),],
            [10, Length::MILLIMETER, Length::FOOT, (10 / 304.8),],
            [10, Length::MILLIMETER, Length::YARD, (10 / 914.4),],
            [914.4, Length::MILLIMETER, Length::YARD, 1,],
            [9144, Length::MILLIMETER, Length::YARD, 10,],
            [91440, Length::MILLIMETER, Length::YARD, 100,],
            [1609344, Length::MILLIMETER, Length::MILE, 1,],
            [16093440, Length::MILLIMETER, Length::MILE, 10,],
            [10, Length::MILLIMETER, Length::MILLIMETER, 10,],
            [10, Length::MILLIMETER, Length::CENTIMETER, 1,],
            [1000, Length::MILLIMETER, Length::METER, 1,],
            [1000000, Length::MILLIMETER, Length::KILOMETER, 1,],
            [10000000, Length::MILLIMETER, Length::KILOMETER, 10,],
            [150545432, Length::MILLIMETER, Length::KILOMETER, 150.545432,],
            //From centimeter
            [1, Length::CENTIMETER, Length::INCH, (1 / 2.54),],
            [1, Length::CENTIMETER, Length::FOOT, (1 / 30.48),],
            [1, Length::CENTIMETER, Length::YARD, (1 / 91.44),],
            [1, Length::CENTIMETER, Length::MILE, (1 / 160934.4),],
            [1, Length::CENTIMETER, Length::MILLIMETER, 10,],
            [1, Length::CENTIMETER, Length::CENTIMETER, 1,],
            [1, Length::CENTIMETER, Length::METER, (1 / 100),],
            [1, Length::CENTIMETER, Length::KILOMETER, (1 / 100000.0),],
            [10, Length::CENTIMETER, Length::INCH, (10 / 2.54),],
            [10, Length::CENTIMETER, Length::FOOT, (10 / 30.48),],
            [10, Length::CENTIMETER, Length::YARD, (10 / 91.44),],
            [91.44, Length::CENTIMETER, Length::YARD, 1,],
            [914.4, Length::CENTIMETER, Length::YARD, 10,],
            [9144, Length::CENTIMETER, Length::YARD, 100,],
            [160934.4, Length::CENTIMETER, Length::MILE, 1,],
            [1609344, Length::CENTIMETER, Length::MILE, 10,],
            [10, Length::CENTIMETER, Length::MILLIMETER, 100,],
            [10, Length::CENTIMETER, Length::CENTIMETER, 10,],
            [100, Length::CENTIMETER, Length::METER, 1,],
            [100000, Length::CENTIMETER, Length::KILOMETER, 1,],
            [1000000, Length::CENTIMETER, Length::KILOMETER, 10,],
            [15054543.2, Length::CENTIMETER, Length::KILOMETER, 150.545432,],

            //From meter
            [1, Length::METER, Length::INCH, (1 / 0.0254),],
            [1, Length::METER, Length::FOOT, 3.280839895,],
            [1, Length::METER, Length::YARD, (1 / .9144),],
            [1, Length::METER, Length::MILE, (1 / 1609.344),],
            [1, Length::METER, Length::MILLIMETER, 1000,],
            [1, Length::METER, Length::CENTIMETER, 100,],
            [1, Length::METER, Length::METER, 1,],
            [1, Length::METER, Length::KILOMETER, 0.001,],
            [10, Length::METER, Length::INCH, (10 / 0.0254),],
            [10, Length::METER, Length::FOOT, (10 * 3.280839895),],
            [10, Length::METER, Length::YARD, (10 / .9144),],
            [0.9144, Length::METER, Length::YARD, 1,],
            [9.144, Length::METER, Length::YARD, 10,],
            [91.44, Length::METER, Length::YARD, 100,],
            [1609.344, Length::METER, Length::MILE, 1,],
            [16093.44, Length::METER, Length::MILE, 10,],
            [10, Length::METER, Length::MILLIMETER, 10000,],
            [10, Length::METER, Length::CENTIMETER, 1000,],
            [10, Length::METER, Length::METER, 10,],
            [1000, Length::METER, Length::KILOMETER, 1,],
            [10000, Length::METER, Length::KILOMETER, 10,],
            [150545.432, Length::METER, Length::KILOMETER, 150.545432,],

            //From km
            [1, Length::KILOMETER, Length::INCH, 39370.1,],
            [1, Length::KILOMETER, Length::FOOT, 3280.84,],
            [1, Length::KILOMETER, Length::YARD, 1 / 0.0009144,],
            [1, Length::KILOMETER, Length::MILE, 1 / 1.609344,],
            [1, Length::KILOMETER, Length::MILLIMETER, 1000000,],
            [1, Length::KILOMETER, Length::CENTIMETER, 100000,],
            [1, Length::KILOMETER, Length::METER, 1000,],
            [1, Length::KILOMETER, Length::KILOMETER, 1,],
            [10, Length::KILOMETER, Length::INCH, 393701,],
            [10, Length::KILOMETER, Length::FOOT, 32808.4,],
            [10, Length::KILOMETER, Length::YARD, 10 / 0.0009144,],
            [10, Length::KILOMETER, Length::MILE, 10 / 1.609344,],
            [10, Length::KILOMETER, Length::MILLIMETER, 10000000,],
            [10, Length::KILOMETER, Length::CENTIMETER, 1000000,],
            [10, Length::KILOMETER, Length::METER, 10000,],
            [10, Length::KILOMETER, Length::KILOMETER, 10,],
        ];
    }
}
