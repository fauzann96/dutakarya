<script type="text/javascript">
function loadUtOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/option_sa/user_type')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--pilih tipe pengguna--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}

function loadEmployeeOption(selection){
    var request = $.ajax({
      method: "get",
      url: "<?= base_url('/option_sa/employee')?>",
      async: false,
      cache: false,
      timeout: 30000,
    });
    request.done(function( reply ) {
      if(reply['status'] == "success"){
        selection.empty();
        selection.append('<option selected="true" disabled>--pilih data karyawan bersangkutan--</option>');
        selection.prop('selectedIndex',0);
        $.each(reply["emp_option"], function(key, field){
          selection.append($('<option></option>').attr('value', field.id).attr('npk', field.npk).attr('name', field.name).text(field.name+'-'+field.npk));
        });
      }else{
        alert(reply["status"]+' : '+reply["message"]);
      }
    });
  request.fail(function( jqXHR, textStatus ) {
              alert( "Request failed: " + textStatus );
  });
}
</script>