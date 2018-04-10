<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ManageStudentsController extends Controller
{
	public function manage() {
        return view('admin.manage_students');
    }
	public function addorupdate(Request $request) {
		if ($request->student_name == "" || $request->student_name == "Name") {
			return redirect()->back();
		} else if ($request->submit == "Add") {
			$checkStudentExits = DB::table('Class'. $request->class_select)->where(['section' => $request->section_select, 'rollno' => $request->rollno_select])->first();
			if ($checkStudentExits == null) {
				DB::table('Class'. $request->class_select)->insert(['class' => $request->class_select, 'section' => $request->section_select, 'rollno' => $request->rollno_select, 'studname' => $request->student_name]);
			} else {
				$rowsCount = DB::table('Class'. $request->class_select)->where(['section' => $request->section_select])->get()->count();
				for($i = $checkStudentExits->id; $i <= $rowsCount; $i++) {
					$j = $i + 1;
					DB::update("update Class{$request->class_select} set id={$i} where id={$j}");
					DB::update("update Class{$request->class_select} set Rollno={$i} where Rollno={$j}");
				}
				DB::table('Class'. $request->class_select)->insert(['class' => $request->class_select, 'section' => $request->section_select, 'rollno' => $request->rollno_select, 'studname' => $request->student_name]);
			}
		} else if ($request->submit == "Update") {
			$student_id = DB::table('Class' . $request->class_select)->select('id')->where([['Rollno' => $request->rollno_select], ['Section' => $request->section_select]])->get()[0]->id;
			DB::table('Class'. $request->class_select)->update(['class' => $request->class_select, 'section' => $request->section_select, 'rollno' => $request->rollno_select, 'studname' => $request->student_name])->where('id', '=', $student_id);
		} else {
			$currentDate = date('M_d');
        	$student_id = DB::table('Class' . $request->class_select)->select('id')->where([['Rollno' => $request->rollno_select], ['Section' => $request->section_select]])->get()[0]->id;
			DB::table('Class'. $request->class_select)->update(['class' => $request->class_select, 'section' => $request->section_select, 'rollno' => $request->rollno_select, 'studname' => $request->student_name, $currentDate => "ABS"])->where('id', '=', $student_id);
		}
		return redirect()->back();
	}
}