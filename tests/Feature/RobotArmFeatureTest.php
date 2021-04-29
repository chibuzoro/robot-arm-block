<?php
/**
 * @author Chibuzor Ogbu <chibuzorogbu@gmail.com>
 * @created 2021-04-27
 * @copyright ©2021. All rights reserved.
 */


class RobotArmFeatureTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @test
     */
   public function robotCanMoveBlocksByCommandInput()
   {
       $commands = dirname(__DIR__,2).'/commands.txt';

       $runner = new \App\Console([
           'my_app',
           $commands
       ]);

       ob_start();
       $runner->run();
       $line = ob_get_clean();
       $this->assertStringContainsString('1: 1 9 2 4', $line);
   }

}
