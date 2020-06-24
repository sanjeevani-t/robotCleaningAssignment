<?php
namespace Tests\Floor;

use PHPUnit\Framework\TestCase;
use App\Floor\FloorArea;
use Exception;

class FloorAreaTest extends TestCase {

    /**
     * Test algorithm for cleaning.
     *
     * @dataProvider getCleaningProvider
     *
     * @param $metersSquared
     * @param $clean
     * @param $expectedMaxCleaningArea
     * @param $expectedIsCleaned
     *
     * @throws \Exception
     */
    public function testClean(float $metersSquared, float $clean, float $expectedMaxCleaningArea, bool $expectedIsCleaned) {
        $floorArea = new FloorArea($metersSquared);
        $floorArea->clean($clean);
        $maxCleaningArea = $floorArea->getMostCleaningArea();
        $isCleaned = $floorArea->isCleaned();
        $this->assertSame($expectedMaxCleaningArea, $maxCleaningArea);
        $this->assertSame($expectedIsCleaned, $isCleaned);
    }

    /**
     * Provides data for testClean.
     *
     * @return array
     */
    public function getCleaningProvider(): array {
        return [
            "Basic subtraction" => [70.0, 30.0, 40.0, false],
            "Clean whole area" => [30.0, 30.0, 0.0, true],
            "Zero area" => [0.0, 0.0, 0.0, true],
            "Float subtraction" => [0.8, 0.1, 0.7, false],
        ];
    }

    /**
     * Clean more than the area.
     *
     * @throws \Exception
     */
    public function testCleanMoreThanPossible() {
        $floorArea = new FloorArea(10);
        $this->expectException(Exception::class);
        $floorArea->clean(20);
    }
}