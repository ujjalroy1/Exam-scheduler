<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <style>
              /* Style the unordered list container */
              .styled-list {
                  list-style-type: none; /* Remove bullet points */
                  padding: 0;
                  margin: 0;
              }
          
              /* Style each list item */
              .styled-list li {
                  background-color: #f0f8ff; /* Light blue background */
                  border: 1px solid #ddd;     /* Light border */
                  border-radius: 8px;         /* Rounded corners */
                  padding: 12px;              /* Padding for spacing */
                  margin-bottom: 10px;        /* Space between list items */
                  font-family: 'Arial', sans-serif; /* Font style */
                  font-size: 16px;            /* Font size */
                  color: #333;                /* Dark text color */
                  transition: background-color 0.3s ease; /* Smooth hover transition */
              }
          
              /* Add hover effect */
              .styled-list li:hover {
                  background-color: #e6f7ff; /* Slightly darker blue on hover */
                  cursor: pointer;           /* Pointer cursor on hover */
              }
          
              /* Optional: Add box-shadow for a 3D effect */
              .styled-list li {
                  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Slight shadow for depth */
              }
          </style>
          


            <ul class="styled-list">
              @foreach ($teacher_name as $d)
              <li>
                  {{ $d }}
              </li>
              @endforeach
          </ul>
          




            
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
  </body>
</html>