var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML = myArr[0];
    }
};

function loadValues(){
    $.ajax({
        url: 'DataBaseJSON/BlogDataBase.json',
        dataType: 'json',
        type: 'get',
        cache: false,
        success: function(data){
            //console.log(data)
            $(data).each(function(index, value){
                //console.log(data)
                var record = "<tr>" +
                    "<td>"+value.Title+"</td>" +
                    "<td>"+value.Synopsis+"</td>" +
                    "<td>"+value.Comments+"</td>" +
                    "<td>"+value.Date+"</td>" +
                    //"<td><button type=\"button\" class=\"btn btn-primary\" id="+value.BlogID+" onclick=\"editBlog(this.id)\">Bearbeiten</button></td>" +
                    //"<td><button type=\"button\" class=\"btn btn-primary\" id="+value.BlogID+" onclick=\"deleBlog(this.id)\">Bearbeiten</button></td>" +

                    "<td><a href='editBlog.php?page="+value.BlogID+"'><button type=\"button\" id=\"btnEdit\" class=\"button btn btn-primary\" id="+value.BlogID+" >Bearbeiten</button></></a></td>" +
                    "<td>" +
                        "<button type=\"button\" id=\"btnDelete\" class=\"button btn btn-warning\" onclick=\"deleteBlog("+value.BlogID+")\" id="+value.BlogID+">" +
                        //"<button type=\"button\" id=\"btnDelete\" class=\"button btn btn-warning\" onclick='location.href=\"?deleteBlog="+value.BlogID+"\"' id="+value.BlogID+">" +
                        //onclick="location.href=?deleteBlog=\"+value.BlogID+\""
                            "Löschen" +
                        "</button>" +
                    "</td>" +
                    "</tr>";
                $("#blogTable").append(record);
            });
        }
    });
}

function deleteBlog(blogID){
    if (confirm("Blog wirklich löschen?"))
        location.href='?deleteBlog='+blogID;
}

