<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\allHoliDay;
use App\Models\assignedTeacher;
use App\Models\CourseDetail;
use App\Models\finduserid;
use App\Models\resultRoutine;
use App\Models\routineInfo;
use App\Models\specialDate;
use App\Models\teacher;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    //


    public function index()
    {
         return view('admin.index');
    }
    public function create_routine()
    {
         return view('admin.create_routine');
    }
    public function confirm_routine(Request $request)
    {

      
     



     //taking course details
      $data=CourseDetail::where('level',$request->level)->where('semester',$request->semester)->where('dept',$request->dept)->get();
      $data1=allHoliDay::all();
      $data2=specialDate::where('type','on')->get();
      $data3=specialDate::where('type','off')->get();
      
      $credit = [];
      $fredate = [];
      $datestring = "";
      $posoffreeday = 0;
      $totalsub = 0;
      $dp = [];
      $initialdateposition = 0;
      $datelength=30;
      $allholidayarray=[];
      $ondayarray=[];
      $offdayarray=[];
      $coursecode=[];
      $ansdate = [];
      $ansday = [];
      $anscourse = [];
       foreach($data as $d)
       {
           
           $credit[$totalsub]=intval($d->credit);
           $coursecode[$totalsub]=$d->course_code;
           $totalsub++;
       }
     
      //map all holiday
      foreach($data1 as $d)
      {
       
         $allholidayarray[$d->holi_date]=1;
      }
      foreach($data2 as $d)
      {
        
         $ondayarray[$d->special_date]=1;
      }
      foreach($data3 as $d)
      {
         
         $offdayarray[$d->special_date]=1;
      }

      function generateDates($startDate, $endDate)
      {
          $start = Carbon::parse($startDate);
          $end = Carbon::parse($endDate);
  
          $dates = [];
  
          while ($start->lte($end)) {
              $dates[] = $start->format('Y-m-d');
              $start->addDay();
          }
  
          return $dates;
      }

      function ok($i, $j, $totalsub, &$dp, $datestring, $fredate, $posoffreeday, $credit)
      {
          if ($j == (1 << $totalsub) - 1) {
              return 0;
          } elseif ($i == strlen($datestring)) {
              return 200;
          } 

          elseif ($dp[$i][$j] != -1) {
              return $dp[$i][$j];
          } else {
              $ans = 200;
              $rr = ok($i + 1, $j, $totalsub, $dp, $datestring, $fredate, $posoffreeday, $credit);
              if ($j > 0) {
                  $rr += 1;
              }
              if ($rr <= $ans) {
                  $ans = $rr;
              }
              for ($l = 0; $l < $totalsub; $l++) {
                  if (((1 << $l) & $j) != 0) {
                      continue;
                  }
                  $a = 0;
                  if ($j > 0) {
                      $a = $credit[$l];
                  }
                  $peyeci = -1;
                  for ($x = 0; $x < $posoffreeday; $x++) {
                      if ($fredate[$x] >= $i + $a) {
                          $peyeci = $fredate[$x];
                          break;
                      }
                  }
                  if ($peyeci == -1) {
                      continue;
                  }
                  $r = $peyeci;
                  $ans = min($ans, $r - $i + ok($r + 1, $j | (1 << $l), $totalsub, $dp, $datestring, $fredate, $posoffreeday, $credit));
              }
              return $dp[$i][$j] = $ans;
          }
      }


       
    function cal($i, $j, $sum, &$ansdate, &$ansday, &$anscourse, $initialdateposition, $alldate, $coursecode, $totalsub, &$dp, $datestring, $fredate, $posoffreeday, $credit, $ck)
    {
        if ($j == (1 << $totalsub) - 1) {
            return;
        } else {
            $rrr = 0;
            if ($j > 0) $rrr = 1;
            if (ok($i + 1, $j, $totalsub, $dp, $datestring, $fredate, $posoffreeday, $credit) + $rrr + $sum == $ck) {
                cal($i + 1, $j, $sum + $rrr, $ansdate, $ansday, $anscourse, $initialdateposition, $alldate, $coursecode, $totalsub, $dp, $datestring, $fredate, $posoffreeday, $credit, $ck);
                return;
            }
            for ($l = 0; $l < $totalsub; $l++) {
                if (((1 << $l) & $j) != 0) {
                    continue;
                }
                $a = 0;
                if ($j > 0) {
                    $a = $credit[$l];
                }
                $peyeci = -1;
                for ($x = 0; $x < $posoffreeday; $x++) {
                    if ($fredate[$x] >= $i + $a) {
                        $peyeci = $fredate[$x];
                        break;
                    }
                }
                if ($peyeci == -1) {
                    continue;
                }
                $r = $peyeci;
                if (ok($r + 1, $j | (1 << $l), $totalsub, $dp, $datestring, $fredate, $posoffreeday, $credit) + $r - $i + $sum == $ck) {
                    $ansdate[] = $alldate[$r+$initialdateposition];
                    $ansday[] = Carbon::parse($alldate[$r])->dayName;
                    $anscourse[] = $coursecode[$l];
                   
                    cal($r + 1, $j | (1 << $l), $sum + $r - $i, $ansdate, $ansday, $anscourse, $initialdateposition, $alldate, $coursecode, $totalsub, $dp, $datestring, $fredate, $posoffreeday, $credit, $ck);
                    break;
                }
            }
        }
    }








     $initialdate=$request->start_date;
     $alldate=generateDates("2024-01-01", "2027-12-30");
     for($i=0;$i<count($alldate);$i++)
     {
          if($initialdate==$alldate[$i])
          {
              $initialdateposition=$i;
              break;
          }
     }
     $j=$initialdateposition;
     for($i=0;$i<=$datelength;$i++)
     {
        $dayName = Carbon::parse($alldate[$j])->format('l');
       
         
         $datestring.="1";
         if(isset($allholidayarray[$alldate[$j]]))
         {
             $datestring[$i]='0';
         }
         if(isset($offdayarray[$alldate[$j]]))
         {
            $datestring[$i]='0';
         }
         if($dayName=="Friday"||$dayName=="Saturday")
         {
            $datestring[$i]='0';
         }
         if(isset($ondayarray[$alldate[$j]]))
         {
            $datestring[$i]='1';
         }
         if($datestring[$i]=='1')
         {
          
             $fredate[$posoffreeday]=$i;
             $posoffreeday++;
         }

        $j++;
     }
    

     //dp is initialize
      for ($i = 0; $i < strlen($datestring)+5; $i++) {
        for ($j = 0; $j < (1 << $totalsub)+5; $j++) {
            $dp[$i][$j] = -1;
        }
    }


      $main_ans = ok(0, 0, $totalsub, $dp, $datestring, $fredate, $posoffreeday, $credit);
      $ck = $main_ans;
    cal(0, 0, 0, $ansdate, $ansday, $anscourse, $initialdateposition, $alldate, $coursecode, $totalsub, $dp, $datestring, $fredate, $posoffreeday, $credit, $ck);
       
      
    function generateUniqueRandomNumber()
    {
        $min = 100000; 
        $max = 999999; 
    
        do {
            
            $randomNumber = rand($min, $max);
    
            
            $exists = routineInfo::where('unique_code', $randomNumber)->exists();
            
        } while ($exists);
    
        return $randomNumber;
    }
    
    
    $uniqueRandomNumber = generateUniqueRandomNumber();
    
    $storedata=new routineInfo();
    $storedata->unique_code=$uniqueRandomNumber;
    $storedata->faculty="CSE";//we need to change here
    $storedata->name="B.Sc(engineering)in CSE";
    $storedata->center="Muhammad Qudrat-i-Khuda building";
    $storedata->time=$request->times;
    $storedata->room=$request->room;
    $st=$request->level;
    $st.=$request->semester;
    $storedata->levsem=$st;

    $storedata->save();

    $user=Auth::user();
    $user_id=$user->id;
     $saveusercode=new finduserid();
     $saveusercode->unique_code=$uniqueRandomNumber;
     $saveusercode->user_id=$user_id;
     $saveusercode->save();


     
     for($i=0;$i<count($anscourse);$i++)
     {
        $resdata=new resultRoutine();
        $resdata->unique_code=$uniqueRandomNumber;
        $resdata->date=$ansdate[$i];
        $resdata->course_code=$anscourse[$i];
        $resdata->day=Carbon::parse($ansdate[$i])->format('l');
        $resdata->save();
       
               // Get all teachers grouped by rank
       $professors = Teacher::where('rank', 'Professor')->where('faculty','CSE')->orderBy('number_of_duty')->get();
       $associateProfessors = Teacher::where('rank', 'Associate Professor')->where('faculty','CSE')->orderBy('number_of_duty')->get();
       $assistantProfessors = Teacher::where('rank', 'Assistant Professor')->where('faculty','CSE')->orderBy('number_of_duty')->get();
       $lecturers = Teacher::where('rank', 'Lecturer')->where('faculty','CSE')->orderBy('number_of_duty')->get();
       $assignTeachers=[];
       $teqacherPerdates=6;
               // Initialize variables
        $assignedTeachers = [];
        $teachersPerDate = 6;
        $rankGroups = [$professors, $associateProfessors, $assistantProfessors, $lecturers];


        while (count($assignedTeachers) < $teachersPerDate) {
            foreach ($rankGroups as $group) {
                if (count($group) > 0) {
                    $teacher = $group->shift(); // Get the teacher with least duties
                    $teacher_id=$teacher->id;
                    if (assignedTeacher::where('teacher_id', $teacher_id)->where('dates', $ansdate[$i])->exists()) {
                        continue;
                    }


                    $assignTec=new assignedTeacher();
                    $assignTec->teacher_id=$teacher_id;
                    $assignTec->unique_code=$uniqueRandomNumber;
                    $assignTec->dates=$ansdate[$i];
                    $assignTec->save();
                    
                    $updateTeacher = Teacher::where('id', $teacher_id)->first(); // Fetch the teacher record
                    $updateTeacher->number_of_duty = $updateTeacher->number_of_duty + 1; // Increment the duty count
                    $updateTeacher->save(); // Save the updated record
                    


                    $assignedTeachers[] = $teacher->id; // Add the teacher to the assigned list

                    if (count($assignedTeachers) >= $teachersPerDate) {
                        break; // Exit the loop if we have 6 teachers
                    }
                }
            }
        }








     }
    

     //    dd($data);
     toastr()->timeOut(5000)->closeButton()->addSuccess('routine create successfully');

        return redirect('admin');
    }

   public function manage_special_day()
   {
      
        
     return view('admin.manage_special_day');
   }
   public function add_special_date(Request $request)
   {
     $data=new specialDate();
     $data->type=$request->type;
     $data->special_date=$request->special_date;
      $data->save();


       
     toastr()->timeOut(5000)->closeButton()->addSuccess('A special day added successfully');
        return redirect()->back();
   }
   public function clear_data()
   {

     
     specialDate::truncate();
     toastr()->timeOut(5000)->closeButton()->addSuccess('All temporary data is cleared');
     return redirect('admin');
   }

   public function add_allholiday()
   {
        return view('admin.add_allholiday');
   }
   public function store_all_holiday(Request $request)
   {
        $data= new allHoliDay();
        $data->holi_date=$request->holi_date;
        $data->save();
        toastr()->timeOut(5000)->closeButton()->addSuccess('A holi day added successfully');
        return redirect()->back();

   }


   public function show_routine()
   {
        $user=Auth::user();
        $user_id=$user->id;
        $allcode=finduserid::where('user_id',$user_id)->get();
        $allroutineinfo=[];
        $allroutineresult=[];
        foreach($allcode as $acode)
        {
            $allroutineinfo[$acode->unique_code]=routineInfo::where('unique_code',$acode->unique_code)->get();
            $allroutineresult[$acode->unique_code]=resultRoutine::where('unique_code',$acode->unique_code)->get();

        }
        // foreach($allroutineresult as $code=>$val)
        // {
        //     echo $code." => ";
        //     foreach($val as $v)
        //     {
        //          echo $v->course_code;
        //     }
        //     echo "<br>";
        // }

        // foreach($allcode as $a)
        // {
        //     foreach($allroutineresult[$a->unique_code] as $v)
        //     {
        //          echo $v->course_code;
        //     }
        //     echo "<br>";
        // }


       


     return view('admin.show_routine',compact('allcode','allroutineinfo','allroutineresult'));
   }

    public function print_routine($id)
    {


        $user=Auth::user();
        $user_id=$user->id;
        $allcode=finduserid::where('user_id',$user_id)->get();
        $allroutineinfo=[];
        $allroutineresult=[];
        foreach($allcode as $acode)
        {
            $allroutineinfo[$acode->unique_code]=routineInfo::where('unique_code',$acode->unique_code)->get();
            $allroutineresult[$acode->unique_code]=resultRoutine::where('unique_code',$acode->unique_code)->get();

        }
    
        $pdf = Pdf::loadView('admin.invoice',compact('allcode','allroutineinfo','allroutineresult','id'));
        return $pdf->download('routine.pdf');

    }
    public function student_req(Request $request)
    {
           $id=$request->search;
        // return redirect(url('print_routine', $request->search));



             $allcode=finduserid::where('unique_code',$id)->get();
             if($allcode->isEmpty())
             {
                toastr()->timeOut(5000)->closeButton()->addWarning('Your code is not valid');
                return redirect()->back();
             }
          else
          {
              $allroutineinfo=[];
              $allroutineresult=[];
     
              $allroutineinfo[$id]=routineInfo::where('unique_code',$id)->get();
              $allroutineresult[$id]=resultRoutine::where('unique_code',$id)->get();

              $pdf = Pdf::loadView('admin.invoice',compact('allcode','allroutineinfo','allroutineresult','id'));

              return $pdf->download('routine.pdf');

             
          }

 


    }

    public function assignedTeacher($unique_code,$date)
    {

        $assignedtech=assignedTeacher::where('unique_code',$unique_code)->where('dates',$date)->get();
        $teacher_name=[];
        foreach($assignedtech as $tc)
        {
            $teacher_name[]=$tc->teacher->name;
        }
  
        return view('admin.assigned_teacher',compact('teacher_name'));
    }


}
