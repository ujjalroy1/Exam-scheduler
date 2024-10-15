<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style>
  .container {
            background-color: #a1e2fe;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
        }

        h1 {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        select, input[type="date"], input[type="submit"] {
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
        }

        select:focus, input[type="date"]:focus {
            outline: none;
            border-color: #007BFF;
        }

        input[type="submit"] {
            background-color: tomato; /* Initial color */
            color: #fff;
            border: none;
            cursor: not-allowed;
            transition: background-color 0.3s ease, color 0.3s ease, left 0.3s ease, top 0.3s ease;
            position: relative; /* Initially positioned relative to the form */
            left: 0;
            top: 0;
            transform: translateX(0);
        }

        input[type="submit"]:enabled {
            background-color: #007BFF;
            cursor: pointer;
            transform: translateX(0);
        }

        input[type="submit"]:hover:enabled {
            background-color: #0056b3;
        }

        @media (max-width: 500px) {
            .container {
                padding: 1.5rem;
            }

            h1 {
                font-size: 1.5rem;
            }

            select, input[type="date"], input[type="submit"] {
                padding: 0.6rem;
                font-size: 0.9rem;
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
              
            <div class="container">
                <h1>Manage Your Special Date</h1>
                <form action="{{ url('add_special_date') }}" method="post">
                    @csrf
                    <select name="type">
                        <option value="on">On Day</option>
                        <option value="off">Off Day</option>
                    </select>
                    <input type="date" name="special_date" id="special_date">
                    <input type="submit" value="Add" id="submitBtn" disabled>
                </form>
            </div>
        
            <script>
                const dateInput = document.getElementById('special_date');
                const submitBtn = document.getElementById('submitBtn');
        
                let moving = false;
        
                function moveButton() {
                    if (!dateInput.value && !moving) {
                        moving = true;
                        const randomX = Math.random() * (window.innerWidth - submitBtn.offsetWidth);
                        const randomY = Math.random() * (window.innerHeight - submitBtn.offsetHeight);
        
                        submitBtn.style.position = 'absolute';
                        submitBtn.style.left = `${randomX}px`;
                        submitBtn.style.top = `${randomY}px`;
                        moving = false;
                    }
                }
        
                submitBtn.addEventListener('mouseover', function() {
                    if (!dateInput.value) {
                        moveButton();
                    }
                });
        
                dateInput.addEventListener('input', function() {
                    if (dateInput.value) {
                        submitBtn.disabled = false;
                        submitBtn.style.backgroundColor = '#007BFF'; // Normal button color
                        submitBtn.style.cursor = 'pointer';
                        submitBtn.style.position = 'relative';
                        submitBtn.style.left = '0';
                        submitBtn.style.top = '0';
                        submitBtn.style.transform = 'translateX(0)';
                    } else {
                        submitBtn.disabled = true;
                        submitBtn.style.backgroundColor = 'tomato'; // Tomato color when no date
                        submitBtn.style.cursor = 'not-allowed';
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