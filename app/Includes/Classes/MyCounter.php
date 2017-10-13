<?php namespace App\Includes\Classes;

use App\Includes\CounterInterface;

class MyCounter implements CounterInterface
{
    protected $counter = 0;

    public function __construct()
    {
        $this->counter = 0;
    }

    public function increment()
    {
        return ++$this->counter;
    }

    public function decrement()
    {
        return --$this->counter;
    }

    public function getValue()
    {
        return $this->counter;
    }
}