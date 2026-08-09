var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[2];
function loadWuOption(selection){
  var request = $.ajax({
      url: '/option/working_unit',
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
      url: window.location.origin+'/option/position',
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
      url: window.location.origin+'/option/driving_lisence',
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
      url: window.location.origin+'/option/education/',
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
    let url= window.location.origin+'/option/division/'+wu;
    $.get(url, function(data, status){
      selection.empty();
      selection.append('<option selected="true" disabled>--pilih divisi--</option>');
      selection.prop('selectedIndex',0);
      $.each( data, function( key, field ) {
        selection.append($('<option></option>').attr('value', field.id).attr('pos-group', field.group_position_seq).text(field.name));
      });
    });
}

function loadGenderOption(selection){
    let url= window.location.origin+'/option/gender/';
    selection.empty();
    selection.append('<option selected="true" disabled>--jenis kelamin--</option>');
    selection.prop('selectedIndex',0);
    var dfrd = $.Deferred();
    setTimeout(function(){
        // doing async stuff
          $.getJSON(url, function(result){
          $.each(result, function(key, field){
            selection.append($('<option></option>').attr('value', field.id).text(field.name));
          });
        });
        dfrd.resolve();
    }, 0);
    return dfrd.promise(); 
}

function loadMarritalOption(selection){
  var request = $.ajax({
      url: window.location.origin+'/option/marrital/',
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
      url: window.location.origin+'/option/employee/wu/'+wu,
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
