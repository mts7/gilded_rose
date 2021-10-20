<?php

namespace GildedRose;

class SulfurasItem extends Item
{
    public function __construct(int $days_remaining, int $quality)
    {
        parent::__construct('Sulfuras, Hand of Ragnaros', $days_remaining, $quality);
    }

    final public function processBeforeDay(): void
    {
        // no processing before the day is over
    }

    final public function updateDaysRemaining(): void
    {
        // the day never ends
    }

    final public function processAfterDay(): void
    {
        // no processing after the day is over
    }
}
