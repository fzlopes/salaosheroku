var ComponentsTypeahead = function () {

    var handleTwitterTypeahead = function() {

        // $('#url_client').val() + '/list',

        var countries = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id', 'name', 'email'),
          // datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.name); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          limit: 10,
          prefetch: {
            url: 'http://localhost:8000/usuarios/list',
            filter: function(list) {
              return $.map(list, function(country) { return { id: country.id, name: country.name, email: country.email }; });
            }
            // , cache: false
          }
        });

        countries.initialize();
         
        if (App.isRTL()) {
          $('#busca_cliente').attr("dir", "rtl");
        }

        $('#busca_cliente').typeahead(null, {
          name: 'name',
          displayKey: 'name',
          hint: (App.isRTL() ? false : true),
          source: countries.ttAdapter()
        }).bind("typeahead:selected", function(obj, selected) {
            $('#selected_client').val(selected.id);
            window.location.replace($('#url_client').val() + '/' + selected.id);
        });

    }

    return {
        //main function to initiate the module
        init: function () {
            handleTwitterTypeahead();
        }
    };

}();

jQuery(document).ready(function() {
   ComponentsTypeahead.init();
    $('#btn_busca_cliente').on('click',function(e){
        if (!($('#selected_client').val() == '')) {
            window.location.replace($('#url_client').val() + '/' + $('#selected_client').val());
        }
        $('#busca_cliente').focus();
    });
});