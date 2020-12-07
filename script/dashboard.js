window.onload=function(){
    let all=document.getElementsByClassName('all')
    let open=document.getElementsByClassName('open')
    let my_ticket=document.getElementsByClassName('my_tickets')
    let new_issue=document.getElementById('create')
    let request=new XMLHttpRequest()
    
    $(document).ready(function(){
        let starter=$('#sidebar ul li a')
        let container=$('.container') 
        starter.onclick=function(){
            let $this=$(this)
            target=$this.data('target')
            container.load(target + '.html')

            return false;

        }
    })

    
    new_issue.onclick=function(){
        
        location.href="http://localhost/info2180-finalproject/InserIssue.html"
    }
    all.onclick=function(){
        request.open("GET","dashboard.php",true)
        request.send()
        request.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var data = JSON.parse(this.responseText)
                console.log(data)
                var html=""
                for(var i =0;i<data.lenght;i++){
                    let id=data[i].id
                    let title=data[i].title
                    let type=data[i].type
                    let status=data[i].status
                    let assigned_to=data[i].assigned_to
                    let created=data[i].created

                    html+="<tr>"
                        html+="<td>"+id+" <a href='#'>"+title+"</a> </td>"
                        html+="<td>"+type+ "</td>"
                        html+="<td>"+status+ "</td>"
                        html+="<td>"+assigned_to+ "</td>"
                        html+="<td>"+created+ "</td>"
                    if(status=='Open'){
                        status.classList.add('statopen')
                    }
                    if(status=='closed'){
                        status.classList.add('statclosed')
                    }
                    if(status=='in progress'){
                        status.classList.add('statprogress')
                    }
                    

                }
                document.getElementById("issuesData").innerHTML=html



            }
        }

    }
    open.onclick=function(){
        request.open("GET","dashboard.php",true)
        request.send()
        request.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var data = JSON.parse(this.responseText)
                console.log(data)
                var html=""
                for(var i =0;i<data.lenght;i++){
                    let id=data[i].id
                    let title=data[i].title
                    let type=data[i].type
                    let status=data[i].status
                    let assigned_to=data[i].assigned_to
                    let created=data[i].created

                    html+="<tr>"
                        html+="<td>"+id+" <a href='#'>"+title+"</a> </td>"
                        html+="<td>"+type+ "</td>"
                        html+="<td>"+status+ "</td>"
                        html+="<td>"+assigned_to+ "</td>"
                        html+="<td>"+created+ "</td>"
                    if(status=='Open'){
                        status.classList.add('statopen')
                    }
                    
                }
                document.getElementById("issuesData").innerHTML=html
                
            }
        }

    }
    my_ticket.onclick=function(){

        request.open("GET","dashboard.php",true)
        request.send()
        request.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                var data = JSON.parse(this.responseText)
                console.log(data)
                var html=""
                for(var i =0;i<data.lenght;i++){
                    let id=data[i].id
                    let title=data[i].title
                    let type=data[i].type
                    let status=data[i].status
                    let assigned_to=data[i].assigned_to
                    let created=data[i].created

                    html+="<tr>"
                        html+="<td>"+id+" <a href='#'>"+title+"</a> </td>"
                        html+="<td>"+type+ "</td>"
                        html+="<td>"+status+ "</td>"
                        html+="<td>"+assigned_to+ "</td>"
                        html+="<td>"+created+ "</td>"

                    if(status=='Open'){
                        status.classList.add('statopen')
                    }
                    if(status=='closed'){
                        status.classList.add('statclosed')
                    }
                    if(status=='in progress'){
                        status.classList.add('statprogress')
                    }

                }
                document.getElementById("issuesData").innerHTML=html
                
            }
        }
    }

<<<<<<< HEAD
=======
    
>>>>>>> dashboard
    
    
}
