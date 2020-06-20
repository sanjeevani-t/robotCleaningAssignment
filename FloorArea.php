<?php
class FloorArea 
{

    private $area;
    private $areaCleaned;

    public function __construct(float $area) 
    {
        $this->area = $area;
        $this->areaCleaned = 0;
    }

    public function clean(float $metersSquared): float 
    {
        if ($metersSquared > $this->area - $this->areaCleaned) 
        {
            throw new Exception('Exception occured.');
        }
        else {
            $this->areaCleaned += $metersSquared;
        }
        return $this->area - $this->areaCleaned - $metersSquared;
    }

    public function getMostCleaningArea(): float 
    {
        return $this->area - $this->areaCleaned;
    }

    public function isCleaned(): bool 
    {
        return $this->areaCleaned >= $this->area;
    }
}