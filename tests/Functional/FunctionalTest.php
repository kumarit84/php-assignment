<?php

declare(strict_types = 1);

namespace Tests\Functional;

use PHPUnit\Framework\TestCase;
use Statistics\test\StatisticsUtility;


/**
 * Class FunctionalTest
 *
 * @package Tests\Functional
 */
class FunctionalTest extends TestCase
{

    protected $statisticsUtility;

    protected function setUp(): void {
       parent::setUp();
       $this->statisticsUtility = new StatisticsUtility();
    }
    

    /**
    * Test to check the statistics info page working.
    */
    public function testApicall(): void
    {
        $monthArray = array('August,%202021','September,%202021','July,%202021','June,%202021','April,%202021');
        $data = file_get_contents($_SERVER['HTTP_HOST'].'/statistics?month='.$monthArray[array_rand($monthArray, 1)]);
        $status_line = $http_response_header[0];
        preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
        $status = $match[1];
        $this->assertEquals('200', $status);
    }
    
    /**
    * Test to register token using get method so this method will fail.
    */
    public function testRegisterTokenGet(): void
    {
        $tokenInfo =file_get_contents($_ENV['FICTIONAL_SOCIAL_API_HOST'].'/assignment/register?client_id='.$_ENV['FICTIONAL_SOCIAL_API_CLIENT_ID'].'&email=my@name.com&name=My%20Name');
        $status_line = $http_response_header[0];
        preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
        $status = $match[1];
        $this->assertEquals('200', $status);
    }
    
    /**
    * Test to register token using post method in plain php curl.
    */
    public function testRegisterTokenPost(): void
    {
        $reponsecode = $this->statisticsUtility->HTTPPost($_ENV['FICTIONAL_SOCIAL_API_HOST'].'/assignment/register',array('client_id'=>$_ENV['FICTIONAL_SOCIAL_API_CLIENT_ID'],'email'=>'your@email.address','name'=>'YourName'));
        $this->assertEquals('200', $reponsecode);
    }

    /**
    * Test to register token using post method using the Guzzle functionlity as same as code.
    */
    public function testRegisterTokenGuzzle(): void
    {
        $reponsecode = $this->statisticsUtility->GuzzlePost();
        $this->assertTrue($reponsecode);
    }
}
