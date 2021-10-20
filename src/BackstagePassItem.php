<?php

namespace GildedRose;

class BackstagePassItem extends Item
{
    public function __construct(int $days_remaining, int $quality)
    {
        parent::__construct('Backstage passes to a TAFKAL80ETC concert', $days_remaining, $quality);
    }

    final public function processBeforeDay(): void
    {
        if ($this->quality < 50) {
            ++$this->quality;
            // check the quality after each potential update to quality
            if ($this->days_remaining < 11 && $this->quality < 50) {
                ++$this->quality;
            }
            if ($this->days_remaining < 6 && $this->quality < 50) {
                ++$this->quality;
            }
        }
    }

    final public function updateDaysRemaining(): void
    {
        --$this->days_remaining;
    }

    final public function processAfterDay(): void
    {
        if ($this->days_remaining < 0) {
            $this->quality = 0;
        }
    }
}
