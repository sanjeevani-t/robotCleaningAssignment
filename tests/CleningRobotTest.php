<?php

namespace Tests\Robot;


use CleaningRobot;
use PHPUnit\Framework\TestCase;

class CleaningRobotTest extends TestCase
{
    /**
     * @dataProvider getTestDataProvider
     *
     * @param $floorType
     * @param $area
     *
     * @param $desiredOut
     *
     * @throws \Exception
     */
    public function testCleaning(string $floorType, float $area, array $desiredOut)
    {   
        // $this->assertTrue(is_string($floorType), "Got a " . gettype($floorType) . " instead of a string");
        // $this->assertTrue(is_float($area), "Got a " . gettype($area) . " instead of a float");

        $cleaningRobot = new CleaningRobot($floorType, $area);
        $tasks = $cleaningRobot->run();
        $this->assertSame($tasks,$desiredOut);
    }

    /*
    * Utility function to return data 
    */
    public function getTestDataProvider(): array {
        return [
            "hard" => ["hard", 40.0, ["cleaning - 1 : " => 40.0, "charging_1" => 20.0]],
            "carpet" => ["carpet", 20.0, ["cleaning - 1 : " => 40.0, "charging_1" => 20.0]]
        ];
    }
}