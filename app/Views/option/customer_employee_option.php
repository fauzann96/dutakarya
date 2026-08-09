<script>
function loadcustomerEmployeeOption(selection,customer_id){
  var request = $.ajax({
      url: "<?=base_url('/customer/employee/option')?>",
      type: 'post',
      async: false,
      cache: false,
      timeout: 30000,
      data:{
        <?=csrf_token()?>: $('#<?=csrf_token()?>').val(),
        'customer_id' : customer_id,
        'is_resigned' : 0,
      },
  });
  request.done(function(reply){
    $('#<?=csrf_token()?>').val(reply['new_csrf']);
    selection.empty();
    selection.append('<option selected="true" disabled>--tad--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply.data,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name+' - '+field.nip));
    });
  });
}
function loadAttendanceCustomerEmployeeOption(selection,customer_id){
  var request = $.ajax({
      url: "<?=base_url('/customer/employee/option')?>",
      type: 'post',
      async: false,
      cache: false,
      timeout: 30000,
      data:{
        <?=csrf_token()?>: $('#<?=csrf_token()?>').val(),
        'customer_id' : customer_id,
        'is_resigned' : 0,
      },
  });
  request.done(function(reply){
    $('#<?=csrf_token()?>').val(reply['new_csrf']);
    selection.empty();
    selection.append('<option value=0 selected="true">--all--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply.data,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name+' - '+field.nip));
    });
  });
}
</script>