$(document).ready(function(){
    $('body').delegate('.province', 'click',function (){
        var id = $(this).val(); 
        $.ajax({
            url:'customer/city',
            type:'POST',
            dataType:'json',
            data : {
                'id':id
            },
            success: function(response)
            {
                if(response.status = 'ok')
                {
                    $('#city').html("");
                        $.each(response.data, function(i, data){
                        {
                            $('#city').append('<option value="'+data.id+'">'+data.type+' '+data.name+'</option>');
                        }
                    });
                }                        
            }
        });
    });

    $(".city").change(function (){
        var id = $(this).val();
        $.ajax({
            url:'customer/region',
            type:'POST',
            dataType:'json',
            data : {
                'id':id
            },
            success: function(response)
            {
                if(response.status = 'ok')
                {
                    $('#region').html("");
                        $.each(response.data, function(i, data){
                        {
                            $('#region').append('<option value="'+data.id+'">'+data.name+'</option>');
                        }
                    });
                }                        
            }
        });
    });

    $(".region").change(function (){
        var id = $(this).val();
        $.ajax({
            url:'customer/price',
            type:'GET',
            dataType:'json',
            data : {
                'id':id
            },
            success: function(response)
            {
                if(response.status = 'ok')
                {
                    var div = $(document.createElement('div')).attr("id", 'div');
                    div.after()
                    .html('<span>Coba</span>');
                    div.appendTo("#price");
                }                        
            }
        });
    });

    $('body').delegate('.ship', 'click',function (){
        var id = $(this).val();
        $('#address').empty(); 
        $.ajax({
            url:'customer/shipping',
            type:'POST',
            dataType:'json',
            data : {
                'id':id
            },
            success: function(response)
            {
                if(response.status = 'ok')
                {
                    $('#address').append(response.data.address+ ' ' +response.data.region+ ' ' +response.data.city+ ' ' +response.data.province+ ' ' +response.data.postal_code);
                }                        
            }
        });
    });
})