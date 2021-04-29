<?php
/**
 * @author Chibuzor Ogbu <chibuzorogbu@gmail.com>
 * @created 2021-04-27
 * @copyright ©2021. All rights reserved.
 */


namespace App;


class Runner
{

    /**
     * @var Blocks
     */
    private Blocks $blocks;
    /**
     * @var RobotArm
     */
    private RobotArm $robot;

    public function run($commands)
    {

        // send commands to robot arm
        foreach ($commands as $params) {
            $this->robot->{$params['command']}(...$params['params']);
        }

        // output
        return $this->blocks->__toString();

    }

    public function initBlocks(int $number)
    {
        // build the block world
        $this->blocks = new Blocks($number);

        return $this;
    }

    public function initArm()
    {
        if (!$this->blocks){
            throw new \LogicException('No Block instantiated');
        }

        // instantiate a robot
        $this->robot = new RobotArm($this->blocks);

        return $this;
    }
}
