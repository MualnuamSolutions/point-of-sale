<!DOCTYPE html>
<html>
<head>
   <title>Student Result Management</title>
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/foundation/css/normalize.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/bower_components/foundation/css/foundation.min.css') }}">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/stylesheets/app.css') }}">
   @yield('styles')
</head>
<body>
   <div class="off-canvas-wrap" data-offcanvas>
      <div class="inner-wrap">
         <div class="fixed">
            <nav class="tab-bar">
               <section class="left-small">
                  <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
               </section>

               <section class="middle tab-bar-section">
                  <h1 class="title">Result Management</h1>
               </section>

               <ul class="right">
                  <li><a href="#">Left Nav Button</a></li>
               </ul>
            </nav>
         </div>

         <aside class="left-off-canvas-menu">
            <ul class="off-canvas-list">
               <li><label>Foundation</label></li>
               <li><a href="#">The Psychohistorians</a></li>
               <li><a href="#">...</a></li>
            </ul>
         </aside>
