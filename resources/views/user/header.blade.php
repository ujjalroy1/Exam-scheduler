<header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container ">
      <a class="navbar-brand" href="{{ url('/') }}">
        <span>
         Exam Scheduler
        </span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav  ">

          <li class="nav-item active">
            <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="shop.html">
              Shop
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="why.html">
              Why Us
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="testimonial.html">
              Testimonial
            </a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ url('contack_us') }}">Chat</a>
          </li>
        </ul>
        <div class="user_option">

          @if(Route::has('login'))
          @auth

          <form action="{{ url('student_req') }}" method="post">
            @csrf
               <input type="search" name="search">
               <input type="submit" name="submit" class="btn btn-secondary" value="search">
          </form>
        
       

          <form action="{{ route('logout') }}" method="post" style="padding: 10px">
            @csrf
               <input type="submit" value="logout" class="btn btn-success">
          </form>
     
         
            <a class="nav-link" href="{{ url('/') }}"><span class="sr-only">(current)</span></a>
         
          @else

          <a href="{{ url('login') }}">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>
              Login
            </span>
          </a>
          <a href="{{ url('register') }}">
            <i class="fa fa-vcard" aria-hidden="true"></i>
            <span>
              register
            </span>
          </a>


          @endauth
          @endif



        </div>
      </div>
    </nav>
  </header>