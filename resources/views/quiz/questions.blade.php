@extends('layouts.default')

@section('content')
    <h3 class="jumbotron">Class {{ $stdinfo['stclass'] }} - Gk Test</h3>
    
    <form action="/submit" method="post"> {{ csrf_field() }}
    <div class="info-container">
        <label>Student Name : <input class="form-control" name="stdname" type="text" value="{{ $stdinfo['stdname'] }}" readonly /></label>
        <label>Student Class : <input class="form-control" name="stclass" type="text" value="{{ $stdinfo['stclass'] }}" readonly /></label>
        <label>Student Section : <input class="form-control" name="stsec" type="text" value="{{ $stdinfo['stsec'] }}" readonly /></label>
        <label>Student Roll No. : <input class="form-control" name="stroll" type="text" value="{{ $stdinfo['stroll'] }}" readonly /></label>
    </div>
    <div class="quiz-container">
    <?php $i = 1; ?>
    @foreach ($questions as $question)
        @if ($i == 1)
            <div id="{{ $i }}">
        @else
            <div id="{{ $i }}" class="hidden">
        @endif
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
        <a id="next" class="btn btn-info">Next</a>
    </div>
</form>
<script>
var id = 1;
document.getElementById('next').onclick = function() { 
    if (id === (document.getElementsByClassName('hidden').length + 1)) {
        swal({
          title: "Your test is complete answer will be submitted do not close the browser!.",
          text: "",
          icon: "warning",
          timer: 3000,
          buttons: false,
          showConfirmButton: false,
        //  dangerMode: true,
        });
        // swal({
        //     title: "Your test is complete click ok to sumbit.",
        //     text: '',

        //     buttons: true,
        // });
        // swal("Your test is complete click ok to sumbit.", "", "info");
        // alert("Your test is complete click ok to sumbit.")
        $("form").submit();
    } else {
        if ($('input[name='+ id +']').is(':checked')) {
            document.getElementById(id).className = 'hidden';
            id++;
            document.getElementById(id).className = '';
        } else {
            alert('Please select an option.');
        }
    }
}
</script>
@endsection
