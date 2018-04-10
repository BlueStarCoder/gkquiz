@extends('layouts.default')

@section('content')
    <h1 class="jumbotron">Test your knowledge</h1>
    <form action="/questions" method="post"> {{ csrf_field() }}
    <div class="info-container">
        <label>Student Name : <input class="form-control" name="stdname" type="text" value="{{ request()->stdname }}" readonly /></label>
        <label>Student Class : <input class="form-control" name="stclass" type="text" value="{{ request()->stclass }}" readonly /></label>
        <label>Student Section : <input class="form-control" name="stsec" type="text" value="{{ request()->stsec }}" readonly /></label>
        <label>Student Roll No. : <input class="form-control" name="stroll" type="text" value="{{ request()->stroll }}" readonly /></label>
    </div>
    <div class="quiz-container">
    <?php $i = 1; ?>
    @foreach ($questions as $question)
            <div id="All">
                <p>{{ $question->question }}</p>
                <div class="options">
                    <input type="radio" name="{{ $i }}" value="1" /> {{ $question->a }}</br>
                    <input type="radio" name="{{ $i }}" value="2" /> {{ $question->b }}</br>
                    <input type="radio" name="{{ $i }}" value="3" /> {{ $question->c }}</br>
                    <input type="radio" name="{{ $i }}" value="4" /> {{ $question->d }}</br>
                </div>
            </div>
        <?php $i++; ?>
    @endforeach
        <input  type="submit" class="btn btn-info" value="Submit" />
    </div>
</form>
<script>
// Form Validation

</script>
@endsection
