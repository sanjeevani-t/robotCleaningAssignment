<?php
namespace App\Battery;

class BatteryCapacity 
{

    private $batteryLimit;
    private $BatteryChargingTime;
    private $capacity;

    public function __construct(float $batteryLimit, float $BatteryChargingTime) 
    {
        $this->batteryLimit = $batteryLimit;
        $this->BatteryChargingTime = $BatteryChargingTime;
        $this->capacity = 1;
    }

    public function getMostWorkingTime(): float 
    {
        return $this->batteryLimit * $this->capacity;
    }

    public function charge(): float 
    {
        $timeToCharge = $this->BatteryChargingTime * (1 - $this->capacity);
        $this->capacity = 1;
        return $timeToCharge;
    }

    public function work(float $seconds) 
    {
        if ($seconds <= $this->getMostWorkingTime()) {
            $this->capacity = 1 - ($seconds / $this->batteryLimit);
        }
        else {
            throw new Exception('Exception : Battery down.');
        }
    }

}