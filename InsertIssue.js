window.onload = function(){
    var requests = new XMLHttpRequest();

    const type_filed = "<option selected=true value='bug'>Bug</option>\
    <option value='proposal'>Proposal</option>\
    <option value='task'>Task</option>";

    const priority_filed = "<option value=minor'>Minor</option>\
    <option selected=true value=major'>Major</option>\
    <option value='critical'>Critical</option>";

    var form_title = document.getElementById("title");
    var form_description = document.getElementById("description");
    var form_type = document.getElementById("type");
    var form_priority = document.getElementById("priority");
    var options = document.getElementById("assigned_to");

    const submit = document.getElementById("submit");
    var responseArea = document.getElementById("response");

    function showSubStat(){
        requests.onreadystatechange = function() {
            if(requests.readyState == 4 && requests.status == 200) {
                responseArea.innerHTML = requests.responseText;
            }
        };
    }

    function loadOptions(){
        form_type.innerHTML = type_filed;
        form_priority.innerHTML = priority_filed;
        requests.onreadystatechange = function() {
            if(requests.readyState == 4 && requests.status == 200) {
                form_title.value = "";
                form_description.value = "";
                options.innerHTML = requests.responseText;
            }
        };
        input = "";  
    }

    requests.open('GET', "script/InsertIssue.php?query=", true);
    requests.send();
    loadOptions();

    submit.addEventListener('click', function(){
        requests.open('GET', "script/InsertIssue.php?query=click", true);
        requests.send();
        showSubStat();
        location.reload();
    })

}