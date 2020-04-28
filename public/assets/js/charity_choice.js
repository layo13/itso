
$(document).ready(function() {
    /***************************************************************************/
    //Appel ajax form search listing
    $("#formContactCharity").change(function(){
        $("#imgAssociationShow").attr('src',$(this).find(':selected').attr('data-img'));
        return false;
    });
});