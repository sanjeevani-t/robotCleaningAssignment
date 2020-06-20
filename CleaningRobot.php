<?php

class CleaningRobot 
{
    const FLOOR_TYPES = ['hard' => 1, 'carpet' => 0.5]; // floor type with speed
    const BATTERY_LIMIT = 60;
    const BATTERY_CHARGING_TIME = 30;

    private $floorArea;
    private $cleaningSpeed;
    private $batteryCapacity;

    public function __construct(string $floorType, float $area) 
    {
        $this->floorArea = new FloorArea($area);
        $this->cleaningSpeed = $this::FLOOR_TYPES[$floorType];
        $this->batteryCapacity = new BatteryCapacity($this::BATTERY_LIMIT, $this::BATTERY_CHARGING_TIME);
    }

    /*
    * Retuen array of cleaning area with how much time it will take for charging
    */
    public function run(): array 
    {
        $tasks = [];
        $i = 0;

        while (TRUE) 
        {
            $i++;
            [
                $area,
                $cleaningTime,
            ] = $this->getCleaningAreaTime();

            //cleaning
            $this->floorArea->clean($area);
            $this->batteryCapacity->work($cleaningTime);
            $tasks["cleanning - " . $i] = $cleaningTime;
            
            //Charging
            $timeToCharge = $this->batteryCapacity->charge();
            $tasks["charging - " . $i] = $timeToCharge;
            if ($this->floorArea->isCleaned()) {
                break;
            }
        }
        // echo "\n TASK *** "; print_r($tasks);
        return $tasks;
    }

    private function getCleaningAreaTime() 
    {
        $mostWorkingTime = $this->batteryCapacity->getMostWorkingTime();
        $mostCleaningArea = $this->floorArea->getMostCleaningArea();
        $areaToCleanInMostTime = $this->getAreaForTime($mostWorkingTime);
        $mostCleaningAreaTime = $this->getTimeForArea($mostCleaningArea);
        $leastArea = min($areaToCleanInMostTime, $mostCleaningArea);
        $leastCleaningTime = min($mostWorkingTime, $mostCleaningAreaTime);
        return [$leastArea, $leastCleaningTime];
    }

    public function getAreaForTime(float $seconds): float {
        return $seconds * $this->cleaningSpeed;
    }

    public function getTimeForArea(float $metersSquaredArea): float {
        return $metersSquaredArea / $this->cleaningSpeed;
    }

}