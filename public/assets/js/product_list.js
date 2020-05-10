
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

    /**
     * FAVORIES
     */
    /**
     * ouverture modal avec info
     */
    $( "body" ).delegate( ".openModalFavorite", "click", function() {
        var productId = $(this).attr('data-productId');
        var userId = $(this).attr('data-userId');
        $.ajax({
            url: urlFavoriteListByUser,
            data: {product_id: productId, user_id: userId},
            /*on les envoie en POST*/
            type: 'POST',

            success: function(result){
                $('#LinkFavoriteProduct .modal-body').html(result);
                $('#LinkFavoriteProduct').modal();
            }
        });
        return false;
    });
    /**
     * validation formulaire d'ajout d'un produit en favorie
     */
    $( "body" ).delegate( ".validFavoriteCategorieProduct", "click", function() {
        var frmFavoriteName = $(".frmFavoriteProduct .frmFavoriteName").val();
        var frmFavoriteProductId = $(".frmFavoriteProduct .frmFavoriteProductId").val();
        var frmFavoriteCategorieId = $(".frmFavoriteProduct .frmFavoriteCategorieId").val();
        $.ajax({
            url: urlValidFavoriteCategorieProduct,
            data: {frmFavoriteName: frmFavoriteName,frmFavoriteProductId: frmFavoriteProductId,frmFavoriteCategorieId: frmFavoriteCategorieId},
            /*on les envoie en POST*/
            type: 'POST',
            success: function(info){
                console.log(info);
                return false;
            }
        });
        return false;
    });
    /**
     * validation formulaire création nouvelle catégorie et ajout d'un produit à celle ci
     */
    $( "body" ).delegate( ".validFavoriteCategorieProduct", "click", function() {
        var frmFavoriteCategoryName = $(".frmNewFavoriteProduct .frmFavoriteCategoryName").val();
        var frmFavoriteProductId = $(".frmNewFavoriteProduct .frmFavoriteProductId").val();
        var frmFavoriteUserId = $(".frmNewFavoriteProduct .frmFavoriteUserId").val();
        $.ajax({
            url: urlValidFavoriteProduct,
            data: {frmFavoriteCategoryName: frmFavoriteCategoryName,frmFavoriteProductId: frmFavoriteProductId,frmFavoriteUserId: frmFavoriteUserId},
            /*on les envoie en POST*/
            type: 'POST',

            success: function(info){
                console.log(info);
                return false;
            }
        });
        return false;
    });
});