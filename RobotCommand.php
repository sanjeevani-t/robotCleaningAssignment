<?php

class RobotCommand 
{

    public function run(string $floor, float $area) 
    {
        $this->clenning($floor, $area);
    }

    /*
    * Cleaning Process started
    */
    protected function clenning(string $floor, float $area) 
    {
        echo '------- Cleanning start -------- ';
        echo "\n\t". date("d-m-Y H:i:s") . "\n";
        $floorCheck = $this->checkFloorType($floor);
        $areaCheck = $this->checkArea($area);

        echo "\tFloor : " . $floor . (($floorCheck) ? "" : " - not valid")."\n";
        echo "\tArea : " . $area . (($areaCheck) ? "" : " - not valid");
        echo "\n-----------------------------------\n";

        if ($floorCheck and $areaCheck) 
        {
            $robot = new CleaningRobot($floor, $area);
            $tasks = $robot->run();
            foreach ($tasks as $taskType => $taskTime) 
            {
                echo "\n\t".$taskType . " : " . $taskTime . "s";
                sleep(intval($taskTime));
            }
            echo "\n\n------- Cleanning Completed -------- \n\t". date("d-m-Y H:i:s") . "\n";
        }
    }

    /* Validation for Floor Type. 
    *  Floor type must be either carpet or hard
    */
    private function checkFloorType($floorType) 
    {
        if (array_key_exists($floorType, CleaningRobot::FLOOR_TYPES)) 
        {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    /* Validation for Area. 
    *  Which must be numeric and greater than 0
    */
    private function checkArea($area) 
    {
        if (is_numeric($area) and $area > 0) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
}