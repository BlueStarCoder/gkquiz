function ajaxRequestForResponse(ajaxdata, ajaxurl, requestFunction, ajaxtype = 'POST') {
    $.ajax({
        type: ajaxtype,
        url: ajaxurl,
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
        data: ajaxdata,
        success: function(response) {
            requestFunction(JSON.parse(response));
        }
    });
}

$("#enter").on('click', function() {
    if (stdname.value === "Name" || stdname.value === "") {
        swal("Please Select Complete Details!", "", "warning");
        // alert("Please Select Complete Details");
    }
    else {
        var data = { 'stclass' : stclass.value, 'stsec' : stsec.value, 'stroll' : stroll.value };
        ajaxRequestForResponse(data, '/startquiz', function callback(returnData) {
            if (returnData === 1) {
                swal("You have already given the test today!", "", "info");
                // alert("You have already given the test today.");
            }
            else {
                swal("Please wait while the Questions load...", "", "success", {
                    timer: 1500,
                    showConfirmButton: false
                });
                $("form").submit();
            }
        });
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
    }
    if (btnaddupdate.value === "Add" && stsec.value !== "Select Section") {
          elementToCreateWithTextNode("option", stroll.children.length, stroll);
          stroll.selectedIndex = (stroll.length - 1);
          stdname.value = '';
    }
}

function getSection(stdclass) {
    var data = {'stclass': stdclass};
    ajaxRequestForResponse(data, '/getsection', function callback(returnData) {
        addChildsWithElement(returnData, 'stsec', 'Section');
        stdname.value = 'Name';
    });
}

function getRollNo(stdclass, stdsec) {
    var data = {'stclass': stdclass,'stsec': stdsec};
    ajaxRequestForResponse(data, '/getrollno', function callback(returnData) {
        addChildsWithElement(returnData, 'stroll', 'Rollno');
        stdname.value = 'Name';
    });
}

function getName(stdclass, stdsec, stdrollno) {
    var data = {'stclass': stdclass, 'stsec': stdsec, 'stroll': stdrollno};
    ajaxRequestForResponse(data, '/getname', function callback(returnData) {
        stdname.value = (returnData === null) ? '' : returnData['StudName'];
    });
}

$('select').change(function() {
    if (this.id === "stclass") {
        if (stsec.value != 'Select Section') {
            stroll.disabled = true;
            getRollNo(stclass.value, stsec.value);
            stroll.disabled = false;
            stdname.value = '';
        }
        else if (this.value != 'Select Class') {
            getSection(stclass.value);
            stsec.disabled = false;
        } 
    }
    else if (this.id === "stsec") {
        if (stclass.value != 'Select Class' && stroll.value != 'Select Rollno.') {
            stroll.disabled = true;
            getRollNo(stclass.value, stsec.value);
            stroll.disabled = false;
            stdname.value = '';
        }
        else if (this.value != 'Select Section') {
            if (stclass[0].value == 'Select Class') { stclass.children[0].remove(); }
            getRollNo(stclass.value, stsec.value);
            stroll.disabled = false;
        }
    }
    else if (this.id === "stroll") {
        getName(stclass.value, stsec.value, stroll.value);
    }
    else if (this.id === "updateoradd") {
      // stdname.value = '';
      (btnaddupdate.value === "Add") ? btnaddupdate.value = "Update" : btnaddupdate.value = "Add";
      getRollNo(stclass.value, stsec.value);
      stroll.disabled = false;
    }
    return false;
});