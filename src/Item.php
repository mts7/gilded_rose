<?php

namespace GildedRose;

abstract class Item implements ItemInterface
{
    public string $name;
    public int $days_remaining;
    public int $quality;

    public function __construct(string $name, int $days_remaining, int $quality)
    {
        $this->name = $name;
        $this->days_remaining = $days_remaining;
        $this->quality = $quality;
    }

    final public function process(): void
    {
        $this->processBeforeDay();
        $this->updateDaysRemaining();
        $this->processAfterDay();
    }
}
