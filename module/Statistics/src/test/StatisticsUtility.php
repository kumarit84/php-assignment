<?php

namespace Statistics\test;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7\Request;


/**
 * Class StatisticsUtility
 *
 * @package Statistics\test
 */
class StatisticsUtility{

  /**
   * Return true if color is available in array
   */
  public function checkColor($color=null) {
    $colorsArray = array('red','yellow','blue','black','green');
    if(in_array($color,$colorsArray)){
      return true;
    }
    return false;
  }

  /**
   * Return true if given email id valid
   */
  public function checkValidMail($mail=null) {
    if(filter_var($mail, FILTER_VALIDATE_EMAIL) == true){
      return true;
    }
    return false;
  }

  /**
   * Return status code on requesting token
   */
  public function HTTPPost($url, array $params) {
    $query = http_build_query($params);
    $ch    = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $httpcode;
  }

  /**
   * Return true if token request is success
   */
  public function GuzzlePost() {
    $headers = ['Content-Type' => 'application/json'];
    $body = [
        'email' => 'your@email.address',
        'name'  => 'YourName',
    ];      
   
    $body['client_id'] = $_ENV['FICTIONAL_SOCIAL_API_CLIENT_ID'];

    $APIURL= $_ENV['FICTIONAL_SOCIAL_API_HOST'];
 
    $body = empty($body) ? null : json_encode($body);
    $request = new Request('POST',$APIURL.'/assignment/register', $headers, $body);
    $res = new \GuzzleHttp\Client();
    $response = $res->send($request);
    $contents = $response->getBody()->getContents();
    $response = \GuzzleHttp\json_decode($contents, true);
    $token = $response['data']['sl_token'];
    if($token){
      return true;
    }
    return false;
  }



}
