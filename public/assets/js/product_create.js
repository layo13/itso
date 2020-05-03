
$(document).ready(function() {
    /***************************************************************************/
    //Appel ajax form search listing
    $(".formChoixChild").change(function(){
        console.log($(this));
        console.log($(this).val());
        $.ajax({
            url: urlChangeCategoryProduct,
            data: {parent_id: $(this).val()},
            /*on les envoie en POST*/
            type: 'POST',

            success: function(info){
                //console.log(info);
                //$('#loader').hide();
                $('#formChoixParentChildren').html(info);
            }
        });

        return false;
    });
    $("#formProductBrandId").change(function(){
        $("#brandPictureShow").attr('src',$(this).find(':selected').attr('data-img'));
        return false;
    });
    $("#formProductMainColorId").change(function(){
        $("#formProductColorDemo").attr('style', "color:"+$(this).find(':selected').attr('data-color'));
        return false;
    });
});