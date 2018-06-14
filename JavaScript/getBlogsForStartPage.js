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
                    "<td><form method='post'><input type='hidden' id='toBeDeleted' name='toBeDeleted' value='"+value.BlogID+"'><button type=\"button\" id=\"btnDelete\" class=\"button btn btn-warning\" id="+value.BlogID+" >Löschen</button></form></td>" +
                    "</tr>";
                $("#blogTable").append(record);
            });
        }
    });
}

function deleteBlog(clicked){
    $.ajax({
        url: 'DataBaseJSON/BlogDataBase.json',
        dataType: 'json',
        type: 'get',
        cache: false,
        success: function(data){
            var m, k;
            console.log(data);
            $.each(data, function(index, value){
                if (this.BlogID == clicked){
                    //var arrayID = clicked-1;
                    data.splice(1, 1);
                    //return false;
                }
                var notDeleted = "<tr>" +
                    "<td>"+data.length+"</td>" +
                    "<td>"+value.BlogID+"</td>" +
                    "<td>"+value.Title+"</td>" +
                    "</tr>";
                $("#otherTable").append(notDeleted);

            });//*/
            console.log(data);

        }
    });
}

function editBlog(clicked){

}