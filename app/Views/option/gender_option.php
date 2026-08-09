<script type="text/javascript">
function loadGenderOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/gender/option')?>",
      type: "POST",
      async: false,
      cache: false,
      timeout: 30000,
      data:{
        <?=csrf_token()?> : $('#<?=csrf_token()?>').val(),
      },
  });
  request.done(function(reply){
    $('#<?=csrf_token()?>').val(reply['new_csrf']);
    selection.empty();
    selection.append('<option selected="true" disabled>--jenis kelamin--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply.data,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  }); 
}
</script>