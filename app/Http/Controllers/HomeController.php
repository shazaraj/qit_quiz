<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use App\Models\Result;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Matrix\Operators\Division;

class HomeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::get()->count();
        $question = Question::get()->count();
        return view('dashboard',compact('user','question'));
    }
    public function user()
    {
        if (auth()->user()->is_admin == 1) {
            return redirect()->route('admin.route');
        }else{

             $id = Auth::id();
             $res = Result::where('user_id',$id)->first();
            if($res){
                $quiz = Result::query()->where('user_id',$id)->first();
                $ques = Question::query()->count();

                return view('pages\users\quiz_finish',compact('quiz','ques'));
            }
            else{
            return view('pages\users\quiz');
            }
        }

    }
    public function quiz_start(){

        Session::put("nextq",'1');
        Session::put("wrongans",'0');
        Session::put("correctans",'0');

        $quiz = Question::query()->orderBy('id')->first();
         Session::put("current_question",$quiz->id);

        return view('pages.users.quiz_start')->with(['quiz'=>$quiz]);
    }
    public function submit_answer(Request $request){

        $nextq = Session::get("nextq");
        $wrongans = Session::get("wrongans");
        $correctans = Session::get("correctans");
        $current_question= Session::get("current_question")  ;


        $validateErrors = Validator::make($request->all(),[
            'option' => 'required',
            'dbans' => 'required'
        ]);

        if ($validateErrors->fails()) {
            return response()->json(['status' => 201, 'message' => $validateErrors->errors()->first()]);
        }

        $nextq++;

        if($request->option == $request->dbans){

            $correctans++;
        }
        else{
            $wrongans++;
        }
        Session::put("nextq",$nextq);
        Session::put("wrongans",$wrongans);
        Session::put("correctans",$correctans);

        $nextQuestion = Question::query()->where('id','>' ,$current_question)->first();

        if($nextQuestion){
            Session::put("current_question",$nextQuestion->id);
            return view('pages.users.quiz_start')->with(['quiz'=>$nextQuestion]);
        }else{

            $quest = Question::query()->count();
            $res = $correctans / $quest * 100;
            // dd($res);
            if($res > 50){
                $res_degree = 'passed';
            }else{
                $res_degree = 'faild';
             }
            $data =[
                    'user_id' => Auth::id(),
                    'correct_ans' => $correctans,
                    'wrong_ans' => $wrongans,
                    'result' =>$res_degree
                    ];

           Result::updateOrCreate(['id' => $request->_id],
                     $data)->id;
            $id = Auth::id();
            $quiz = Result::query()->where('user_id',$id)->first();
            $ques = Question::query()->count();
         return view('pages.users.quiz_finish',compact('quiz','ques'));
        }

    }
}
