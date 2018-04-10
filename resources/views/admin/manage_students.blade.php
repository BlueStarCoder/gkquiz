@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="jumbotron">Student Management | Add or Update</h1>
<form action = "/admin/manage-students" method = "post"> {{ csrf_field() }}
 <table class="table table-bordered">
    <tr>
      <td>Add or Update</td>
      <td>
        <select id="updateoradd" class="form-control" required>
          <option>Update</option>
          <option>Add</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Class</td>
      <td>
        <select id="stclass" class="form-control" name="class_select" required>
          <option>Select Class</option>
          <option>V</option>
          <option>VI</option>
          <option>VII</option>
          <option>VIII</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Section</td>
      <td>
        <select id="stsec" class="form-control" name="section_select" disabled>
          <option>Select Section</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Roll No.</td>
      <td>
        <select id="stroll" class="form-control" name="rollno_select" disabled>
          <option>Select Rollno.</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Student Name</td>
      <td><input id="stdname" class="form-control" type="text" name="student_name" placeholder="Name"></td>
    </tr>
    <tr>
       <td colspan='4'>
          <center><input class="btn btn-info" name="submit" type='submit' value="Update" id="btnaddupdate" required /></center>
       </td>
    </tr>
 </table>
</form>
</div>
@endsection