@extends('layouts.app')

@section('jumbotronhead')
  GK Test Question Add, Delete, Edit and Backup
@endsection

@section('content')
<center>
@if (Session::has('message'))
    <div class="alert alert-danger"> {{ Session::get('message') }}</div>
@endif
  <table>
    <tr>
        <td colspan="10">
        <center>
          <a class="btn btn-info" href="{{ route('getAdd') }}">Add Question</a>
          <a class="btn btn-danger" href="{{ route('deleteAll') }}" onclick="return confirm('Are you sure you want to delete all questions?');">Delete All Questions</a>
          <a class="btn btn-success" href="{{ route('createBackup') }}">Backup Questions</a>
        </center>
        </td>
    </tr>
     <tr>
        <th>ID</th>
        <th>Class</th>
        <th>Question</th>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>Correct Option</th>
        <th>Marks</th>
        <th>Edit Delete</th>
     </tr>
     @foreach ($questions as $question)
     <tr>
        <td>{{ $question->id }}</td>
        <td>{{ $question->class }}</td>
        <td>{{ $question->question }}</td>
        <td>{{ $question->a }}</td>
        <td>{{ $question->b }}</td>
        <td>{{ $question->c }}</td>
        <td>{{ $question->d }}</td>
        <td>
          @if ($question->correct_option == 1 )
            a
          @elseif ($question->correct_option == 2 )
            b
          @elseif ($question->correct_option == 3 )
            c
          @else
            d
          @endif
        </td>
        <td>{{ $question->marks }}</td>
        <td>
            <a href="{{ "Edit/{$question->id}" }}">Edit</a>
            <a class="delete-link" href="{{ "Delete/{$question->id}" }}">Delete</a>
        </td>
     </tr>
     @endforeach
  </table>
</center>
@endsection
