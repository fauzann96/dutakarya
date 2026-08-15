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
            dom: '<\'row mb-3\'<\'col-md-6\'B><\'col-md-6 d-flex justify-content-end align-items-center\'fl>>' +
    '<\'row\'<\'col-md-12\'tr>>' +
    '<\'row mt-3\'<\'col-md-5\'i><\'col-md-7 d-flex justify-content-end\'p>>',
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            pageLength: 25,
            responsive: true,
            lengthChange: true, 
            autoWidth: false,

            columnDefs: [
                {
                targets: [-1,0,3,4], 
                className: 'text-center'
                },
                {
                targets: '_all', 
                createdCell: function (td) {
                    $(td).addClass('align-middle');
                }
                },
            ],

            ajax:{
                url:'<?=base_url('/api/calendar_manager/datatable')?>',
                type:"post",
                data: function(d) {
                    d['<?= csrf_token() ?>'] = $('input[name="<?= csrf_token() ?>"]').val();
                    d['filter_type'] = $('#filter_type').val();
                    d['filter_input'] = $('#filter_input').val();
                    d['filter_selection'] = $('#filter_selection').val();
                },
                dataSrc : function ( json ) {
                        //Make your callback here.
                        $("#<?= csrf_token()?>").val(json.new_csrf);
                        return json.data;
                },
                "destroy" : true,
            },
    
            columns: [
                {data: null, orderable: false,title:'#'},
                { data: 'name',name:'name',type:'text',title:'Nama'},
                { data: 'date',name:'date',title:'Tanggal',type:'text',
                    render : function ( data, type, row ) {
                    return `${formatDateIndonesia(data)}`;
                    },
                },
                { data: 'tp_name',name:'type',type:'text',title:'Tipe'},
                { data: 'date',
                render : function ( data, type, row ) {
                    return `<div class="btn-group" role="group">${deleteButton('showDeleteModal('+row.id+')')}${editButton('showEditModal('+row.id+')')}</div>`;
                    },
                },
            ],
            order: [[3,'asc']],
            buttons: [{
                            text: '<i class="fas fa-plus"></i> Tambah',
                            className: 'btn-success btn-sm',
                            action: function (e, dt, node, config) {
                            loadDayOffTypeOption($('#new_type'));
                            $('#modal-new').modal('show');
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