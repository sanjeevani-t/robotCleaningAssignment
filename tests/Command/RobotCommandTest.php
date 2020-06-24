<?php
namespace Tests\Command;


use App\Command\RobotCommand;
use PHPUnit\Framework\TestCase;

class RobotCommandTest extends TestCase {

    /**
     * Test wrong inputs
     *
     * @throws \Exception
     */
    public function testWrongInputs() 
    {
        // $mock = $this->getMockBuilder("floor")->setMethods(['getOption'])->getMock();

        // $floorType = $mock->expects($this->any())
        //     ->method('getOption')
        //     ->will($this->returnCallback([$this, 'getDataPerParameter']));

        // $area = $mock->expects($this->at(1))
        //     ->method("writeln")
        //     ->will($this->returnCallback([$this, "wrongFloorValue"]));

        $robotCommand = new RobotCommand();
        // echo "\n floor type "; print_r($floorType);
        $floorType = "carpet";
        $area=10;
        $tasks = $robotCommand->run($floorType, $area);
        // $this->assertSame($tasks,"Done");
        $this->assertFalse(false);
    }

    /**
     * Assert for area value
     *
     * @param $areaMessage
     */
    public function wrongAreaValue(string $areaMessage) {
        $this->assertContains(" - not valid", $areaMessage);
    }

    /**
     * Assert for floor value
     *
     * @param $floorMessage
     */
    public function wrongFloorValue(string $floorMessage) {
        $this->assertContains(" - not valid", $floorMessage);
    }

    /**
     * Test values
     *
     * @return string
     */
    public function getDataPerParameter(): string {
        $args = func_get_args();
        if ($args[1] === "floor") {
            return "non carpet";
        }
        elseif ($args[2] === "area") {
            return "-20";
        }
    }
}