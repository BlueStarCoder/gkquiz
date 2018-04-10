<?php

namespace App\Http\Controllers;

use DB;
use App\Question;
use Illuminate\Http\Request;

class ManageQuestionsController extends Controller
{
    public function manage()
    {
        $questions = Question::all();
        return view('admin.manage_questions', ['questions' => $questions]);
    }

    public function search()
    {
        return view('admin.record_search');
    }

    public function fetch(Request $request) {
        $FullDate = $request->datepickerInput;
        $Day = substr($FullDate,0,2);
        $month = substr($FullDate,3,3);
        $singleDayResult = $month . '_' . $Day;
        $records = ['class' => $request->classselect, 'section' => $request->sectionselect];
        $studrecords = DB::select("Select Rollno, StudName, Class, Section, {$singleDayResult} from Class{$request->classselect} where Section='{$request->sectionselect}'");
        return view('admin.record_view', ['records' => $records, 'studrecords' => $studrecords, 'singlemonth' => $singleDayResult]);
    }

    public function backup()
    {
        // create questions table backup with current date attached.
        $currentDate = date('d_M_Y');
        $tableNameToCreate = "question_{$currentDate}";
        dd($tableNameToCreate);
        // \Schema::create($tableNameToCreate, function (\Blueprint $table) {
        //     $table->increments('id');
        // }
        notify()->flash('All Questions Backup Successfully', 'success', [
            'timer' => 1500,
            'text' => '',
        ]);
        // session()->flash('message', 'All Record Backup Successfully');
        return redirect()->back();
    }

    public function show($id)
    {
        $question = Question::find($id);
        return view('admin.question_add_update', ['questions' => $question]);
    }
    
    public function showAdd()
    {
        return view('admin.question_add_update');
    }

    public function add(Request $request) {
        $question = new Question;
        $question->class = $request->input('class_select');
        $question->question = $request->input('question_text');
        $question->a = $request->input('a');
        $question->b = $request->input('b');
        $question->c = $request->input('c');
        $question->d = $request->input('d');
        $question->correct_option = $request->input('correct_option');
        $question->marks = $request->input('marks_to_give');
        $question->save();
        // DB::table('questions')->insert(['class' => $class_select, 'question' => $question, 'a' => $a, 'b' => $b, 'c' => $c, 'd' => $d, 'correct_option' => $correct_option, 'marks' => $marks_to_give]);
        notify()->flash('Question added Successfully', 'success', [
            'timer' => 1500,
            'text' => '',
        ]);
        return redirect('admin/manage-questions');
    }

    public function edit($id, Request $request)
    {
        $updateQuestion = Question::find($id);
        $updateQuestion->class = $request->input('class_select');
        $updateQuestion->question = $request->input('question_text');
        $updateQuestion->a = $request->input('a');
        $updateQuestion->b = $request->input('b');
        $updateQuestion->c = $request->input('c');
        $updateQuestion->d = $request->input('d');
        $updateQuestion->correct_option = $request->input('correct_option');
        $updateQuestion->marks = $request->input('marks_to_give');
        $updateQuestion->save();
        // DB::update("update questions set Class = ?, Question = ? , a = ?, b = ?, c = ?, d = ?, correct_option = ?, marks = ? where id = ?",[$class_select, $question, $a, $b, $c, $d, $correct_option, $marks_to_give, $id]);
        notify()->flash('Question updated Successfully', 'success', [
            'timer' => 1500,
            'text' => '',
        ]);
        // session()->flash('message', 'Record updated Successfully');
        return redirect('admin/manage-questions');
    }

    public function delete($id)
    {
        Question::destroy($id);
        // DB::delete("delete FROM questions where id={$id}");
        $rowsCount = Question::all()->count();
        for ($i = $id; $i <= $rowsCount; $i++) {
            $j = $i + 1;
            $updateQuestion = Question::find($j);
            $updateQuestion->id = $i;
            $updateQuestion->save();
        }
        notify()->flash('Question deleted Successfully', 'success', [
            'timer' => 1500,
            'text' => '',
        ]);
        // session()->flash('message', 'Record deleted Successfully');
        return redirect()->back();
    }

    public function deleteAll()
    {
        // Question::destroy();
        DB::delete("delete FROM questions");
        notify()->flash('All Questions deleted.', 'success', [
            'timer' => 1500,
            'text' => '',
        ]);
        // session()->flash('message', 'All Record deleted Successfully');
        return redirect()->back();
    }
}
