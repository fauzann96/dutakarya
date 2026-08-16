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
            ajax:{
                url:'<?=base_url('/api/field-coordinator/datatable')?>',
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
                targets: [-1,0,2], 
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
                { data: null, orderable: false,title:'#'},
                { data: 'name',name:'name',type:'text',title:'Nama'},
                { data: 'nip',name:'nip',type:'text',title:'NIP'},
                { data: 'customer_name',name:'customer_name',type:'text',title:'Korlap Unit Kerja'},
                { data: null,name:'action',type:'text',title:'Action',
                    render:function (data, type, row, meta) {
                        return '<div class="btn-group"><button type="button" onclick="showResetModal(' + row.id + ')" class="btn btn-warning btn-xs"><i class="fas fa-key"> Reset Password</i></button></div>'
                    }
                },
            ],
            buttons: [],
            });
            table.on('draw.dt', function () {
                var PageInfo = $('#data_table').DataTable().page.info();
                table.column(0, { page: 'current' }).nodes().each(function (cell, i) {
                    cell.innerHTML = i + 1 + PageInfo.start;
                });
            });
        }
    </script>
<?= $this->endSection() ?>       