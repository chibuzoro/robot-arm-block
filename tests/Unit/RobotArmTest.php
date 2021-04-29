<?php
/**
 * @author Chibuzor Ogbu <chibuzorogbu@gmail.com>
 * @created 2021-04-27
 * @copyright ©2021. All rights reserved.
 */

namespace Test\Unit;


use App\RobotArm;
use Mockery;
use Mockery\Mock;
use Mockery\ReceivedMethodCalls;

class RobotArmTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function canMoveBlockAOntoB(){

        $params = [ 9,1]; // based off ex. input
        $blocks = $this->createMock(\App\Blocks::class);
        $blocks->method('getStacks')
                ->willReturn( [ 9,1]);
        $blocks->method('move')
                ->willReturn( true);

        $robot = new RobotArm($blocks);
        $this->assertTrue($robot->moveOnto(...$params));
    }


    /**
     * @test
     */
    public function canMoveBlockAOverB(){

        $params = [ 8,1]; //based off ex. input
        $blocks = $this->createMock(\App\Blocks::class);
        $blocks->method('getStacks')
            ->willReturn( [ 8,1]);
        $blocks->method('move')
            ->willReturn( true);
        $robot = new RobotArm($blocks);
        $this->assertTrue($robot->moveOver(...$params));
    }


    /**
     * @test
     */
    public function canPileBlockAOverB(){

        $params = [ 8,5]; //based off ex. input
        $blocks = $this->createMock(\App\Blocks::class);
        $blocks->method('getStacks')
            ->willReturn( [ 8,5]);
        $blocks->method('move')
            ->willReturn( true);
        $robot = new RobotArm($blocks);
        $this->assertTrue($robot->pileOver(...$params));
    }

    /**
     * @test
     */
    public function canPileBlockAOntoB(){

        $params = [ 8,1]; //based off ex. input
        $blocks = $this->createMock(\App\Blocks::class);
        $blocks->method('getStacks')
            ->willReturn( [ 8,1]);
        $blocks->method('move')
            ->willReturn( true);
        $robot = new RobotArm($blocks);
        $this->assertTrue($robot->pileOnto(...$params));
    }


    /**
     * @test
     */
    public function shouldNotChangeBlockStateWhenAEqualsB(){

        $params = [ 8,1]; //based off ex. input
        $blocks = $this->createMock(\App\Blocks::class);

        $blocks->method('getStacks')
            ->willReturn( [ 1,1]);

        //  blocks are same [1,1] thus $block->move should not be called.
        // we set its return value to false and assert for true as always
        $blocks->method('move')
            ->willReturn(false);
        $robot = new RobotArm($blocks);
        $this->assertTrue($robot->pileOnto(...$params));

    }

}
