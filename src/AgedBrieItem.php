<?php

namespace GildedRose;

class AgedBrieItem extends Item
{
    public function __construct(int $days_remaining, int $quality)
    {
        parent::__construct('Aged Brie', $days_remaining, $quality);
    }

    final public function processBeforeDay(): void
    {
        if ($this->quality < 50) {
            ++$this->quality;
        }
    }

    final public function updateDaysRemaining(): void
    {
        --$this->days_remaining;
    }

    final public function processAfterDay(): void
    {
        if (($this->days_remaining < 0) && $this->quality < 50) {
            ++$this->quality;
        }
   }
}
