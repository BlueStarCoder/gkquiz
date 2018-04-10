@extends('layouts.default')

@section('FirstHeader')
    User Management | Edit
@endsection

@section('content')
<form action = "/Edit/<?php echo $questions[0]->id; ?>" method = "post">
 <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
 <table class="table table-bordered">
    <tr>
       <td>Class</td>
       <td>
          <input type = 'text' name = 'class_text' 
             value = '<?php echo$questions[0]->Class; ?>'/>
       </td>
    </tr>
    <tr>
       <td>Question</td>
       <td>
            <textarea rows=6 cols=45 name="question_text"><?php echo$questions[0]->Question; ?></textarea>
       </td>
    </tr>
    <tr>
       <td>Right</td>
       <td>
           <textarea rows=2 cols=21 name="right_text"><?php echo$questions[0]->right; ?></textarea>
       </td>
    </tr>
       <tr>
           <td>Wrong 1</td>
           <td>
                <textarea rows=2 cols=21 name="wrong1_text"><?php echo$questions[0]->wrong1; ?></textarea>
           </td>
       </tr>
       <tr>
           <td>Wrong 2</td>
           <td>
                <textarea rows=2 cols=21 name="wrong2_text"><?php echo$questions[0]->wrong2; ?></textarea>
           </td>
       </tr>
       <tr>
           <td>Wrong 3</td>
           <td>
                <textarea rows=2 cols=21 name="wrong3_text"><?php echo$questions[0]->wrong3; ?></textarea>
           </td>
       </tr>
       <tr>
           <td>Marks</td>
           <td>
              <input type = 'text' name = 'marks_text' 
                 value = '<?php echo$questions[0]->marks; ?>'/>
           </td>
       </tr>
    <tr>
       <td colspan = '2'>
          <input type = 'submit' value = "Update Question" />
       </td>
    </tr>
 </table>
</form>
@endsection
