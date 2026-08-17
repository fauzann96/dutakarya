<table id="data_table" class="table table-sm table-bordered table-striped compact">
                
</table>

<?= $this->section('on_document_ready_script') ?>
    loadDatatable();
<?= $this->endSection() ?>

<?= $this->section('page_script') ?>
    <script type="text/javascript">
        var table;
    function loadDatatable(){
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
        ajax:{
            url:"<?=base_url('/api/area/datatable')?>",
            type:"post",
            data:{["<?= csrf_token()?>"]:$("#<?= csrf_token()?>").val(),
                limit: function() { return $('#limit_rows').val(); },
            },
            dataSrc : function ( json ) {
                    $("#<?= csrf_token()?>").val(json.new_csrf);
                    return json.data;
            },
            "destroy" : true,
        },
        columnDefs: [
            {
            targets: [-1,0], 
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
            {data: null, orderable: false,title:'#'},
            { data: 'name',name:'name',type:'text',title:'Area'},
            { data: 'description',name:'description',type:'text',title:'Keterangan'},
            { data: null, orderable: false,title:'Aksi',
                render : function ( data, type, row ) {
                    return `<div class="btn-group" role="group">${viewButtonHref('<?= base_url("area/") ?>' + row.id)}
                    ${editButton('showEditModal('+row.id+')')}
                    ${deleteButton('showDeleteModal('+row.id+')')}</div>`;
                },
            },
        ],

        buttons: [{
                        text: '<i class="fas fa-plus"></i> Area Baru',
                        className: 'btn btn-success btn-sm',
                        action: function (e, dt, node, config) {
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