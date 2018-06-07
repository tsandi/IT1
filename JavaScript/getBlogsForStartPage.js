var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML = myArr[0];
    }
};
xmlhttp.open("GET", "DataBaseJSON/BlogDataBase.JSON", true);
xmlhttp.send();
$(document).ready(function(){
    $.ajax({
        url: "DataBaseJSON/BlogDataBase.JSON",
        dataTyp: "JSON",
        success:function(data){
            $(data.Blogs).each(function(index, value){
                var record = "<h2>"+value.Title+"</h2>"+
                    "<p>"+value.Synopsis+"</p>"
                +"<br/>";
            });
        }
    });
});