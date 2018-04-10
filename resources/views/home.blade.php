@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!<br><br><br>
                    <b class="text-danger">Click on the links :</b>
                    <ul>
                        <li><a href="{{ route('record-search') }}">Students Record Search</a></li>
                        <li><a href="{{ route('manage-questions') }}">Manage Questions</a></li>
                        <li><a href="{{ route('get-students') }}">Manage Students</a></li>
                    </ul> 
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
