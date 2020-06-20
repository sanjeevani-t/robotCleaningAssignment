# robotCleaningAssignment
robotCleaningAssignement

### Problem Statement ###
Create robot for cleanning purpose.
It accept either hard or carpet as a floor.
Output should be a periodic status on the current state of the different entities.

### Assumptions ###
● The robot has a battery big enough to clean for 60 seconds in one charge. 
● The robot can clean 1 m2 of hard floor in 1 second. 
● The robot can clean 1 m2 of carpet in 2 seconds. 
● The battery charge from 0 to 100% takes 30 seconds.

### How to Run ###
Run command $ robot.php clean --floor=carpet --area=70 and you can see robot state either cleannning or charging.

### PHPUnit Test ###
Run command $ vendor\bin\phpunit tests for unit testing
