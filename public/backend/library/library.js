(function($){
    var HT = {}
    var token = $('meta[name="csrf-token"]').attr('content');
    HT.ham1 = function(){
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394' });
        });
    } 

    HT.select2 = function(){
        if($('.setupSelect2').length){
            $('.setupSelect2').select2();
        }
    }


    //xu ly nut on/of only one
    HT.changeStatus = () =>{
        if($('.status').length){
            $(document).on('change' , '.status', function(e){
                const option = {
                    'value' : $(this).val(),
                    'modelid' : $(this).data('modelid'),
                    'model' : $(this).data('model'),
                    'field' : $(this).data('feild'),
                    '_token' : token,
                }
                $.ajax({
                    url: 'ajax/dashboard/changeStatus',
                    type: 'POST',  
                    data: option,
                    dataType: 'json'    ,
                    success:function(res){
                        console.log(res);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                      }
                  });

            })  
        }
    }

    //xu ly check on chi bấm vào 1 ô vuông trên cùng sẽ chọn tất cả
    HT.checkall = () => {
        if($('#checkAll').length){
            $(document).on('click', '#checkAll', function(){
                let isChecked = $(this).prop('checked');
                $('.checkBoxItem').prop('checked', isChecked);
                $('.checkBoxItem').each(function(){
                    let _this = $(this);
                    HT.changeBackground(_this);
                });
            });
        }
    }


    //xu ly check on 1 phần tử
    HT.checkboxitem = () => {
        if($('.checkBoxItem').length){
            $(document).on('click', '.checkBoxItem', function(){
                let _this = $(this);
                HT.changeBackground(_this);
                HT.allChecked();
            });
        }
    }

    HT.changeBackground = (obj) => {
        let isChecked = obj.prop('checked');
        if(isChecked){
            obj.closest('tr').addClass('active-bg');
        }else{
            obj.closest('tr').removeClass('active-bg');
        }
    }

    HT.allChecked = () => {
        let allChecked = $('.checkBoxItem:checked').length === $('.checkBoxItem').length;
        $('#checkAll').prop('checked', allChecked);
    }


    //xuly check taon bo nut on / of
    HT.changeStatusall = () => {
        if($('.ChangeStatusAll').length){
            $(document).on('click' , '.ChangeStatusAll', function(e){
                let id = [];
                $('.checkBoxItem').each(function(){
                    let _this = $(this);
                    let isChecked = _this.prop('checked');
                    if(isChecked){
                        id.push(_this.val());
                    }
                });
                const option = {
                    'value' : $(this).data('value'),
                    'modelid' : id,
                    'model' : $(this).data('model'),
                    'field' : $(this).data('feild'),
                    '_token' : token,
                }

                $.ajax({
                    url: 'ajax/dashboard/changeStatusAll',
                    type: 'POST',  
                    data: option,
                    dataType: 'json'    ,
                    success:function(res){
                        if(res.flag==true){
                            let activecss1 = 'background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;';
                            let activecss2 = 'left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;';
                            if(option.value==1){
                                for (let i = 0; i < id.length; i++) {
                                    $('.js-switch-'+id[i]).find('span.switchery').attr('style', activecss1);
                                    $('.js-switch-'+id[i]).find('small').attr('style', activecss2);
                                }
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                      }
                  });
            })  
        }
    }


    $(document).ready(function(){
        HT.ham1(); 
        HT.select2();
        HT.changeStatus();
        HT.changeStatusall();
        HT.checkall();
        HT.checkboxitem();
    });
})(jQuery)
    

