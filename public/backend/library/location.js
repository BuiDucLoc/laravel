(function($){
    var HT = {}

    HT.localtion = () => {
        $(document).on('change' ,'.localtion',function(){
            let _this = $(this);
            let option = {
                data : {
                    'localtion_id' : _this.val(),
                },
                'target' : _this.attr('data-target'),
            }
            HT.sendatalocaltion(option)
        });
    }

    HT.sendatalocaltion = (option) => {
        $.ajax({
            url: 'ajax/location/getLocation',
            type: 'GET',  
            data: option,
            dataType: 'json',
            success:function(res){
                $('.'+option.target).html(res.html)

                if(disitrct_id != '' && option.target=='districts'){
                  $('.districts').val(disitrct_id).trigger('change');
                }

                if(ward_id != '' && option.target=='wards'){
                    $('.wards').val(ward_id).trigger('change');
                  }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
              }
          });
    }

    HT.locaCity = () => {
        if(provnce_id != ''){
            //gán giá trị cho ô đó trồi bát sự kieenj chage để chạy hàm trên kia với giá trị gán vào
          $('.province').val(provnce_id).trigger('change');

        }
    }

    $(document).ready(function(){
        HT.localtion(); 
        HT.locaCity();
    });
})(jQuery)

