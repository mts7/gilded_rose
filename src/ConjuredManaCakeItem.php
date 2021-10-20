<?php

namespace GildedRose;

class ConjuredManaCakeItem extends Item
{
    public function __construct(int $days_remaining, int $quality)
    {
        parent::__construct('Conjured Mana Cake', $days_remaining, $quality);
    }

    final public function processBeforeDay(): void
    {
        if ($this->days_remaining < 0) {
            $this->quality -= 4;
        } else {
            $this->quality -= 2;
        }
    }

    final public function updateDaysRemaining(): void
    {
        --$this->days_remaining;
    }

    final public function processAfterDay(): void
    {
        if ($this->quality < 0) {
            $this->quality = 0;
        }
    }
}
