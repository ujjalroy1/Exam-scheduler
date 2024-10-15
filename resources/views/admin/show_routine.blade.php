<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            
           <div class="container my-4">
            @foreach ($allcode as $a)
            <div class="card mb-4 shadow-sm">
              <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h2 class="h4">Code: {{ $a->unique_code }}</h2>
                <button class="btn btn-light btn-sm" onclick="copyToClipboard('{{ $a->unique_code }}')">Copy Code</button>
              </div>
              <div class="card-body">
                @foreach ($allroutineinfo[$a->unique_code] as $val)
                <div class="row">
                  <div class="col-md-6">
                    <h5>Faculty: {{ $val->faculty }}</h5>
                  </div>
                  <div class="col-md-6">
                    <h5>Level-Semester: {{ $val->levsem }}</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <h5>Time: {{ $val->time }}</h5>
                  </div>
                  <div class="col-md-6">
                    <h5>Center: {{ $val->center }}</h5>
                  </div>
                  <div class="col-md-6">
                    <h5>Routine generated time: {{ $val->created_at }}</h5>
                  </div>
                </div>
                @endforeach
          
                <div class="table-responsive mt-3">
                  <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                      <tr>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Course Code</th>
                        <th>Assigned Teacher</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($allroutineresult[$a->unique_code] as $val)
                      <tr>
                        <td>{{ $val->date }}</td>
                        <td>{{ $val->day }}</td>
                        <td>{{ $val->course_code }}</td>
                        <td>
                          <a href="{{ url('assignedTeacher',$a->unique_code) }}" class="btn btn-info btn-sm">Show</a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
          
                <div class="text-end mt-3">
                  <a href="{{ url('print_routine',$a->unique_code) }}" class="btn btn-success">Print</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          
          <script>
            // Function to copy text to the clipboard
            function copyToClipboard(text) {
              navigator.clipboard.writeText(text).then(function() {
                alert('Code copied to clipboard: ' + text);
              }, function(err) {
                alert('Failed to copy text: ' + err);
              });
            }
          </script>






           



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