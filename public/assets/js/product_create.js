
$(window).on('load', function() {
    if($(".formChoixChild").val().length>0){
        $.ajax({
            url: urlChangeCategoryProduct,
            data: {parent_id: $(".formChoixChild").val(),selected_value: $("#formProductCategorySelected").val()},
            /*on les envoie en POST*/
            type: 'POST',

            success: function(info){
                $('#formChoixParentChildren').html(info);
            }
        });
        return false;
    }
});

$(document).ready(function() {
    /***************************************************************************/
    //Appel ajax form search listing
    $(".formChoixChild").change(function(){
        $.ajax({
            url: urlChangeCategoryProduct,
            data: {parent_id: $(this).val()},
            type: 'POST',
            success: function(info){
                $('#formChoixParentChildren').html(info);
            }
        });
        return false;
    });
    /**
     * gestion des marques
     */
    $("#formProductBrandId").change(function(){
        $("#brandPictureShow").attr('src',$(this).find(':selected').attr('data-img'));
        return false;
    });
    /**
     * gestion des couleur
     */
    $("#formProductMainColorId").change(function(){
        $("#formProductColorDemo").attr('style', "color:"+$(this).find(':selected').attr('data-color'));
        return false;
    });

    /**
     * gestion des liens
     */
    $( "body" ).delegate( ".delete-linkRowBloc", "click", function() {
        $(this).parent().parent().remove();
        return false;
    });
    $( "body" ).delegate( ".new-linkRowBloc", "click", function() {
        var html = '<div class="row linkRowBloc">';
        html += '<div class="col-9">';
            html += '<input class="form-control" type="text" name="formProductLink[]">';
        html += '</div>';
        html += '<div class="col-3">';
        html += '<a href="#" class="btn btn-brand btn-sm btn-upper delete-linkRowBloc" title="Supprimer ce lien"><i class="fa fa-trash"></i></a>';
        html += '<a href="#" class="btn btn-success btn-sm btn-upper new-linkRowBloc"  title="Ajouter un lien"><i class="fa fa-plus"></i></a>';
        html += '</div>';
        html += '</div>';
        $(html).insertAfter($('.linkRowBloc:last-child'));
        return false;
    });
});