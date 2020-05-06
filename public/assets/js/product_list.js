
$(document).ready(function() {
    /***************************************************************************/
    //Appel ajax form search listing
    $(".changePublishProduct").click(function(){
        var productId = $(this).attr('data-productId');
        var active = $(this).attr('data-active');
        console.log(productId);
        console.log(active);
        $.ajax({
            url: urlChangePublishProduct,
            data: {productId: productId,active: active},
            /*on les envoie en POST*/
            type: 'POST',

            success: function(info){
                console.log(info);
                if(info == 1){
                    window.location.replace(urlReloadList);
                }
            }
        });
        return false;
    });
});