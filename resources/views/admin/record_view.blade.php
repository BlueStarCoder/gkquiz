@extends('layouts.app')

@section('jumbotronhead')
  GK Quiz Result For Class {{ $records['class'] }} ({{ $records['section'] }})
@endsection

@section('content')
<div class="container">
	<table>
		<tr><th>Roll No.</th><th>Student Name</th><th>Class</th><th>Section</th><th>{{ $singlemonth }}</th></tr>
		@foreach($studrecords as $singlerecord)
			<tr><td>{{ $singlerecord->Rollno }}</td><td>{{ $singlerecord->StudName }}</td><td>{{ $singlerecord->Class }}</td><td>{{ $singlerecord->Section }}</td><td>{{ $singlerecord->$singlemonth }}</td></tr>
		@endforeach
	</table>
</div>
@endsection