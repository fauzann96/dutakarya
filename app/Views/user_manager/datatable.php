<table id="data_table" style="width: 100%;" class="table table-sm table-bordered table-striped display compact">
                    
</table>

<?= $this->section('on_document_ready_script') ?>
    loadTableData();
<?= $this->endSection() ?>

<?= $this->section('page_script') ?>
    <script type="text/javascript">
        var table;
        function loadTableData(){
        table = $("#data_table").DataTable({
        dom: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip',

        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        pageLength: 25,

        ajax:{
            url:"<?=base_url('/api/user_manager/datatable')?>",
            type:"post",
            data: function(d) {
                    d['<?= csrf_token() ?>'] = $('input[name="<?= csrf_token() ?>"]').val();
                },
            dataSrc : function ( json ) {
                    $("#<?= csrf_token()?>").val(json.new_csrf);
                    return json.data;
            },
            "destroy" : true,
            },
        order: [[2, 'asc']],
        columnDefs: [
            {
              targets: [-1,0,2,3,4], 
              className: 'text-center'
            },
            {
              targets: '_all', 
              className: 'align-middle'
            },
        ],
        columns: [
            /*{ data: 'npk',type:'text',title:'NPK', "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                $(nTd).html("<a href='tel:"+oData.npk+"'>"+oData.npk+"</a>");
            }},*/
            {data: null, orderable: false,title:'#'},
            {data: 'username', name: 'username', searchable: true, orderable: true, type:'text',title:'Username'},
            {data: 'name', name: 'name', searchable: true, orderable: true, type:'text',title:'Nama'},
            {data: 'user_type',name: 'user_type_seq',type:'text',title:'Tipe'},
            { data: "status",name:"status",
            render:function(data,type,row) {
              var button_data = `data-id="${row['id']}"`;
              var html = `
                <div id="statusBtn-${row['id']}" class="dropdown">
                  <button class="btn btn-sm btn-success dropdown-toggle rounded-pill px-3 shadow-sm d-inline-flex align-items-center gap-2" 
                          type="button" 
                          data-bs-toggle="dropdown" 
                          aria-expanded="false">
                    <span class="status-label">${data}</span>
                  </button>
                  <ul  class="dropdown-menu shadow">
                    <li><h6 class="dropdown-header">Ubah Status</h6></li>
                    <li>
                      <button class="dropdown-item d-flex align-items-center gap-2 btn-change-status" type="button" ${button_data} data-status="Loading">
                        <span class="badge bg-warning text-dark rounded-circle p-1"></span> Memuat
                      </button>
                    </li>
                    <li>
                      <button class="dropdown-item d-flex align-items-center gap-2 btn-change-status" type="button" ${button_data} data-status="On The Way">
                        <span class="badge bg-info rounded-circle p-1"></span> Terkirim
                      </button>
                    </li>
                    <li>
                      <button class="dropdown-item d-flex align-items-center gap-2 btn-change-status" type="button" ${button_data} data-status="Arrived">
                        <span class="badge bg-success rounded-circle p-1"></span> Selesai
                      </button>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                      <button class="dropdown-item d-flex align-items-center gap-2 text-danger" type="button">
                        <span class="badge bg-danger rounded-circle p-1"></span> Batal
                      </button>
                    </li>
                  </ul>
                </div>`
              return html;
            }
          },
            {data: null,title:'Action',orderable: false,searchable: false,
            defaultContent: '<div class="btn-group"><button type="button" id="edit" class="btn btn-info btn-xs"><i class="fas fa-edit"></i> Edit</button><button type="button" id="reset" class="btn btn-warning btn-xs"><i class="fas fa-key"></i> Reset password</button></div>',
            targets: -1},
        ],
        responsive: true,
        lengthChange: false, 
        autoWidth: false,
        buttons: [{
                        text: '<i class="fas fa-plus"></i> Pengguna Baru',
                        className: 'btn-success btn-sm',
                        action: function (e, dt, node, config) {   
                        $('#modal-new').modal('show');
                        loadUserTypeOption($('#new_user_type'));
                        }
                    }],
        });
        table.on('draw.dt', function () {
            let info = table.page.info();
            let startNumber = info.start + 1; // Mendapatkan nomor awal di halaman tersebut

            table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = startNumber + i;
            });
        });
        table.on('click', '#edit', function (e) {
        var data = table.row(this).data();
        if(data==null){
            data = table.row(e.target.closest('tr')).data();
        }
        loadUserTypeOption($('#edit_user_type'));
        $('#edit_user_type').val(data['user_type_seq']);
        $('#edit_username').val(data['username']);
        $('#edit_name').val(data['name']);
        $('#edit_id').val(data['id']);
        $('#modal-edit').modal('show');
        });
        table.on('click', '#reset', function (e) {
        var data = table.row(this).data();
        if(data==null){
            data = table.row(e.target.closest('tr')).data();
        }
            // body...
        $('#reset_id').val(data['id']);
        $( "#reset_password_head" ).text('Reset Password ('+data['name']+')');
        $('#modal-reset-password').modal('show');
        });
        table.on('click', '#status', function (e) {
        var data = table.row(this).data();
        if(data==null){
            data = table.row(e.target.closest('tr')).data();
        }
        var form_data = new FormData();
        form_data.append('id',data['id']);
        if(data['status'] == 1){
            form_data.append('set_to',0);
        }else{
            form_data.append('set_to',1);
        }
        var request = $.ajax({
                url: '<?=base_url('/user_manager/toggle_status')?>',
                type: 'POST',
                contentType: false,
                processData: false,  // Important!
                async: false,
                cache: false,
                timeout: 30000,
                data : form_data,
                dataType: 'json',
            });
        
        request.done(function( reply ) {
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1 ){
            toastr.success('Status berhasil diubah');
            table.ajax.reload();
            }else{
            toastr.error('Status gagal diubah');
            }
        });
        });
        }
    </script> 
<?= $this->endSection() ?>