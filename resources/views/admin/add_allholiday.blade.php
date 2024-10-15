<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>

      .form-container {
          background-color: #fff;
          padding: 20px;
          border-radius: 10px;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          max-width: 400px;
          width: 100%;
          
      }
      .form-container h1 {
          font-size: 1.5em;
          margin-bottom: 20px;
          color: #333;
      }
      .form-container form {
          display: flex;
          flex-direction: column;
      }
      .form-container input[type="date"] {
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
          margin-bottom: 15px;
          font-size: 1em;
      }
      .form-container input[type="submit"] {
          padding: 10px;
          border: none;
          border-radius: 5px;
          background-color: #28a745;
          color: #fff;
          font-size: 1em;
          cursor: not-allowed;
          opacity: 0.6;
      }
      .form-container input[type="checkbox"] {
          margin-right: 10px;
      }
      .form-container label {
          margin-bottom: 15px;
          font-size: 0.9em;
          color: #666;
      }
  </style>
  </head>
  <body>
    @include('admin.header')
    @include('admin.sidebar')
    
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <div class="form-container">
              <h1>No need to add a new holiday date if it is already added</h1>
              <form action="{{ url('store_all_holiday') }}" method="POST">
                  @csrf
                  <input type="date" name="holi_date" required>
                  <label>
                      <input type="checkbox" id="confirmCheckbox"> Are you sure that this day is not added
                  </label>
                  <input type="submit" value="ADD" id="submitButton" disabled>
              </form>
          </div>
      
          <script>
              const checkbox = document.getElementById('confirmCheckbox');
              const submitButton = document.getElementById('submitButton');
      
              checkbox.addEventListener('change', function() {
                  if (checkbox.checked) {
                      submitButton.disabled = false;
                      submitButton.style.cursor = 'pointer';
                      submitButton.style.opacity = '1';
                  } else {
                      submitButton.disabled = true;
                      submitButton.style.cursor = 'not-allowed';
                      submitButton.style.opacity = '0.6';
                  }
              });
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