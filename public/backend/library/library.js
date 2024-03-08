(function($){
    var Ht = {}
    var document = $(document);
    Ht.ham1 = function(){
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394' });
        });
    } 
    document.ready(function(){
        Ht.ham1(); 
    });
})(jQuery)
    

