<?php
namespace App\Command;

use App\Cleanning\CleaningRobot;

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
            $total = array_sum($tasks);
            echo "\n\n\t*** Total Time for Apartment Clenning (cleanning + charging) : ".array_sum($tasks) . " seconds ***";
            $progress = 0;
            foreach ($tasks as $taskType => $taskTime) 
            {
                echo "\n\t".$taskType . " Started, It will take ".$taskTime." seconds" ;
                $init_time = 1.0;
                $i = $progress;

                while(round($init_time,1) <= round($taskTime,1))
                {
                    echo "\n \t  ";
                    $progress = $total-$i;
                    sleep(intval(1));
                    self::progress_bar($progress,$total);
                    $i++;
                    $init_time++;
                }
                $progress = $i;
            }
            
            echo "\n"; self::progress_bar(0,$total);
            echo "\n\n------- Cleanning Completed -------- \n\t". date("d-m-Y H:i:s") . "\n";            
        }
    }

    public static function progress_bar($done, $total) 
    {
        $perc = floor(($done / $total) * 100);
        $left = 100 - $perc;
        $write = sprintf(" \033[0G\033[2K[%'*{$perc}s %-{$left}s] - $perc%% Pending - $done secs left", "", "");
        fwrite(STDERR, $write);
    }

    /* Validation for Floor Type. 
    *  Floor type must be either carpet or hard
    */
    private function checkFloorType($floorType) 
    {
        // echo "string"; print_r(CleaningRobot::FLOOR_TYPES); exit();
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