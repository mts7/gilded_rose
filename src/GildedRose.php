<?php

namespace GildedRose;

class GildedRose
{
    final public function processEndOfDay(array $items): void
    {
        array_map(
            static function ($item) {
                $item->process();
            }, $items);
    }
}
