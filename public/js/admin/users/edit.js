$(function() {

    $('#select-requirement').on('change', onSelectRequirementChange);


});


function  onSelectRequirementChange() {
    var requirement_id  = $(this).val();
    
    if (!requirement_id)
    {
        $('#select-level').html('<option value="">Seleccione Nivel</option>');
        return;
    }

    //AJAX
    $.get('/api/requerimiento/'+requirement_id+'/niveles', function (data) {
        var html_select = '<option value="">Seleccione Nivel</option>'
        for (var i=0; i<data.length; ++i)
            html_select += '<option value="'+data[i].id+'">'+data[i].name+'</option>'
        $('#select-level').html(html_select);

    });
}