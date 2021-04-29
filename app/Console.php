<?php
/**
 * @author Chibuzor Ogbu <chibuzorogbu@gmail.com>
 * @created 2021-04-28
 * @copyright ©2021. All rights reserved.
 */


namespace App;


use SplFileObject;

class Console
{
    /**
     * @var int $number of blocks in the world (1...n-1)
     */
    private int $number;


    /**
     * @var array $commands robot arm needs to execute
     */
    private array $commands;


    public function __construct(array $argv)
    {
        $argv = $argv ?? $_SERVER['argv'] ?? [];

        // toss the app name. then parse the first argument. subsequent arguments will be ignored.
        array_shift($argv);
        $this->parse(array_shift($argv));

    }


    private function parse($input)
    {
        $format = '/(?P<count>\d+)|(?P<name>\w+) (?P<blocka>\d+) (?P<step>\w+) (?P<blockb>\d+)/';
        $file = new SplFileObject($input);

        while (!$file->eof()) {
            $line = rtrim($file->fgets());
            if (strtolower($line) !== 'quit' && preg_match($format, $line, $matches)) {
                $this->buildCommand($matches);
            }
        }
        $file = null;
    }


    final public function run(): void
    {

        $this->output((new Runner())
            ->initBlocks($this->number)
            ->initArm()
            ->run($this->commands));

    }

    private function buildCommand($s)
    {
        if (!isset($this->number) && isset($s['count'])) {
            $this->number = (int) $s['count'];
        }

        if (isset($s['name'])) {
            $this->commands[] = [
                'command' => implode('', [strtolower($s['name']), ucfirst($s['step'])]),
                'params' => [(int) $s['blocka'], (int) $s['blockb']],
            ];
        }

    }

    private function output(string $string)
    {
        $output = fopen('php://output', 'wb');
        fwrite($output, $string);
        fclose($output);
    }

}
