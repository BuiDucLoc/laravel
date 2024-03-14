(function($){
    var Ht = {}
    var document = $(document);

    Ht.province = function(){
        $('.province').on('change',function(){
            let province_id = $('.province').find(":selected").val();
            $.ajax({
                url: 'ajax/location/getLocation',
                type: 'GET',  
                data: {
                    'province_id' : province_id,
                },
                dataType: 'json',
                success:function(res){
                    $('.disitricts').html(res.html)
                },
                error:function(jqXHR,textStatus, errorThrown){
                    console.log('loi');
                } 
              });
        });
    }
    document.ready(function(){
        Ht.province(); 
    });
})(jQuery)

