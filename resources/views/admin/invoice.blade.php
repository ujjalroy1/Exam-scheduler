<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print routine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #fff;
        }
        h1 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #004080;
        }
        .section {
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #004080;
            color: #fff;
            font-size: 16px;
        }
        table td {
            font-size: 14px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info h1 {
            font-weight: normal;
            font-size: 16px;
            color: #555;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
                background-color: #fff;
            }
            h1, table, .info {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    
    <div  style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; font-family: Arial, sans-serif; text-align: center;">
        <img src="admincss/img/hstulogo.png" height="200px" width="200px" alt="HSTU Logo" style="display: block; margin: 0 auto;">
        <h4 style="margin: 0;">Hajee Mohammad Danesh Science and Technology University</h4>
        <br>
        <h1 style="margin-top: 20px;">Theoretical Exam Routine</h1>
        <hr style="margin-top: 20px; width: 50%; margin-left: auto; margin-right: auto;">
    </div>

    <div class="section">
        @foreach ($allcode as $a)
            @if ($a->unique_code != $id)
                @continue
            @endif

            <div class="info">
                @foreach ($allroutineinfo[$a->unique_code] as $val)
                    <h5>Faculty: {{ $val->faculty }}</h5>
                    <h5>Level-Semester: {{ $val->levsem }}</h5>
                    <h5>Time: {{ $val->time }}</h5>
                    <h5>Center: {{ $val->center }}</h5>
                @endforeach
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Day</th>
                        <th>Course Code</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allroutineresult[$a->unique_code] as $val)
                        <tr>
                            <td>{{ $val->date }}</td>
                            <td>{{ $val->day }}</td>
                            <td>{{ $val->course_code }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
    <br>
    <br>
    <br>
    <br>
    <div style="text-align: right; margin-right: 50px;">
        <h5 style="margin: 0; position: relative;">Exam Controller, HSTU Dinajpur</h5>
        <hr style="width: 200px; margin: 5px 0 0 auto; position: relative; top: -28px;">
    </div>

</body>
</html>