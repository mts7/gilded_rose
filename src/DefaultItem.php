<?php

namespace GildedRose;

class DefaultItem extends Item
{
    final public function processBeforeDay(): void
    {
        if ($this->quality > 0) {
            --$this->quality;
        }
    }

    final public function updateDaysRemaining(): void
    {
        --$this->days_remaining;
    }

    final public function processAfterDay(): void
    {
        if ($this->days_remaining < 0 && $this->quality > 0) {
            --$this->quality;
        }
    }
}
