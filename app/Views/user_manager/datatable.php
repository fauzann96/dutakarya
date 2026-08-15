<table id="data_table" style="width: 100%;" class="table table-sm table-bordered table-striped display compact">
                    
</table>

<?= $this->section('on_document_ready_script') ?>
    loadTableData();
<?= $this->endSection() ?>

<?= $this->section('page_script') ?>
  <?=$this->include('user_manager/change_status');?>
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
            responsive: true,
            lengthChange: false, 
            autoWidth: false,

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
            columnDefs: [
                {
                targets: [-1,0,2,3,4], 
                className: 'text-center'
                },
                {
                targets: '_all', 
                createdCell: function (td) {
                    $(td).addClass('align-middle');
                }
                },
            ],
            columns: [
                /*{ data: 'npk',type:'text',title:'NPK', "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='tel:"+oData.npk+"'>"+oData.npk+"</a>");
                }},*/
                {data: null, orderable: false,title:'#'},
                {data: 'username', name: 'username', searchable: true, orderable: true, type:'text',title:'Username'},
                {data: 'name', name: 'name', searchable: true, orderable: true, type:'text',title:'Nama'},
                {data: 'type_name',name: 'type.name',type:'text',title:'Tipe',searchable: false, orderable: false},
                {data: "status",name:"status", title:"Status", orderable: false, searchable: false,
                render:function(data,type,row) {
                var button_view = `<button type="button" class="btn btn-success btn-sm">Aktif</button>`;
                var btn_action = `<button class="dropdown-item" id="status" onclick="changeStatus(${row.id}, 0)">Nonaktifkan</button>`;
                if(data == 0){
                    btn_action = `<button class="dropdown-item" id="status" onclick="changeStatus(${row.id}, 1)">Aktifkan</button>`;
                    button_view = `<button type="button" class="btn btn-danger btn-sm">Nonaktif</button>`;
                }
                var html = `
                    <div class="btn-group">
                        ${button_view}
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                        ${btn_action}
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" href="#" onclick="showEditModal(${row.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="dropdown-item" href="#" onclick="resetPassword(${row.id}, '${row.name}')">
                            <i class="fas fa-key"></i> Reset password
                        </button>
                        </div>
                    </div>`;
                return html;
                }
            },
            ],
 
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
        }
    </script> 
<?= $this->endSection() ?>