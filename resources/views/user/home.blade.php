<!DOCTYPE html>
<html>

<head>
   @include('user.css');
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
      @include('user.header')
 
  </div>
  <div style="max-width: 800px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #f9f9f9; font-family: Arial, sans-serif; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    <h2 style="color: #333;">Welcome to the HSTU Exam Scheduler</h2>
    <p style="font-size: 16px; color: #555; line-height: 1.6;">
        At Hajee Mohammad Danesh Science and Technology University (HSTU), we understand the importance of a well-organized and efficient exam schedule. Our <strong>Exam Scheduler</strong> is designed to simplify the process for both students and faculty, providing accurate and up-to-date exam timetables with just a few clicks.
    </p>
    <p style="font-size: 16px; color: #555; line-height: 1.6;">
        With this tool, you can:
        <ul style="text-align: left; margin: 0 auto; max-width: 600px; color: #333;">
            <li>View upcoming exam schedules based on your courses and departments.</li>
            <li>Generate optimized exam routines for specific semesters.</li>
            <li>Ensure there are no conflicts in exam timings.</li>
            <li>Stay informed with real-time updates and changes in the exam schedule.</li>
        </ul>
    </p>
    <p style="font-size: 16px; color: #555; line-height: 1.6;">
        Our goal is to make exam preparation less stressful by giving you easy access to your schedule, so you can focus on what matters most—your studies.
    </p>
</div>
 @include('user.footer')

  <!-- end info section -->


  <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>