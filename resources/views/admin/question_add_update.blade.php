@extends('layouts.admin')

@section('jumbotronhead')
  Question Management | {{ (isset($questions)) ? 'Edit' : 'Add' }}
@endsection

@section('content')
<form action = "{{ (isset($questions)) ? '/admin/Edit/' . $questions->id : '/admin/Add' }}" method = "post"> {{ csrf_field() }}
 <table class="table table-bordered">
    <tr>
       <td>Class</td>
       <td>
            <select class="form-control" name="class_select" required>
                    <option @if (isset($questions)) {{ ($questions->class == 'V') ? 'selected' : '' }} @endif >V</option> 
                    <option @if (isset($questions)) {{ ($questions->class == 'VI') ? 'selected' : '' }} @endif >VI</option> 
                    <option @if (isset($questions)) {{ ($questions->class == 'VII') ? 'selected' : '' }} @endif >VII</option> 
                    <option @if (isset($questions)) {{ ($questions->class == 'VIII') ? 'selected' : '' }} @endif >VIII</option> 
            </select>
       </td>
       <td>Question</td>
       <td>
            <textarea class="form-control" rows="5" cols="45" name="question_text" required>{{ (isset($questions)) ? $questions->question : '' }}</textarea>
       </td>
    </tr>
    <tr>
       <td>A</td>
       <td>
           <textarea class="form-control" name="a" required>{{ (isset($questions)) ? $questions->a : '' }}</textarea>
       </td>
           <td>B</td>
           <td>
                <textarea class="form-control" name="b" required>{{ (isset($questions)) ? $questions->b : '' }}</textarea>
           </td>
       </tr>
       <tr>
           <td>C</td>
           <td>
                <textarea class="form-control" name="c" required>{{ (isset($questions)) ? $questions->c : '' }}</textarea>
           </td>
           <td>D</td>
           <td>
                <textarea class="form-control" name="d" required>{{ (isset($questions)) ? $questions->d : '' }}</textarea>
           </td>
       </tr>
       <tr>
           <td>Correct Option</td>
           <td>
            <select class="form-control" name="correct_option" required>
                <option @if (isset($questions)) {{ ($questions->correct_option == '1') ? 'selected' : '' }} @endif value="1">a</option> 
                <option @if (isset($questions)) {{ ($questions->correct_option == '2') ? 'selected' : '' }} @endif value="2">b</option> 
                <option @if (isset($questions)) {{ ($questions->correct_option == '3') ? 'selected' : '' }} @endif value="3">c</option> 
                <option @if (isset($questions)) {{ ($questions->correct_option == '4') ? 'selected' : '' }} @endif value="4">d</option> 
            </select>
           </td>
       <td>Marks</td>
       <td>
            <select class="form-control" name="marks_to_give" required>
                    <option @if (isset($questions)) {{ ($questions->marks == 1) ? 'selected' : '' }} @endif >1</option> 
                    <option @if (isset($questions)) {{ ($questions->marks == 2) ? 'selected' : '' }} @endif >2</option> 
                    <option @if (isset($questions)) {{ ($questions->marks == 3) ? 'selected' : '' }} @endif >3</option> 
                    <option @if (isset($questions)) {{ ($questions->marks == 4) ? 'selected' : '' }} @endif >4</option> 
                    <option @if (isset($questions)) {{ ($questions->marks == 5) ? 'selected' : '' }} @endif >5</option> 
            </select>
       </td>
    </tr>
    <tr>
       <td colspan='4'>
          <center><input class="btn btn-info" type = 'submit' value = "{{ (isset($questions)) ? 'Update' : 'Add' }} Question" required/></center>
       </td>
    </tr>
 </table>
</form>
@endsection