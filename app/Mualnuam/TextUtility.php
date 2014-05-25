<?php namespace Mualnuam;

class TextUtility
{
   public static function highlightString($string, $originalString)
   {
      if(is_null($string))
         return $originalString;

      if(!is_null($string) && is_null($originalString))
         return preg_replace('/('.$string.')/i', '<span class="highlight">$1</span>', $string)

      return preg_replace('/('.$string.')/i', '<span class="highlight">$1</span>', $originalString);
   }
}
