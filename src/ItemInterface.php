<?php

namespace GildedRose;

interface ItemInterface
{
    function process():void;

    function processBeforeDay(): void;

    function updateDaysRemaining(): void;

    function processAfterDay(): void;
}
