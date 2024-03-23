<?php

function stripContent($string)
{
  // ----- remove HTML TAGs -----
  $string = preg_replace('/<[^>]*>/', ' ', $string);
  // ----- remove control characters -----
  $string = str_replace("\r", '', $string);
  $string = str_replace("\n", ' ', $string);
  $string = str_replace("\t", ' ', $string);
  // ----- remove multiple spaces -----
  $string = trim(preg_replace('/ {2,}/', ' ', $string));
  return $string;

}