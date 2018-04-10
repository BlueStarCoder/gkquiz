@extends('layouts.app')

@section('jumbotronhead')
  GK Test Students Data Search
@endsection

@section('content')
<form action="/admin/fetch-records" method="get">
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
        <label for="name" class="control-label col-md-10">Day or Days</label>
        <select id="DayorDays" class="form-control" onchange="DayorDaysUser(value)">
            <option value="Day">Day</option>
            <option value="Days">Days</option>
        </select>
    </div>
    <div id="UserSelection"></div>
    <script type="text/javascript">
      function DayorDaysUser(value = 'Day') {
        if (value == 'Day') {
          document.getElementById("DayorDays").value = "Day";
          $('#UserSelection').replaceWith("<div id=\"UserSelection\" class=\"form-group\"><label for=\"dtp_input2\" class=\"col-md-10 control-label\">Select Date</label><div class=\"input-group date form_date col-md-10\" data-date=\"\" data-date-format=\"dd M yyyy\" data-link-field=\"dtp_input2\" data-link-format=\"yyyy-mm-dd\"><input name=\"datepickerInput\" class=\"form-control\" size=\"16\" type=\"text\" value=\"\" readonly/><span class=\"input-group-addon\"><span class=\"glyphicon glyphicon-remove\"></span></span><span class=\"input-group-addon\"><span class=\"glyphicon glyphicon-calendar\" onclick=\"form_dates()\"></span></span></div><input type=\"hidden\" id=\"dtp_input2\" value=\"' /><br/></div>");
        } else {
          document.getElementById("DayorDays").value = "Days";
          $('#UserSelection').replaceWith("<div id=\"UserSelection\" class=\"form-group\"><label class=\"col-md-10 control-label\">Select Start and Stop Date</label><div class=\"input-group col-md-10\" data-date='\" data-date-format='dd MM yyyy\" ><input id=\"dateRangeInput\" style=\"text-align:center;font-weight:bold;\" class=\"form-control\" type=\"text\" name=\"datepickerInput\" value=\"01/01/2017 - 01/02/2017\" onmouseover=\"DaterangeSelect()\" readonly/></div>");
        }
      }
      $(document).ready(DayorDaysUser());
    </script>
    <hr>
    <button id="submitRecord" class="btn btn-danger form-control">Search</button>
  </form>
@endsection