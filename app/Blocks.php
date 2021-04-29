<?php
/**
 * @author Chibuzor Ogbu <chibuzorogbu@gmail.com>
 * @created 2021-04-27
 * @copyright ©2021. All rights reserved.
 */


namespace App;


class Blocks
{
    private int $size;
    private array $stacks;

    public function __construct(int $size)
    {
        $this->size = $size;
        $this->fillStack($size);
    }


    public function reset($stack, $block)
    {
        foreach ($this->stacks[$stack] as $blockI) {
            if($block === $blockI){
                break;
            }
            $this->stacks[$blockI] = $blockI;
        }
    }


    public function move($block, $from, $to): bool
    {
        $blocks = $this->stacks[$from];
        $this->stacks[$from] = array_splice($blocks, 0, array_search($block, $blocks, true));
        $this->stacks[$to] = array_merge($this->stacks[$to], $blocks);

        return true;

    }


    /**
     * @param  array  $blocks
     * @return array
     */
    public function getStacks(array $blocks): array
    {
        return array_map(function ($block) {
            return $this->stack($block);
        }, $blocks);
    }


    public function __toString():string
    {
        $lines = [];
        foreach ($this->xrange($this->size) as $stack) {
            $string =  implode(' ', array_map(static function($block) {
                return $block;
            },$this->stacks[$stack]));
            $lines[] = sprintf("%d: %s", $stack, $string);

        }
        return PHP_EOL.implode(PHP_EOL, $lines).PHP_EOL;
    }


    private function stack($block)
    {
        foreach ($this->xrange($this->size) as $stack) {
            if (array_filter($this->stacks[$stack], static function ($blockInStack) use ($block) {
                return $blockInStack === $block;
            })) {
                return $stack;
            }
        }
    }


    private function xrange($size)
    {
        $start = 0;
        if ($size < $start) {
            throw new \LogicException('Size can\'t be less than 0');
        }

        for ($i = $start; $i < $size; $i++) {
            yield $i;
        }
    }


    private function fillStack(int $size): void
    {
        foreach ($this->xrange($size) as $block) {
            $this->stacks[] = [$block];
        }
    }

}
