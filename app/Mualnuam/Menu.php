<?php namespace Mualnuam;
use Route;

class Menu
{
   public static function isCurrent($route)
   {
      if(is_array($route)) {
         foreach($route as $r) {
            if(Route::currentRouteName() == $r)
               return 'active';
         }

         return null;
      }
      else return Route::currentRouteName() == $route ? 'active' : '';
   }
}
