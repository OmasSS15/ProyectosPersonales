$(document).ready(function() {
    $("#select_modal").select2({
        dropdownParent: $('#modal_filter'),
        language: {
            noResults: function(){
                return "No hay resultado";
            }
        },
        theme: 'bootstrap-5',
        width: '100%'
    });

    $("#sucursal").select2({
        dropdownParent: $('#modal_filter'),
        language: {
            noResults: function(){
                return "No hay resultado";
            }
        },
        theme: 'bootstrap-5',
        width: '100%'
    });

    $("#estado_filter").select2({
        dropdownParent: $('#modal_filter'),
        language: {
            noResults: function(){
                return "No hay resultado";
            }
        },
        theme: 'bootstrap-5',
        width: '100%'
    });

    $("#clasificacion_file").select2({
        language: {
            noResults: function(){
                return "No hay resultado";
            }
        },
        theme: 'bootstrap-5',
        width: '100%'
    });

    $("#sucursal_file").select2({
        language: {
            noResults: function(){
                return "No hay resultado";
            }
        },
        theme: 'bootstrap-5',
        width: '100%'
    });

    $("#status").select2({
        language: {
            noResults: function(){
                return "No hay resultado";
            }
        },
        theme: 'bootstrap-5',
        width: '100%'
    });

    $("#select").select2({
        language: {
            noResults: function(){
                return "No hay resultado";
            }
        },
        theme: 'bootstrap-5',
        width: '100%'
    });
});
