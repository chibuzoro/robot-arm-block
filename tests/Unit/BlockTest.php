<?php
/**
 * @author Chibuzor Ogbu <chibuzorogbu@gmail.com>
 * @created 2021-04-27
 * @copyright ©2021. All rights reserved.
 */

namespace Test\Unit;


use App\Blocks;
use PHPUnit\Framework\TestCase;

class BlockTest extends TestCase
{
    /**
     * @test
     */
    public function canMoveBlock(){

        $size = 10;
        $params = [ 9, 1, 2]; // based off ex. input
        $block = new Blocks($size);
        $ref = new \ReflectionObject($block);
        $prop = $ref->getProperty('stacks');
        $prop->setAccessible(true);
        $initState = $prop->getValue($block);
        $this->assertTrue($block->move(...$params));
        $this->assertNotEquals($initState, $prop->getValue($block));
    }

    /**
     * @test
     */
    public function canGetStack(){

        $size = 10;
        $params = [ 9, 1, 2]; // based off ex. input
        $block = new Blocks($size);
        $stacks = $block->getStacks($params);
        $this->assertIsArray($stacks);
        $this->assertEquals(9, array_shift($stacks));

    }

    /**
     * @test
     */
    public function canResetStack(){

        $size = 10;
        $params = [ 9, 1, 2]; // based off ex. input block 9, stack 1, stack 2
        $block = new Blocks($size);
        $block->move(...$params);
        $ref = new \ReflectionObject($block);
        $prop = $ref->getProperty('stacks');
        $prop->setAccessible(true);
        $stackState = $prop->getValue($block);
        $block->reset(2, 1); // we expect 1 removed from 2
        $newState = $prop->getValue($block);
        $this->assertNotEquals($stackState[2], $newState[2]);

    }


    /**
     * @test
     */
    public function canGetBlockStateAsFormattedOutputString(){

        $size = 10;
        $block = new Blocks($size);
        $this->assertStringContainsString('1: ', $block->__toString());

    }

}
