<?php namespace App\Includes;

interface CounterInterface
{
    public function increment();
    public function decrement();
    public function getValue();
}