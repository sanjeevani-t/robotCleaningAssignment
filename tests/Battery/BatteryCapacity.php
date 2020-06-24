<?php

namespace Tests\Battery;

use App\Battery\BatteryCapacity;
use PHPUnit\Framework\TestCase;
use Exception;

class BatteryCapacityTest extends TestCase {

    /**
     * Test to check battery capacity.
     *
     * @dataProvider getTestWorkProvider
     *
     * @param $batteryLimit
     * @param $workTimeInSeconds
     * @param $expectedMinutesCapacity
     *
     * @throws \Exception
     */
    public function testWork(float $batteryLimit, float $workTimeInSeconds, float $expectedMinutesCapacity) {
        $batteryCapacity = new BatteryCapacity($batteryLimit, 0);
        $batteryCapacity->work($workTimeInSeconds);
        $minutesCapacity = $BatteryCapacity->getMostWorkingTime();
        $this->assertSame($expectedMinutesCapacity, $minutesCapacity);
    }

    /**
     * Provides data for testWork.
     *
     * @return array
     */
    public function getTestWorkProvider(): array {
        return [
            "Half battery after work" => [60.0, 30.0, 30.0],
            "Empty battery after work" => [60.0, 60.0, 0.0],
        ];
    }

    /**
     * Test charging
     *
     * @dataProvider getTestChargeProvider
     *
     * @param $batteryLimit
     * @param $workTimeInSeconds
     * @param $batteryChargingTime
     * @param $expectedbatteryChargingTime
     *
     * @throws \Exception
     */
    public function testCharge(float $batteryLimit, float $workTimeInSeconds, float $batteryChargingTime, float $expectedbatteryChargingTime) {
        $batteryCapacity = new BatteryCapacity($batteryLimit, $batteryChargingTime);
        $batteryCapacity->work($workTimeInSeconds);
        $batteryChargingTime = $batteryCapacity->charge();
        $this->assertSame($expectedbatteryChargingTime, $batteryChargingTime);
    }

    /**
     * Provides data for testCharge.
     *
     * @return array
     */
    public function getTestChargeProvider(): array {
        return [
            "Half battery after work" => [60.0, 30.0, 30.0, 15.0],
            "Empty battery after work" => [60.0, 60.0, 30.0, 30.0],
            "Full battery after work" => [60.0, 0.0, 30.0, 0.0],
        ];
    }

    /**
     * Work more than the capacity of battery.
     *
     * @throws \Exception
     */
    public function testWorkMoreThanCapacity() {
        $batteryCapacity = new BatteryCapacity(60, 30);
        $this->expectException(Exception::class);
        $batteryCapacity->work(61);
    }
}