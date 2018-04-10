function ajaxPostRequest(postData, postUrl, editElementID = 'studname', responseObjectKey = 'StudName') {
    $.ajax({
        type: 'POST',
        url: '/' + postUrl,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: postData,
        success: function(response) {  
          if (editElementID === 'stsec' || editElementID === 'stroll') {
            // stdname.value = 'Name';
            addChildsWithElement(JSON.parse(response), editElementID, responseObjectKey);
          } else {
            stdname.value = (JSON.parse(response) === null) ? '' : JSON.parse(response)[responseObjectKey];
          }
        }
    });
}

$("#enter").on('click', function() {
    if (stdname.value === "Name" || stdname.value === "") {
        swal("Please Select Complete Details!", "", "warning");
        // alert("Please Select Complete Details");
    } else {
        var data = { 'stclass' : stclass.value, 'stsec' : stsec.value, 'stroll' : stroll.value };
        $.ajax({
        type: 'POST',
        url: '/startquiz',
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: data,
        success: function(response) {
            if (JSON.parse(response) === 1) {
                swal("You have already given the test today!", "", "info");
                // alert("You have already given the test today.");
            } else {
                swal("Please wait while the Questions load...", "", "success",{
                    timer: 1500,
                    showConfirmButton: false
                });
                $("form").submit();
            }
        }});
    }
});

function removeChilds(element, len) {
    element.length = len;
}

function elementToCreateWithTextNode(elementNameToCreate, textdata, elementToAppend) {
  ElementToCreate = document.createElement(elementNameToCreate);
  TextOfElement = document.createTextNode(textdata);
  ElementToCreate.appendChild(TextOfElement);
  elementToAppend.appendChild(ElementToCreate);
}

addChildsWithElement = function(text, elementID, objectKey) {
    var element = document.getElementById(elementID);
    removeChilds(element, 1);
    var optionElement = '';
    var optionTextElement = '';
    for (var i = 0; i < text.length; i++) {
      elementToCreateWithTextNode("option", text[i][objectKey], element);
    } if (btnaddupdate.value === "Add" && stsec.value !== "Select Section") {
          elementToCreateWithTextNode("option", stroll.children.length, stroll);
          stroll.selectedIndex = (stroll.length - 1);
          stdname.value = '';
    }
}

function getSection(stdclass) {
    var data = {'stclass': stdclass};
    ajaxPostRequest(data, 'getsection', 'stsec', 'Section');
}

function getRollNo(stdclass, stdsec) {
    var data = {'stclass': stdclass,'stsec': stdsec};
    ajaxPostRequest(data, 'getrollno', 'stroll', 'Rollno');
}

function getName(stdclass, stdsec, stdrollno) {
    var data = {'stclass': stdclass, 'stsec': stdsec, 'stroll': stdrollno};
    ajaxPostRequest(data, 'getname');
}

$('select').change(function() {
    if (this.id === "stclass") {
        if (stsec.value != 'Select Section') {
            getRollNo(stclass.value, stsec.value);
            stdname.value = '';
        } else if (this.value != 'Select Class') {
            getSection(stclass.value);
            stsec.disabled = false;
        } 
    } else if (this.id === "stsec") {
        if (stclass.value != 'Select Class' && stroll.value != 'Select Rollno.') {
            getRollNo(stclass.value, stsec.value);
            stdname.value = '';
        } else if (this.value != 'Select Section') {
            stclass.children[0].remove();
            getRollNo(stclass.value, stsec.value);
            stroll.disabled = false;
        }
    } else if (this.id === "stroll") {
        getName(stclass.value, stsec.value, stroll.value);
    } else if (this.id === "updateoradd") {
      // stdname.value = '';
      (btnaddupdate.value === "Add") ? btnaddupdate.value = "Update" : btnaddupdate.value = "Add";
      getRollNo(stclass.value, stsec.value);
      stroll.disabled = false;
    }
    return false;
});