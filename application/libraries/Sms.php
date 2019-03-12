<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * This is Main Controller .. All controller extended from this class
 * @author	Hamid Pourhashemi
 */
class Sms {
  function send($mobile,$vcode,$text1,$text2){
                $username="hamidpoor";
                $passw="hamid2552";
                $text1=$this->replaceTextForSms($text1);
                $text2=$this->replaceTextForSms($text2);
                $urlsms="http://smspanel.Trez.ir/SendMessageWithCode.ashx?Username=".$username."&Password=".$passw."&Mobile=".$mobile."&Message=Mehr.Academy+".$text1.$vcode."+".$text2;
                  // $xml = file_get_contents($urlsms);
                $curl_handle=curl_init();
                curl_setopt($curl_handle, CURLOPT_URL,$urlsms);
                curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl_handle, CURLOPT_USERAGENT, 'mehr.academy');
                $query = curl_exec($curl_handle);
                curl_close($curl_handle);
                return $query;
  }
  public function replaceTextForSms($text){
    $text = str_replace(' ', '%20', $text);
    $text = str_replace('+', '%2B', $text);

    return $text;
  }
}
