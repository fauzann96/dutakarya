<script>
function loadWuOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/option/working_unit')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--pilih unit kerja--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}

function loadPosOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/option/position')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option disabled>--pilih posisi--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}

function loadSimOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/option/driving_lisence')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--pilih SIM--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}

function loadEduOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/option/education/')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--pilih pendidikan--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}

function loadDivOption(selection,wu){
  var request = $.ajax({
      url: "<?=base_url('/option/division/')?>"+wu,
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--pilih divisi--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).attr('pos-group', field.group_position_seq).text(field.name));
    });
  });
}

function loadGenderOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/option/gender/')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--jenis kelamin--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  }); 
}

function loadMarritalOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/option/marrital/')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--status pernikahan--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}

function loadWuEmpOption(selection,wu){
    var request = $.ajax({
      url: "<?=base_url('/option/employee/wu/')?>"+wu,
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--karyawan--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name+' - '+field.npk));
    });
  });
}
function loadAreaOption(selection){
    var request = $.ajax({
      url: "<?=base_url('/option/area')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--area--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}

function loadCustAreaOption(selection){
    var request = $.ajax({
      url: "<?=base_url('/option/cust_area')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--area--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}


function loadDoTypeOption(selection){
  var request = $.ajax({
      url: "<?=base_url('/option/dayofftype')?>",
      type: 'GET',
      async: false,
      cache: false,
      timeout: 30000,
  });
  request.done(function(reply){
    selection.empty();
    selection.append('<option selected="true" disabled>--tipe libur--</option>');
    selection.prop('selectedIndex',0);
    $.each(reply,function(key,field){
      selection.append($('<option></option>').attr('value', field.id).text(field.name));
    });
  });
}
</script>