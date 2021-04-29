<?php
/**
 * @author Chibuzor Ogbu <chibuzorogbu@gmail.com>
 * @created 2021-04-27
 * @copyright ©2021. All rights reserved.
 */


namespace App;


class RobotArm
{
    private Blocks $blocks;


    public function __construct(Blocks $blocks)
    {
        $this->blocks = $blocks;
    }


    public function moveOnto($blockA, $blockB)
    {
        [$stackA, $stackB] = $this->blocks->getStacks(func_get_args());
        // handle validation - illegal commands should have no effect so we return true
        if ($blockA === $blockB || $stackA === $stackB) {
            return true;
        }
        $this->blocks->reset($stackA, $blockA);
        $this->blocks->reset($stackB, $blockB);

        return $this->blocks->move($blockA, $stackA, $stackB);
    }


    public function moveOver($blockA, $blockB)
    {
        [$stackA, $stackB] = $this->blocks->getStacks(func_get_args());

        // handle validation - illegal commands should have no effect so we return true
        if ($blockA === $blockB || $stackA === $stackB) {
            return true;
        }

        $this->blocks->reset($stackA, $blockA);

        return $this->blocks->move($blockA, $stackA, $stackB);
    }


    public function pileOnto($blockA, $blockB)
    {
        [$stackA, $stackB] = $this->blocks->getStacks(func_get_args());

        // handle validation - illegal commands should have no effect so we return true
        if ($blockA === $blockB || $stackA === $stackB) {
            return true;
        }
        $this->blocks->reset($stackB, $blockB);

        return $this->blocks->move($blockA, $stackA, $stackB);
    }


    public function pileOver($blockA, $blockB)
    {
        [$stackA, $stackB] = $this->blocks->getStacks(func_get_args());

        // handle validation - illegal commands should have no effect so we return true
        if ($blockA === $blockB || $stackA === $stackB) {
            return true;
        }

        return $this->blocks->move($blockA, $stackA, $stackB);
    }

}
