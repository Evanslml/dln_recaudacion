
      var $ = jQuery.noConflict();
      $(function () {

        /*date time*/
        /*var d = new Date();
        var month = d.getMonth();
        var day = d.getDate();
        var year = d.getFullYear();

        $('#startdatetime-from').datetimepicker({
            language: 'en',
            format: 'yyyy-MM-dd hh:mm'
        });
        $("#startdatetime-from").data('DateTimePicker').setLocalDate(new Date(year, month, day, 00, 01));
        */
        
        /*
          $('#datetimepicker1').datetimepicker({
            format: "L"
          });
        */

        $("#datepicker").datepicker({ 
          autoclose: true, 
          todayHighlight: true,
          format: 'dd-mm-yyyy'
        }).datepicker('update', new Date());


        /*format price*/
          $('.type-price').priceFormat({
              prefix: 'S/. ',
              centsSeparator: '.',
              thousandsSeparator: ','
          });

        /*input onlynumber*/
          $("#table_recaudacion tbody input, .onlynumber").keypress(function (e) {
           if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
          }
          });

        /*disable*/
          var celdas_disable_1='.celdas_disable';
          var celdas_disable_2='.celdas_disable-2';
          $(celdas_disable_1).prop('disabled', true).addClass('disable-1-css');
          $(celdas_disable_2).prop('disabled', true).addClass('disable-2-css');

          $('.filterable .btn-filter').click(function(){
              var $panel = $(this).parents('.filterable'),
              $filters = $panel.find('.filters input'),
              $tbody = $panel.find('.table tbody');
              if ($filters.prop('disabled') == true) {
                  $filters.prop('disabled', false);
                  $filters.first().focus();
              } else {
                  $filters.val('').prop('disabled', true);
                  $tbody.find('.no-result').remove();
                  $tbody.find('tr').show();
              }
          });

          $('.filterable .filters input').keyup(function(e){
              /* Ignore tab key */
              var code = e.keyCode || e.which;
              if (code == '9') return;
              /* Useful DOM data and selectors */
              var $input = $(this),
              inputContent = $input.val().toLowerCase(),
              $panel = $input.parents('.filterable'),
              column = $panel.find('.filters th').index($input.parents('th')),
              $table = $panel.find('.table'),
              $rows = $table.find('tbody tr');
              /* Dirtiest filter function ever ;) */
              var $filteredRows = $rows.filter(function(){
                  var value = $(this).find('td').eq(column).text().toLowerCase();
                  return value.indexOf(inputContent) === -1;
              });
              /* Clean previous no-result if exist */
              $table.find('tbody .no-result').remove();
              /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
              $rows.show();
              $filteredRows.hide();
              /* Prepend no-result row if all rows are filtered */
              if ($filteredRows.length === $rows.length) {
                  $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
              }
          });

        /*save*/

        function save_recaudacion(){
          var variable = $('#monto-2').unmask();
          var variable1 = $('#datepicker input').val();
          alert(variable1);
        }


          $(".btn-save").click(function() {
              save_recaudacion();
          });

      });