<script>
function customerKorlapOption(selection,customer_id){
  var request = $.ajax({
      url: "<?=base_url('/customer/korlap/option')?>",
      type: 'post',
      async: false,
      cache: false,
      timeout: 30000,
      data:{
        <?=csrf_token()?>: $('#<?=csrf_token()?>').val(),
        'customer_id' : customer_id,
      },
  });
  request.done(function(reply){
    $('#<?=csrf_token()?>').val(reply['new_csrf']);
    selection.empty();
    selection.append('<option selected="true" disabled>--korlap--</option>');
    selection.prop('selectedIndex',0);
    selection.append($('<option></option>').attr('value', 0).text("Tidak Ada Korlap"));
    $.each(reply.data,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name+' - '+field.nip));
    });
  });
}
</script>