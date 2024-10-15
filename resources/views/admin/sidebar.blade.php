<div class="d-flex align-items-stretch">
    <!-- Sidebar Navigation-->
    <nav id="sidebar">
      <!-- Sidebar Header-->
      <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ asset('admincss/img/ujjal roy.jpg') }}" alt="..." class="img-fluid rounded-circle"></div>
        <div class="title">
          <h1 class="h5">Ujjal Roy</h1>
          <p>Admin</p>
        </div>
      </div>
      <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
      <ul class="list-unstyled">
              <li class="active"><a href="{{ url('admin') }}"> <i class="icon-home"></i>Home </a></li>
              <li><a href="{{ url('clear_data') }}"> <i class="icon-settings-1"></i>Clear Previous data</a></li>
              <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Generate Routine </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                  <li><a href="{{ url('create_routine') }}"> <i></i>Create</a></li>
                  <li><a href="{{ url('manage_special_day') }}">Manage Special Date</a></li>
                  
                </ul>
              </li>
              <li class="active">
              <a href="{{ url('show_routine') }}"> 
              <i class="icon-home"> </i>Show Routines
            </a>
              </li>
              <li class="active">
                <a href="{{ url('add_allholiday') }}"> <i class="icon-list"></i>Add yearly holiday
              </a>
            </li>
            <li class="active">
              <a href="{{ url('message') }}"> <i class="icon-list"></i>Message
            </a>
          </li>
   
      </ul>
    </nav>