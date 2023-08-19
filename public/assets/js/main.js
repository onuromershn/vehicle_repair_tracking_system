$(document).ready(function(){
    $("#car_brand").change(function(){
        let id = $('#car_brand').val();
        let carBrandName= $("#car_brand :selected").text();
         $('#brandName').val(carBrandName);

        $("#car_model").html('');

        $.ajax({
            type: 'POST',
            url: '/vehicle/add',
            data: {
                id: id,
                type: 'getModel'
            },
            success: function(result){
                result.map((m) => $("#car_model").append(`<option value="${m['name']}">${m['name']}</option>`))
            },
            error: function(error){
                alert('error');
            },
        });
    });
});

$(".alert button.close").click(function (e) {
    $(this).parent().fadeOut('slow');
});