@extends('layouts.app')

@section('content')
<h1 class="jumbotron">GK Quiz Result For Class {{ $records['class'] }} ({{ $records['section'] }})</h1>
<div class="container">
	<table class="table table-condensed table-bordered">
		<tr><th>Roll No.</th><th>Student Name</th><th>Class</th><th>Section</th><th>{{ $singlemonth }}</th></tr>
		@foreach($studrecords as $singlerecord)
			<tr><td>{{ $singlerecord->Rollno }}</td><td>{{ $singlerecord->StudName }}</td><td>{{ $singlerecord->Class }}</td><td>{{ $singlerecord->Section }}</td><td>{{ $singlerecord->$singlemonth }}</td></tr>
		@endforeach
	</table>
</div>
@endsection