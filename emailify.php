<?php

if(!function_exists('emailify')){

  function emailify($email, $char = '*', $delim = '@') {
      if ( ! filter_var($email, FILTER_VALIDATE_EMAIL) ){
          return null;
      }

      $emailArray = explode($delim, $email);
      $emailWithoutDomain = $emailArray[0];

      if (strlen($emailWithoutDomain) <= 3 && strlen($emailWithoutDomain) > 0) {
          $start = 1;
          $last = 0;
      }else if(strlen($emailWithoutDomain) >= 4){
          $start = 2;
          $last = 1;
      }else{
          return null;
      }

      $sanitized = str_replace(
          substr($emailWithoutDomain, $start, strlen($emailWithoutDomain) - $last - $start),
          str_repeat($char, strlen($emailWithoutDomain) - $last - $start),
          $emailWithoutDomain
      );

      $emailArray[0] = $sanitized;

      return implode($delim, $emailArray);
  }

}

$input_email = $argv[1]; // email
if(isset($argv[2])) $char = $argv[2];
if(isset($argv[3])) $delim = $argv[3];

echo emailify($input_email);
echo "\n";
