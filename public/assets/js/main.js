$(document).ready(function(){
    $("#car_brand").change(function(){
        let id = $('#car_brand').val();
        $("#car_model").html('');

        $.ajax({
            type: 'POST',
            url: '/vehicle/add',
            data: {
                id: id,
                type: 'getModel'
            },
            success: function(result){
                result.map((m) => $("#car_model").append(`<option value="${m['id']}">${m['name']}</option>`))
            },
            error: function(error){
                alert('error');
            },
        });
    });

});