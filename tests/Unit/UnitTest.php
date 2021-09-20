<?php

declare(strict_types = 1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Statistics\test\StatisticsUtility;
use GuzzleHttp\Client;


/**
 * Class UnitTest
 *
 * @package Tests\Unit
 */
class UnitTest extends TestCase
{


    protected $statisticsUtility;
  

    protected function setUp(): void {
       parent::setUp();
       $this->statisticsUtility = new StatisticsUtility();
    }

    /**
     * Simpletest to check passed value is true
     */
    public function testNothing(): void
    {
       $condition = true;
       $this->assertTrue($condition);
    }

    /**
     * Simpletest to check passed value is there in array
     */
    public function testColor(): void
    {
       $color = 'red';
       $this->assertEquals(true,$this->statisticsUtility->checkColor($color));
    }

    /**
     * Simpletest to check valid email
     */
    public function testMail(): void
    {
       $mail = 'kumar.test@gmail.com';
       $this->assertEquals(true,$this->statisticsUtility->checkValidMail($mail));
    }

}
