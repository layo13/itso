
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
                $('#formChoixParentCategory').html();

            }
        });

        return false;
    });
});