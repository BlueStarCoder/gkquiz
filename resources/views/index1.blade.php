@extends('layouts.default')

@section('content')
<div>
    <h1 class="jumbotron">Test Your Knowledge:<span>GK Quiz</span></h1>
    <div class="intro active">
        <form action="/start" method="post">
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
                            <option>A</option>
                            <option>B</option>
                            <option>C</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Roll No.</td>
                    <td id='stroll'>
                        <select name="stroll" id="slroll" class="select form-control" disabled>
                            <option>Select Rollno.</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Student Name</td>
                    <td>
                        <input name="stname" id="stdname" class="form-control" type="text" value="Name" readonly/>
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
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$("#enter").click(function() {
    var stname = document.getElementById('stdname').value;
    var stclass = document.getElementById('stclass').value;
    var stsec = document.getElementById('stsec').value;
    var stroll = document.getElementById('slroll').value;
    if (stname === "Name" && stroll === "") {
        alert("Please Select Complete Details");
    } else {
        // '_token=<?php echo csrf_token(); ?>'
        var data = {'_token' : '<?php echo csrf_token(); ?>', 'stclass' : stclass, 'stsec' : stsec, 'stroll' : stroll }
        $.ajax({
            type: 'POST',
            url: '/startquizornot',
            data: data,
            success: function(response) {
                if (response === 1) {
                    alert("You have already played today.");
                } else {
                    $("form").submit();
                }
            }
        });
    }
});

function getNameOrRollNo(value = 'studname') {
    var stdname = document.getElementById('stdname');
    var data = {'_token' : '<?php echo csrf_token(); ?>', 'stclass': selectElems[0].value,'stsec': selectElems[1].value,'stroll': selectElems[2].value};
    $.ajax({
        type: 'POST',
        url: '/getstudrollno',
        data: data,
        success: function(response) {
            if (value === 'rollno') {
                stdname.value = 'Name';
                addChildsWithElement(JSON.parse(response));
            } else {
               stdname.value = JSON.parse(response).StudName;
            }
        }
    });
}

function removeChilds(element, len) {
    element.length = len;
}

addChildsWithElement = function(text) {

    var slroll = document.getElementById('slroll');
    removeChilds(slroll, 1);
    var optionElement = '';
    var optionTextElement = '';
    for (var i = 0; i < text.length; i++) {
        optionElement = document.createElement("option");
        optionTextElement = document.createTextNode(text[i].Rollno);
        optionElement.appendChild(optionTextElement);
        slroll.appendChild(optionElement);
    }
}

function selectElemReplay() {
    if (this.id === "stclass") {
        if (selectElems[1].value != 'Select Section') {
            getNameOrRollNo('rollno');
        } else if (this.value != 'Select Class') {
            selectElems[1].disabled = false;
        } 
    } else if (this.id ===  "stsec") {
        if (selectElems[0].value != 'Select Class' && selectElems[2].value != 'Select Rollno.') {
            getNameOrRollNo('rollno');
        } else if (this.value != 'Select Section') {
            selectElems[2].disabled = false;
            getNameOrRollNo('rollno');
        } 
    } else {
        getNameOrRollNo();
    }
    return false;
}

var selectElems = document.getElementsByTagName('select');

for (let i = 0; i < selectElems.length; i++) {
    selectElems[i].onchange = selectElemReplay;
}
</script>
@endsection
