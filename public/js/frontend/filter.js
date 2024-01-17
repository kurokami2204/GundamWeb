$(document).ready(function(){
    $('#cat-1"]').on("keyup", function(){
        var value =$(this).val().toLowerCase();
        $("#category").filter(function(){
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
    

