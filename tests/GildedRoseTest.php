<?php

namespace Tests;

use GildedRose\AgedBrieItem;
use GildedRose\BackstagePassItem;
use GildedRose\ConjuredManaCakeItem;
use GildedRose\DefaultItem;
use GildedRose\GildedRose;
use GildedRose\SulfurasItem;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testNormalItem_BeforeSellDate(): void
    {
        $items = [new DefaultItem('foo', 5, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(4, $items[0]->days_remaining);
        $this->assertSame(9, $items[0]->quality);
    }

    public function testNormalItem_WithMinQuality(): void
    {
        $items = [new DefaultItem('foo', 5, 0)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(4, $items[0]->days_remaining);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testNormalItem_OnSellDate(): void
    {
        $items = [new DefaultItem('foo', 0, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-1, $items[0]->days_remaining);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testNormalItem_OnSellDateWithMinQuality(): void
    {
        $items = [new DefaultItem('foo', 0, 0)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-1, $items[0]->days_remaining);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testNormalItem_OnSellDateNearMinQuality(): void
    {
        $items = [new DefaultItem('foo', 0, 1)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-1, $items[0]->days_remaining);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testNormalItem_AfterSellDate(): void
    {
        $items = [new DefaultItem('foo', -10, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-11, $items[0]->days_remaining);
        $this->assertSame(8, $items[0]->quality);
    }

    public function testNormalItem_AfterSellDateWithMinQuality(): void
    {
        $items = [new DefaultItem('foo', -10, 0)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-11, $items[0]->days_remaining);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testNormalItem_AfterSellDateNearMinQuality(): void
    {
        $items = [new DefaultItem('foo', -10, 1)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-11, $items[0]->days_remaining);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testAgedBrie_BeforeSellDate(): void
    {
        $items = [new AgedBrieItem(5, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(4, $items[0]->days_remaining);
        $this->assertSame(11, $items[0]->quality);
    }

    public function testAgedBrie_WithMaxQuality(): void
    {
        $items = [new AgedBrieItem(5, 50)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(4, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testAgedBrie_OnSellDate(): void
    {
        $items = [new AgedBrieItem(0, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-1, $items[0]->days_remaining);
        $this->assertSame(12, $items[0]->quality);
    }

    public function testAgedBrie_OnSellDateWithMaxQuality(): void
    {
        $items = [new AgedBrieItem(0, 50)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-1, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testAgedBrie_OnSellDateNearMaxQuality(): void
    {
        $items = [new AgedBrieItem(0, 49)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-1, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testAgedBrie_AfterSellDate(): void
    {
        $items = [new AgedBrieItem(-10, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-11, $items[0]->days_remaining);
        $this->assertSame(12, $items[0]->quality);
    }

    public function testAgedBrie_AfterSellDateWithMaxQuality(): void
    {
        $items = [new AgedBrieItem(-10, 50)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-11, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testAgedBrie_AfterSellDateNearMaxQuality(): void
    {
        $items = [new AgedBrieItem(-10, 49)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-11, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testSulfuras_BeforeSellDate(): void
    {
        $items = [new SulfurasItem(5, 80)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(5, $items[0]->days_remaining);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testSulfuras_OnSellDate(): void
    {
        $items = [new SulfurasItem(0, 80)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(0, $items[0]->days_remaining);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testSulfuras_AfterSellDate(): void
    {
        $items = [new SulfurasItem(-10, 80)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-10, $items[0]->days_remaining);
        $this->assertSame(80, $items[0]->quality);
    }

    public function testBackstagePass_LongBeforeSellDate(): void
    {
        $items = [new BackstagePassItem(11, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(10, $items[0]->days_remaining);
        $this->assertSame(11, $items[0]->quality);
    }

    public function testBackstagePass_LongBeforeSellDateAtMaxQuality(): void
    {
        $items = [new BackstagePassItem(11, 50)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(10, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_MediumCloseToSellDateUpperBound(): void
    {
        $items = [new BackstagePassItem(10, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(9, $items[0]->days_remaining);
        $this->assertSame(12, $items[0]->quality);
    }

    public function testBackstagePass_MediumCloseToSellDateUpperBoundAtMaxQuality(): void
    {
        $items = [new BackstagePassItem(10, 50)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(9, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_MediumCloseToSellDateUpperBoundNearMaxQuality(): void
    {
        $items = [new BackstagePassItem(10, 49)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(9, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_MediumCloseToSellDateLowerBound(): void
    {
        $items = [new BackstagePassItem(6, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(5, $items[0]->days_remaining);
        $this->assertSame(12, $items[0]->quality);
    }

    public function testBackstagePass_MediumCloseToSellDateLowerBoundAtMaxQuality(): void
    {
        $items = [new BackstagePassItem(6, 50)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(5, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_MediumCloseToSellDateLowerBoundNearMaxQuality(): void
    {
        $items = [new BackstagePassItem(6, 49)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(5, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_VeryCloseToSellDateUpperBound(): void
    {
        $items = [new BackstagePassItem(5, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(4, $items[0]->days_remaining);
        $this->assertSame(13, $items[0]->quality);
    }

    public function testBackstagePass_VeryCloseToSellDateUpperBoundAtMaxQuality(): void
    {
        $items = [new BackstagePassItem(5, 50)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(4, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_VeryCloseToSellDateUpperBoundNearMaxQuality(): void
    {
        $items = [new BackstagePassItem(5, 48)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(4, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_VeryCloseToSellDateLowerBound(): void
    {
        $items = [new BackstagePassItem(1, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(0, $items[0]->days_remaining);
        $this->assertSame(13, $items[0]->quality);
    }

    public function testBackstagePass_VeryCloseToSellDateLowerBoundAtMaxQuality(): void
    {
        $items = [new BackstagePassItem(1, 50)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(0, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_VeryCloseToSellDateLowerBoundNearMaxQuality(): void
    {
        $items = [new BackstagePassItem(1, 48)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(0, $items[0]->days_remaining);
        $this->assertSame(50, $items[0]->quality);
    }

    public function testBackstagePass_OnSellDate(): void
    {
        $items = [new BackstagePassItem(0, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-1, $items[0]->days_remaining);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testBackstagePass_AfterSellDate(): void
    {
        $items = [new BackstagePassItem(-10, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(-11, $items[0]->days_remaining);
        $this->assertSame(0, $items[0]->quality);
    }

    public function testConjuredManaCake_Quality(): void
    {
        $items = [new ConjuredManaCakeItem(10, 10)];
        $gildedRose = new GildedRose();

        $gildedRose->processEndOfDay($items);

        $this->assertSame(9, $items[0]->days_remaining);
        $this->assertSame(8, $items[0]->quality);
    }
}
