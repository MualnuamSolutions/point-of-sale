<?php namespace Mualnuam;

class TextUtility
{
   public static function highlightString($str, $originalString)
   {
      if(is_null($str))
         return $originalString;

      return preg_replace('/('.$str.')/i', '<span class="highlight">$1</span>', $originalString);
   }
}
