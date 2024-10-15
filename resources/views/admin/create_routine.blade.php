<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
            /* table
            {
                 border: solid 2px skyblue;
                 width: 100;
            }
            td
            {
                 border: solid 2px skyblue;
                 padding: 5px;
            }
            th
            {
                  border: 2px solid skyblue;
                  padding: 5px;
            } */


            * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
}

.form-container {
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background-color: #92d2f9;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 8px;
    font-weight: bold;
    color: #333;
}

.form-group input,
.form-group select {
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #007BFF;
    outline: none;
}

button {
    padding: 14px;
    background-color: #007BFF;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

/* Responsive Design */
@media (max-width: 600px) {
    .form-container {
        padding: 20px;
        margin: 20px;
    }

    button {
        font-size: 16px;
        padding: 12px;
    }
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
            
            {{-- <div>
                   <form> 
                    <input type="date" name="start_date">
                    <br>

                    <select name="level">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                           
                    </select>
                    <br>
                    <select name="semester">
                      <option value="I">I</option>
                      <option value="II">II</option>
                  
                  </select>
                  <br>
                  <input type="text" name="times"><br>
                  <input type="text" name="room"><br>



                   </form>
            </div> --}}


            <div class="form-container">
              <form action="{{ url('confirm_routine') }}" method="post">
                @csrf
                  <div class="form-group">
                      <label for="start_date">Start Date</label>
                      <input type="date" id="start_date" name="start_date">
                  </div>
          
                  <div class="form-group">
                      <label for="level">Level</label>
                      <select id="level" name="level">
                          <option value="" disabled selected>Select level</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                      </select>
                  </div>
          
                  <div class="form-group">
                      <label for="semester">Semester</label>
                      <select id="semester" name="semester">
                          <option value="" disabled selected>Select semester</option>
                          <option value="I">I</option>
                          <option value="II">II</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="dept">Department</label>
                    <select id="dept" name="dept">
                        <option value="" disabled selected>Select Department</option>
                        <option value="CSE">CSE</option>
                        <option value="EEE">EEE</option>
                        <option value="ECE">ECE</option>
                        <option value="FPE">FPE</option>
                    </select>
                </div>
          
                  <div class="form-group">
                      <label for="times">Times</label>
                      <input type="text" id="times" name="times" placeholder="e.g., 10:00 AM - 12:00 PM">
                  </div>
          
                  <div class="form-group">
                      <label for="room">Room</label>
                      <input type="text" id="room" name="room" placeholder="e.g., Room 101">
                  </div>
          
                  <input type="submit" value="confirm" class="btn btn-success">
              </form>
          </div>
          
               



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