<?php

namespace App\Http\Controllers;

use DB;
use App\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $records = ['stdname' => $request->stdname, 'stclass' => $request->stclass, 'stsec' => $request->stsec, 'stroll' => $request->stroll];
        $questions = Question::where('class', '=', $records['stclass'])->get();
        return view('quiz.questions', ['stdinfo' => $records ,'questions' => $questions]);
    }

    public function check(Request $request)
    {
        $stClass = $request->stclass;
        $stSection = $request->stsec;
        $strollno = $request->stroll;
        $currentDate = date('M_d');
        $marks = DB::table('Class' . $stClass)->select($currentDate)->where([['section', '=',$stSection], ['Rollno', '=', $strollno]])->first()->$currentDate;
        if ($marks === "ABS") {
            return 0;
        } else {
            return 1;
        }
    }

    public function getSection(Request $request) {
        $stClass = $request->stclass;
        
        $sections = DB::table('Class' . $stClass)->select('section')->distinct()->get();
        return json_encode($sections);
    }

    public function getRollNums(Request $request)
    {
        // for( $i = 0,$values = ClassGiven::select('rollno')->get(), $count = $values->count(); $i < $count; $i++) {
        //    echo $values[$i]->Rollno . "<br />";
        // }
        // dd(json_encode(ClassGiven::select('rollno')->get()));
        // $rollNums = \DB::select("SELECT RollNo FROM Class{$stClass} where Section={$stSection}");
        $stClass = $request->stclass;
        $stSection = $request->stsec;
        
        $rollNums = DB::table('Class' . $stClass)->select('rollno')->where('section', '=', $stSection)->get();
        return json_encode($rollNums);
    }

    public function getName(Request $request) {
        $stClass = $request->stclass;
        $stSection = $request->stsec;
        $strollno = $request->stroll;

        $sections = DB::table('Class' . $stClass)->select('studname')->where([['section', '=',$stSection], ['Rollno', '=', $strollno]])->first();
        return json_encode($sections);
    }
    
    public function allquest()
    {
        $questions = Question::all();
        return view('quiz.allQuestions', ['questions' => $questions]);
    }
    
    public function updateRecord(Request $request)
    {
        $totalMarks = 0;
        $currentDate = date('M_d');
        $stClass = $request->input('stclass');
        $stSection = $request->input('stsec');
        $strollno = $request->input('stroll');
        $class_questions = Question::select(['correct_option', 'marks'])->where('class', '=', $stClass)->get();
        $questions_count = $class_questions->count();
        // $questions_count = count(DB::select("select correct_option from questions where class='{$stdclass}'"));
        for($i = 0; $i < $questions_count; $i++) {
            if ( $class_questions[$i]->correct_option === $request->input($i + 1)) {
                $totalMarks += $class_questions[$i]->marks;
            }
        }
        $result = DB::update("update Class{$stClass} set {$currentDate}='{$totalMarks}' where section='{$stSection}' and rollno='{$strollno}'");
        // DB::table('Class' . $stClass)->update([$currentDate => $totalMarks])->where([['section','=', $stSection], ['rollno', '=', $strollno]]);
        return redirect()->to('/');
    }
}
