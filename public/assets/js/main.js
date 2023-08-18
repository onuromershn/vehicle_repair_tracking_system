$(document).ready(function(){
    $("#car_brand").change(function(){
        let id = $('#car_brand').val();
        let carBrandName= $("#car_brand :selected").text();

        console.log(carBrandName);
        $("#car_model").html('');

        $.ajax({
            type: 'POST',
            url: '/vehicle/add',
            data: {
                id: id,
                type: 'getModel',
                carname: carBrandName
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