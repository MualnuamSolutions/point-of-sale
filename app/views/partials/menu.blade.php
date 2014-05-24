@if(Sentry::check())
<section class="top-bar-section">
   <ul class="right">
      <li class="divider"></li>
      <li><a href="{{ route('home') }}">Class</a></li>
      <li><a href="{{ route('home') }}">Student</a></li>
      <li><a href="{{ route('home') }}">Exam</a></li>
      <li class="has-dropdown">
         <a href="{{ route('home') }}">Class</a>
         <ul class="dropdown">
            <li><a href="#">Create New Class</a></li>
            <li><label>Student</label></li>
            <li><a href="#">View Students</a></li>
            <li><a href="#">Create New Student</a></li>
         </ul>
      </li>
      <li class="divider"></li>
      <li class="has-dropdown">
         <a href="{{ route('home') }}">Examination</a>
         <ul class="dropdown">
            <li><a href="#">Assessments</a></li>
            <li><a href="#">Results</a></li>
            <li><a href="#">Test</a></li>
         </ul>
      </li>
      <li class="divider"></li>
      <li><a href="{{ route('user.index') }}"><i class="fi-torsos"></i></a></li>
      <li class="divider"></li>
      <li><a href="#"><i class="fi-wrench"></i></a></li>
      <li class="alert"><a href="{{ route('user.logout') }}" title="Log Out"><i class="fi-power"></i></a></li>
   </ul>
</section>
@endif
