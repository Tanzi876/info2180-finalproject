window.onload = function(){
    var requests = new XMLHttpRequest();
    //const submit = document.getElementById("submit");
    //const responseArea = document.getElementById("response");
    var options;

    function loadOptions(){
        requests.onreadystatechange = function() {
            if(requests.readyState == 4 && requests.status == 200) {
                options = document.getElementById("assigned_to");
                options.innerHTML = requests.responseText;
                //console.log(requests.responseText);
            }
        };
            
    }
    requests.open('POST', 'script/InsertIssue.php?', true);
    requests.send("query=''");
    loadOptions();

}