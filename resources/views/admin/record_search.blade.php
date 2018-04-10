@extends('layouts.app')

@section('content')
<h1 class="jumbotron">GK Test Students Data Search</h1>
<div class="container">
<form action="/admin/fetch-records" method="post"> {{ csrf_field() }}
    <div class="form-group">
        <label for="name" class="control-label col-md-10">Class</label>
        <select name="classselect" class="form-control">
            <option>V</option>
            <option>VI</option>
            <option>VII</option>
            <option>VIII</option>
        </select>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-10">Section</label>
        <select name="sectionselect" class="form-control">
            <option>A</option>
            <option>B</option>
            <option>C</option>
        </select>
    </div>
    <div class="form-group">
        <label for="name" class="control-label col-md-10">Day</label>
        <select class="form-control" disabled>
            <option value="Day">Day</option>
        </select>
    </div>
    <div id="UserSelection" class="form-group">
      <label for="dtp_input2" class="col-md-10 control-label">Select Date</label>
        <div class="input-group date form_date col-md-10" data-date="" data-date-format="dd M yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
          <input name="datepickerInput" class="form-control" size="16" type="text" value="" readonly/><span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span><span class="input-group-addon"><span class="glyphicon glyphicon-calendar" onclick="form_dates()"></span></span></div><input type="hidden" id="dtp_input2" value="" /><br/>
        </div>
    <hr>
    <button id="submitRecord" class="btn btn-danger form-control">Search</button>
  </form>
</div>
@endsection