<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>{{ Config::get('app.sitetitle') }} : Login</title>

   @include('assets.styles')
</head>
<body>
   @include('partials.topbar')

   <div class="container">
      <div class="row row-offcanvas row-offcanvas-right">
         <div class="col-xs-12">
            @include('partials.alert')

            @yield('content')
         </div>

         @include('partials.menu', ['position' => 'sidebar'])
      </div>
   </div>

   @include('assets.scripts')
</body>
</html>
