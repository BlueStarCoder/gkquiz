@extends('layouts.default')

@section('content')
<div class="intro">
<h1 class="jumbotron">Test Your Knowledge:<span>GK Quiz</span></h1>
    <form action="/questions" method="post">
        {{ csrf_field() }}
        <table class="table form-group">
            <tr>
                <td>Class</td>
                <td>
                    <select name="stclass" id="stclass" class="select form-control">
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
                    <select name="stsec" id="stsec" class="select form-control" disabled>
                        <option>Select Section</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Roll No.</td>
                <td>
                    <select name="stroll" id="stroll" class="select form-control" disabled>
                        <option>Select Rollno.</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Student Name</td>
                <td>
                    <input name="stdname" id="stdname" class="form-control" type="text" placeholder="Name" readonly/>
                </td>
            </tr>
            <tr>
                <td colspan="2">
            <center>
                <input id="enter" type="button" class="btn btn-blue btn-info" value="Enter" />
            </center>
            </td>
            </tr>
        </table>
    </form>
</div>
@endsection