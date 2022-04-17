<?php

declare(strict_types=1);

namespace RochaMarcelo\MetricsConversion\Test\TestCase;

use PHPUnit\Framework\TestCase;
use RochaMarcelo\MetricsConversion\Length;

/**
 * @coversDefaultClass \RochaMarcelo\MetricsConversion\Length
 */
class LengthTest extends TestCase
{
    /**
     * @covers ::toInches
     * @covers ::toFeet
     * @covers ::toKilometers
     * @covers ::toMeters
     * @covers ::toMiles
     * @covers ::toMillimeters
     * @covers ::toYards
     * @covers ::toCentimeters
     *
     * @return void
     */
    public function testToUnitAll()
    {
        $length = new Length(15345.345323, Length::CENTIMETER);
        $this->assertEquals(503.4562113845144, $length->toFeet());
        $feet = new Length(503.4562113845144, Length::FEET);
        $this->assertEquals(6041.474536614173, $length->toInches());
        $this->assertEquals(6041.474536614173, $feet->toInches());
        $inches = new Length(6041.474536614173, Length::INCH);
        $this->assertEquals(0.15345345323, $length->toKilometers());
        $this->assertEquals(0.153454, round($inches->toKilometers(), 6));
        $km = new Length(0.15345345323, Length::KILOMETER);
        $this->assertEquals(153.45345323, $length->toMeters());
        $this->assertEquals(153.45345323, $km->toMeters());
        $meters = new Length(153.45345323, Length::METER);
        $this->assertEquals(0.09535155518646107, $length->toMiles());
        $this->assertEquals(0.09535155518646107, $meters->toMiles());
        $miles = new Length(0.09535155518646107, Length::MILE);
        $this->assertEquals(153453.45323, $length->toMillimeters());
        $this->assertEquals(153453.45323, $miles->toMillimeters());
        $miles = new Length(153453.45323, Length::MILE);
        $this->assertEquals(167.81873712817148, $length->toYards());
        $yards = new Length(167.81873712817148, Length::YARD);
        $this->assertEquals(15345.345323, $length->toCentimeters());
        $this->assertEquals(15345.345323, $yards->toCentimeters());
    }

    /**
     * @covers ::to
     * @return void
     */
    public function testTo()
    {
        $length = new Length(15345.345323, Length::CENTIMETER);
        $this->assertEquals(503.4562113845144, $length->to(Length::FEET));
        $this->assertEquals(153.45345323, $length->to(Length::METER));
    }

    /**
     * @covers ::__construct
     * @return void
     */
    public function testCreationWithInvalidUnit()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid length unit "gm".');
        new Length(10, 'gm');
    }
}
