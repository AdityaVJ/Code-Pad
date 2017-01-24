<?php
/**
 * AdminController Class Doc Comment
 *
 * PHP version 5
 *
 * @category PHP
 * @package  CodePad
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ncs-jss/Code-Pad
 *
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;
use Redirect;
use Storage;
use App\Student;
use App\ProgramRecord;
use App\ProgramDetails;
use App\Teacher;
use App\Admin;
use Illuminate\Support\MessageBag;

/**
 * This controller handles the all the functionalities for the Admin User.
 *
 * @category PHP
 * @package  CodePad
 * @author   Ankit Jain <ankitjain28may77@gmail.com>
 * @license  The MIT License (MIT)
 * @link     https://github.com/ncs-jss/Code-Pad
 */
class AdminController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the all the functionalities for the Admin User.
    |
    */


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show Create Event Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEvent()
    {
        // Session::flash('message','Create an Event');
        return view('program.record');
    }

    /**
     * Adding New Event in DB
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function record(Request $request)
    {
        // Validation
        $this->validate(
            $request,
            [
            'name' => 'required|max:255|',
            'code' => 'required|max:20|unique:compiler_record',
            'description' => 'required',
            'starttime' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'endtime' => 'required',
            'uploaded_by'=>'required',
            'upload_id' => 'required',
            ]
        );


        $record = Input::all();
        // return $record;
        $eventStart = array(
            'startdate' => $record['startdate'],
            'starttime' => $record['starttime']
        );

        $eventEnd = array(
            'enddate' => $record['enddate'],
            'endtime' => $record['endtime']
        );

        // return substr($record['starttime'],-2);
        $start = $this->dateConversion(
            $record['startdate']
        ) . $this->timeConversion(
            $record['starttime']
        );

        $end = $this->dateConversion(
            $record['enddate']
        ) . $this->timeConversion(
            $record['endtime']
        );

        date_default_timezone_set('Asia/Kolkata');
        $time = date("YmdHi", time());
        // return $start-$time;
        if ($end - $start >= 100 && $start - $time >=0 ) {
            // Save to database
            $rec = new ProgramRecord;
            $rec->name = $record['name'];
            $rec->code = $record['code'];
            $rec->description = $record['description'];
            $rec->starttime = serialize($eventStart);
            $rec->endtime = serialize($eventEnd);
            $rec->start = $start;
            $rec->end = $end;
            $rec->uploaded_by = $record['uploaded_by'];
            $rec->upload_id = $record['upload_id'];
            if ($rec->save()) {
                $result = ProgramRecord::where(
                    'code', $record['code']
                )->first();

                // Session create
                Session::put('record_id', $result->id);

                // Create a new file for that particular event with its unique code
                Storage::put('record/' . $record['code'] . '.txt', '');

                return Redirect::to('admin/create')->with(
                    [
                    'message' => 'Record is successfully saved',
                    'class' => 'Success'
                    ]
                );
            }
            return Redirect::back()->with(
                [
                'message' => 'Record is failed',
                'class' => 'Danger'
                ]
            )->withInput();
        } else {
            $errors = new MessageBag(
                [
                'startdate' => ['Event must be start before the end time'],
                'enddate' => ['Event must be end after the start time']
                ]
            );
            return Redirect::back()->withErrors($errors)->withInput()->with(
                [
                'message' => 'Enter correct time,
                    Event must be started after 24 hours from now',
                'class' => 'Warning'
                ]
            );
        }
    }

    /**
     * For showing Event Page on the basis of the Code
     *
     * @param string $code Contains the Event Unique Code
     *
     * @return \Illuminate\Http\Response
     */
    public function openEvent($code)
    {
        // Update in a database
        $result = ProgramRecord::where('code', $code)->first();
        if ($result) {
            //Session create record_id
            Session::put('record_id', $result->id);
            $start = $result['start'];
            $end = unserialize($result['endtime']);

            $end = $this->dateConversion(
                $end['enddate']
            ) . $this->timeConversion(
                $end['endtime']
            );

            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi", time());
            if ($start > $time) {
                $timing = "-1";
                $class = "Info";
                $mess = "Update the event";
            } elseif ($time >= $start && $time <= $end) {
                $timing = "-1";
                $class = "Warning";
                $mess = "Event is started, Update changes only that are necessary";
            } else {
                $timing = "-1";
                $class = "Danger";
                $mess = "Event is ended, Thank You";
            }
            return view('program.update')->with('message', [$mess, $class, $timing]);
        }

        return Redirect::back()->with(
            [
            'message' => 'Incorrect program code',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Create Programs for the Event
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function programDetails(Request $request)
    {
        // Validation
        $this->validate(
            $request,
            [
            'program_name' => 'required|max:255|',
            'program_statement' => 'required|',
            'testcases_input' =>'required',
            'testcases_output' => 'required',
            'time' => 'required',
            'marks' => 'required'
            ]
        );
        // Input
        $pg=Input::all();

        // Save to DB
        $prg = new ProgramDetails;
        $prg->program_name = $pg['program_name'];
        $prg->program_statement = $pg['program_statement'];
        $prg->difficulty = $pg['difficulty'];
        $prg->sample_input = $pg['sample_input'];
        $prg->sample_output = $pg['sample_output'];
        $prg->sample_explanation = $pg['sample_explanation'];
        $prg->time = $pg['time'];
        $prg->marks = $pg['marks'];
        $prg->testcases_input = $pg['testcases_input'];
        $prg->testcases_output = $pg['testcases_output'];
        $prg->record_id=Session::get('record_id');
        if ($prg->save()) {
            if ($pg['decide']=='1') {
                return Redirect::back()->with(
                    [
                    'message' => 'Program is uploaded!!',
                    'class' => 'Success'
                    ]
                );
            }
            $code = ProgramRecord::find(Session::get('record_id'));
            $code = $code->code;
            return Redirect::to('admin/update/'.$code)->with(
                [
                'message' => 'Program is uploaded!!',
                'class' => 'Success'
                ]
            );
        }

        return Redirect::back()->with(
            [
            'message' => 'Program failed to upload',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Show Update Programs Page for the Event
     *
     * @param string $code Contains the Event Unique Code
     * @param int    $id   Contains Id of the associated Event
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProgram($code, $id)
    {
        $result = ProgramDetails::find($id);
        if (Session::get('record_id') == $result['record_id']) {
            return View('program.updateProgram')->with('data', $result);
        }
        return View("errors.503");
    }

    /**
     * Show page after updating the Program
     *
     * @return \Illuminate\Http\Response
     */
    public function programUpdateDone()
    {
        //Get Input
        $result=Input::all();
        //Update data in DB
        $prg = ProgramDetails::find($result['id']);
        $prg->program_name = $result['program_name'];
        $prg->program_statement = $result['program_statement'];
        $prg->difficulty = $result['difficulty'];
        $prg->sample_input = $result['sample_input'];
        $prg->sample_output = $result['sample_output'];
        $prg->sample_explanation = $result['sample_explanation'];
        $prg->time = $result['time'];
        $prg->marks = $result['marks'];
        $prg->testcases_input = $result['testcases_input'];
        $prg->testcases_output = $result['testcases_output'];
        $prg->record_id = Session::get('record_id');
        if ($prg->save()) {
            // return Redirect::to('program')->with('message','Program is updated!');
            // return view('program.update')->with('message','Program is updated!');
            $code = ProgramRecord::find(Session::get('record_id'));
            $code = $code->code;
            return Redirect::to('admin/update/'.$code)->with(
                [
                'message' => 'Program is updated!!',
                'class' => 'Success'
                ]
            );
        } else {
            return Redirect::back()->with(
                [
                'message' => 'Error in updating program, Try Again',
                'class' => 'Danger'
                ]
            );
        }

    }

    /**
     * Shows Event details to the user
     *
     * @return \Illuminate\Http\Response
     */
    public function eventDetails()
    {
        $result = ProgramRecord::find(Session::get('record_id'));
        $start = unserialize($result['starttime']);
        $end = unserialize($result['endtime']);
        $result['startdate'] = $start['startdate'];
        $result['starttime'] = $start['starttime'];
        $result['enddate'] = $end['enddate'];
        $result['endtime'] = $end['endtime'];
        return view('program.eventdetails')->with('data', $result);
    }

    /**
     * Edit the Event Details
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param string  $code    Contains the Event Unique Code
     *
     * @return \Illuminate\Http\Response
     */
    public function eventSave(Request $request, $code)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255|',
            'description' => 'required',
            'starttime' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'endtime' => 'required',
            ]
        );

        $record = Input::all();

        $rec = ProgramRecord::where('code', $code)->first();

        $eventStart = array(
            'startdate' => $record['startdate'],
            'starttime' => $record['starttime']
        );
        $eventEnd = array(
            'enddate' => $record['enddate'],
            'endtime' => $record['endtime']
        );

        $start = $this->dateConversion(
            $record['startdate']
        ) . $this->timeConversion(
            $record['starttime']
        );

        $end = $this->dateConversion(
            $record['enddate']
        ) . $this->timeConversion(
            $record['endtime']
        );

        date_default_timezone_set('Asia/Kolkata');
        $time = date("YmdHi", time());
        // return $start-$time;

        if ($end-$start >= 100 && $start-$time >=0) {
            // Save to database
            $rec->name=$record['name'];
            $rec->description=$record['description'];
            $rec->instructions=$record['instructions'];
            $rec->starttime=serialize($eventStart);
            $rec->endtime=serialize($eventEnd);
            $rec->start=$start;
            $rec->end=$end;
            if ($rec->save()) {
                return Redirect::to('admin/update/' . $code)->with(
                    [
                    'message' => 'Record is successfully saved',
                    'class' => 'Success'
                    ]
                );
            }
            return Redirect::back()->with(
                [
                'message' => 'Record is failed',
                'class' => 'Danger'
                ]
            )->withInput();
        } else {
            $errors=new MessageBag(
                [
                'startdate' => ['Event must be start before the end time'],
                'enddate' => ['Event must be end after the start time']
                ]
            );
            return Redirect::back()->withErrors($errors)->withInput()->with(
                [
                'message' => 'Enter correct time,
                     Event must be started after 24 hours from now',
                'class' => 'Warning'
                ]
            );
        }
    }

    /**
     * Delete the Event
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Event ID
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        // $del=ProgramRecord::find($id);
        if ($id == Session::get('record_id')) {
            $del = ProgramRecord::find($id);
            // return $del;
            $del->delete();
            // ProgramRecord::destroy($id);
            // if($)
            return Redirect::to('home')->with(
                [
                'message' => 'Event is successfully deleted',
                'class' => 'Success'
                ]
            );
        }
    }

    /**
     * Check for the Existing Code during the Event Creation
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param string  $code    Contains the Code which needs to be checked
     *
     * @return \Illuminate\Http\Response
     */
    public function checkCode(Request $request, $code)
    {
        // echo $code;
        if (ProgramRecord::where('code', $code)->first()) {
            $errors = new MessageBag(
                [
                'code' => ['Password Invalid']
                ]
            );
            echo $errors;
        } else {
            echo "false";
        }
    }

    /**
     * Add the Program
     *
     * @return \Illuminate\Http\Response
     */
    public function programInput()
    {
        return view('program.input');
    }

    /**
     * Date Conversion
     *
     * @param string $value Contains the Date
     *
     * @return string
     */
    public function dateConversion($value)
    {
        $value = explode('/', $value);
        $value = array_reverse($value);
        $value = $value[0] . "" . $value[2] . "" . $value[1];
        return $value;
    }

    /**
     * Converts Time
     *
     * @param string $value Contains the time
     *
     * @return string
     */
    public function timeConversion($value)
    {
        $time = "";
        if (substr($value, -2) == "AM") {
            if (substr($value, 0, 2) == "12") {
                $time="00" . substr($value, 3, 2);
            } else {
                $time=substr($value, 0, 2) . substr($value, 3, 2);
            }
        } else {
            if (substr($value, 0, 2) != "12") {
                $time = substr($value, 0, 2) + 12;
                $time = $time . substr($value, 3, 2);
            } else {
                $time = substr($value, 0, 2) . substr($value, 3, 2);
            }
        }
        return $time;
    }

    /**
     * Shows the Contest Page
     *
     * @param string $code Contains the Event Code
     *
     * @return \Illuminate\Http\Response
     */
    public function contest($code)
    {

        // Update in a database
        $result = ProgramRecord::where('code', $code)->first();
        if ($result) {
            Session::put('record_id', $result->id);
            $record = unserialize($result['endtime']);
            $end = $this->dateConversion(
                $record['enddate']
            ) . $this->timeConversion(
                $record['endtime']
            );
            date_default_timezone_set('Asia/Kolkata');
            $time = date("YmdHi", time());
            if ($result->start > $time) {
                return view('program.contest')->with(
                    'message',
                    [
                    'message' => 'Event is not started yet',
                    'class' => 'Warning',
                    'sussess' => 1
                    ]
                );
            } elseif ($end < $time) {
                return view('program.contest')->with(
                    'message',
                    [
                    'message' => 'Event is ended',
                    'class' => 'Info'
                    ]
                );
            }
            return view('program.contest')->with(
                'message',
                [
                'message' => 'Event is live!!',
                'class' => 'Success'
                ]
            );
        }

        return Redirect::back()->with('message', 'Incorrect Event');
    }

    /**
     * Write Programs for the Contest Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param string  $code    Contains the Event Code
     * @param int     $id      Contains the Id of the Program
     *
     * @return \Illuminate\Http\Response
     */
    public function play(Request $request, $code, $id)
    {
        // return $code;
        $details = ProgramDetails::where('id', $id)->get()->first();
        $details['code'] = $code;
        // return $details;
        return view('program.program')->with('data', $details);
    }

    /**
     * Shows Add new Admin page
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdmin()
    {
        return view('admin.addAdmin');
    }

    /**
     * Add new Admin Data in DB
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function addAdmindata(Request $request)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admin',
            'password' => 'required|min:6|confirmed',
            ]
        );

        $add = Input::all();

        $user = new Admin;
        $user->name = $add['name'];
        $user->email = $add['email'];
        $user->type = 0;
        $user->password =  Hash::make($add['password']);
        if ($user->save()) {
            return Redirect::to('/admin/Admin/Show')->with(
                [
                'message' => 'You have successfully added user',
                'class' => 'Success'
                ]
            );
        }
        return Redirect::back()->withInput()->with(
            [
            'message' => 'Error in registration, Please Try Again',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Shows Admin Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdmin(Request $request)
    {
        $result = Admin::where('type', 0)->get();
        $result->type = 'admin';
        return view('admin.showUser')->with('user', $result);
    }

    /**
     * Show Edit Admin Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Admin ID
     *
     * @return \Illuminate\Http\Response
     */
    public function editAdmin(Request $request, $id)
    {
        $result = Admin::find($id);
        if ($result->type == 0) {
            return view('admin.editUser')->with('user', $result);
        }
        return Redirect::back()->with(
            [
            'message' => 'Invalid Authorization',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Update the Admin Details or Credentials
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Admin ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(Request $request, $id)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            ]
        );
        $admin = Admin::find($id);

        $inp = Input::all();
        // return $inp;
        if ($inp['email'] != $admin->email) {
            $admin->email = $inp['email'];
        }
        if ($inp['password'] != "") {
            $this->validate(
                $request,
                [
                'password' => 'min:6|confirmed',
                ]
            );

            $admin->password = Hash::make($inp['password']);
        }

        $admin->save();
        return Redirect::back()->with(
            [
            'message' => 'successfully Done',
            'class' => 'Success'
            ]
        );
    }

    /**
     * Show Students Page
     *
     * @return \Illuminate\Http\Response
     */
    public function addStudent()
    {
        return view('admin.addStudent');
    }

    /**
     * Add new Student Data in DB
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function addStudentdata(Request $request)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'admision_no' => 'required|max:255|unique:student',
            'password' => 'required|min:6|confirmed',
            ]
        );

        $add = Input::all();

        $user = new Student;
        $user->name = $add['name'];
        $user->admision_no = $add['admision_no'];
        $user->password =  Hash::make($add['password']);
        if ($user->save()) {
            return Redirect::to('/admin/Student/Show')->with(
                [
                'message' => 'You have successfully added user',
                'class' => 'Success'
                ]
            );
        }
        return Redirect::back()->withInput()->with(
            [
            'message' => 'Error in registration, Please Try Again',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Shows Student Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function showStudent(Request $request)
    {
        $result = Student::all();
        $result->type = 'student';
        return view('admin.showUser')->with('user', $result);
    }

    /**
     * Show Edit Student Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Student ID
     *
     * @return \Illuminate\Http\Response
     */
    public function editStudent(Request $request, $id)
    {
        $result = Student::find($id);
        $result['type'] = 'student';
        if ($result->type == 0) {
            return view('admin.editUser')->with('user', $result);
        }
        return Redirect::back()->with(
            [
            'message' => 'Invalid Authorization',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Update the Student Details or Credentials
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Student ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request, $id)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'admision_no' => 'required',
            ]
        );
        $admin = Student::find($id);

        $inp = Input::all();
        // return $inp;
        if ($inp['admision_no'] != $admin->admision_no) {
            $admin->admision_no = $inp['admision_no'];
        }
        if ($inp['password'] != "") {
            $this->validate(
                $request,
                [
                'password' => 'min:6|confirmed',
                ]
            );

            $admin->password = Hash::make($inp['password']);
        }
        if ($admin->save()) {
            return Redirect::back()->with(
                [
                'message' => 'successfully Done',
                'class' => 'Success'
                ]
            );
        } else {
            return Redirect::back()->with(
                [
                'message' => 'Error in updating',
                'class' => 'Danger'
                ]
            );
        }
    }

    /**
     * Show Teacher Page
     *
     * @return \Illuminate\Http\Response
     */
    public function addTeacher()
    {
        return view('admin.addTeacher');
    }

    /**
     * Add new Teacher Data in DB
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function addTeacherdata(Request $request)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:teacher',
            'password' => 'required|min:6|confirmed',
            ]
        );

        $add=Input::all();

        $user = new Teacher;
        $user->name = $add['name'];
        $user->email = $add['email'];
        $user->password =  Hash::make($add['password']);
        if ($user->save()) {
            return Redirect::to('/admin/Teacher/Show')->with(
                [
                'message' => 'You have successfully added user',
                'class' => 'Success'
                ]
            );
        }
        return Redirect::back()->withInput()->with(
            [
            'message' => 'Error in registration, Please Try Again',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Shows Teacher Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function showTeacher(Request $request)
    {
        $result = Teacher::all();
        $result->type = 'teacher';
        return view('admin.showUser')->with('user', $result);
    }

    /**
     * Show Edit Teacher Page
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Teacher ID
     *
     * @return \Illuminate\Http\Response
     */
    public function editTeacher(Request $request, $id)
    {
        $result = Teacher::find($id);
        $result['type'] = 'teacher';
        if ($result->type == 0) {
            return view('admin.editUser')->with('user', $result);
        }
        return Redirect::back()->with(
            [
            'message' => 'Invalid Authorization',
            'class' => 'Danger'
            ]
        );
    }

    /**
     * Update the Teacher Details or Credentials
     *
     * @param Request $request To obtain an instance of the current HTTP request
     * @param int     $id      Contains the Teacher ID
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTeacher(Request $request, $id)
    {
        $this->validate(
            $request,
            [
            'name' => 'required|max:255',
            'email' => 'required',
            ]
        );
        $admin = Teacher::find($id);

        $inp = Input::all();
        // return $inp;
        if ($inp['email'] != $admin->email) {
            $admin->email = $inp['email'];
        }
        if ($inp['password']!="") {
            $this->validate(
                $request,
                [
                'password' => 'min:6|confirmed',
                ]
            );

            $admin->password = Hash::make($inp['password']);
        }
        if ($admin->save()) {
            return Redirect::back()->with(
                [
                'message' => 'successfully Done',
                'class' => 'Success'
                ]
            );
        } else {
            return Redirect::back()->with(
                [
                'message' => 'Error in updating',
                'class' => 'Danger'
                ]
            );
        }
    }
}
