window.onclick = function(){
    var requests = new XMLHttpRequest();
    const submit = document.getElementById("submit");
    const responseArea = document.getElementById("response");
    const options = document.getElementById("assigned_to");

    function loadOptions(){
        requests.onreadystatechange = function() {
            if(requests.readyState == 4 && requests.status == 200) {
                options.innerHTML = requests.responseText;
            }
        };       
    }
    requests.open('POST', 'script/InsertIssue.php?', true);
    requests.send('query=""');
    //loadOptions(); 

}