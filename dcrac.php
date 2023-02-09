#!/usr/bin/php
<?php
$red = "\e[1;31m";
$green = "\e[1;32m";
$yellow = "\e[1;33m";
$blue = "\e[1;34m";
$reset = "\e[0m";
function drawBanner(){
  global $blue, $yellow, $reset;
  echo $blue;
  $EOF = "
            ┏━┓╻ ╻┏━┓┏━┓╻ ╻┏━┓┏━┓╺┳┓   ╺┳╸┏━┓┏━┓╻╺━┓
            ┗━┓┣━┫╺━┫┣━┛┣━┫╺━┫┣┳┛ ┃┃    ┃ ┃┃┃┃┃┃╹┏━┛
            ┗━┛╹ ╹┗━┛╹  ╹ ╹┗━┛╹┗╸╺┻┛    ╹ ┗━┛┗━┛╹┗━╸\n";
  echo $EOF;
  echo $yellow;
  $app = "
                ┏┳┓╺┳┓┏━╸   ┏━╸┏━┓╻ ╻┏━╸╻┏ ┏━┓┏━┓
                ┃┃┃ ┃┃┗━┓   ┃  ┣┳┛┗━┫┃  ┣┻┓╺━┫┣┳┛
                ╹ ╹╺┻┛┗━┛   ┗━╸╹┗╸  ╹┗━╸╹ ╹┗━┛╹┗╸\n\n";
  echo $app;
  echo $reset;
}
function crackmd5($wordlist, $hash) {
  global $red, $green;
  $wdf = fopen($wordlist, "r");
  do{
   $xkey = fgets($wdf);
   $key = str_replace(PHP_EOL, '', $xkey);
    if (md5($key) != $hash) {
      $xkey = md5($key);
      echo $red."[INVALID] $hash => $key\n";
    }else {
      echo $green."[VALID] $hash => $key\n\n";
      $file = fopen("cracked_hash.txt", 'a');
      fwrite($file, "$hash => $key");
      fclose($file);
      break;
    }
  }while(!feof($wdf));
}
drawBanner();
$inphash = (string) readline( "[?] Enter MD5 hash: ");
$inpwrd = (string) readline( "[?] Enter wordlist file: ");
$hash = str_replace(PHP_EOL, "", $inphash);
$wrd = str_replace(PHP_EOL, "", $inpwrd);

crackmd5($wrd, $hash);
// 581ada71a4c64fcba4982223318e65ce => dilara321
?>