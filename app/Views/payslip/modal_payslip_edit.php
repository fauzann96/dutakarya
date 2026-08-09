<!-- modal -->
      <div class="modal fade" id="modal-edit-slip">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-warning">
              <h4 class="modal-title">Edit Slip</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_edit_slip' action=''>
              <input type="hidden" id="edit_id" name="edit_id" class="form-control currency" required>
                <div class="modal-body">
                  <center class='text text-muted mt-0'><b>TAD</b></center>
                  <div class="row">
                    <div class="form-group col-12 col-sm-4">
                      <label for="edt_customer" class="col-form-label">Customer</label>
                      <select class="form-control select2bs4" id='edit_customer' name='edit_customer' disabled>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-4">
                      <label for="edt_employee" class="col-form-label">Tenaga Alih Daya</label>
                      <select class="form-control select2bs4" id='edit_employee' name='edit_employee' disabled>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-4">
                      <label for="edit_period" class="col-form-label">Periode Slip</label>
                      <input type="month" id="edit_period" name="edit_period" class="form-control" placeholder="" min='<?=substr($min_date, 0, -3 )?>' disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <hr class="mb-0"><center class='text text-muted mt-0'><b>Penghasilan</b></center>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="edit_gaji_pokok">Gaji Pokok</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_gaji_pokok" name="edit_gaji_pokok" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="edit_transport">Transport</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_transport" name="edit_transport" class="form-control currency"required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="edit_insentif">Insentif</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_insentif" name="edit_insentif" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="edit_kelebihan_hari">Insentif (Kelebihan Hari)</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_kelebihan_hari" name="edit_kelebihan_hari" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="edit_lembur">Insentif (Lembur)</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_lembur" name="edit_lembur" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="edit_shift">Tunjangan Shift</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_shift" name="edit_shift" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="edit_dinas_luar">Dinas Luar</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_dinas_luar" name="edit_dinas_luar" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="edit_kelebihan_m-1">Kelebihan Hari (M-1)</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_kelebihan_hari_m-1" name="edit_kelebihan_hari_m-1" class="form-control currency" required>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <hr class="mb-0"><center class='text text-muted mt-0'><b>Potongan</b></center>
                      <div class="form-group row">
                          <label class="col-12 col-sm-4" for="edit_bpjs_tk">BPJS Ketenagakerjaan</label>
                          <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_bpjs_tk" name="edit_bpjs_tk" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="edit_bpjs_kes">BPJS Kesehatan</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_bpjs_kes" name="edit_bpjs_kes" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="edit_bpjs_ht">BPJS Hari Tua</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_bpjs_ht" name="edit_bpjs_ht" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="edit_pph_21">PPH 21</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_pph_21" name="edit_pph_21" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="edit_absensi">Absensi</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_absensi" name="edit_absensi" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="edit_payroll">Payroll</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_payroll" name="edit_payroll" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="edit_mcu">MCU</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_mcu" name="edit_mcu" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="edit_pinjaman">Pinjaman (SPH)</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="edit_pinjaman" name="edit_pinjaman" class="form-control currency">
                            <div class="input-group-append" required>
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                  

                </div>

                <input type="hidden" id="<?= csrf_token() ?>" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />  
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <script type="text/javascript">
        function showModalEdit(data) {
          toastr.info('Memuat data');
          var form_data = new FormData();
          form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
          form_data.append('id',data['id']);
          var request = $.ajax({
            method: "POST",
            contentType: false,
            processData: false,  // Important!
            async: false,
            cache: false,
            timeout: 30000,
            url: "<?=base_url('/payslip/data')?>",
            data: form_data,
            dataType: 'json',
          });
          request.done(function( reply ) {
            $('#<?=csrf_token()?>').val(reply['edit_csrf']);
            if(reply['status'] == 1 ){
              loadCustomerOption($('#edit_customer'));
              loadcustomerEmployeeOption($('#edit_employee'),reply.data.customer_seq);
              $('#edit_id').val(data['id']);
              $('#edit_customer').val(reply.data.customer_seq);
              $('#edit_employee').val(reply.data.employee_seq);
              $('#edit_period').val(reply.data.period);
              $('#edit_gaji_pokok').val(reply.data.gaji_pokok);
              $('#edit_transport').val(reply.data.transport);
              $('#edit_insentif').val(reply.data.insentif);
              $('#edit_kelebihan_hari').val(reply.data.kelebihan_hari);
              $('#edit_lembur').val(reply.data.lembur);
              $('#edit_shift').val(reply.data.shift);
              $('#edit_dinas_luar').val(reply.data.dinas_luar);
              $('#edit_kelebihan_hari_m-1').val(reply.data['kelebihan_hari_m-1']);
              $('#edit_bpjs_tk').val(reply.data.bpjs_tk);
              $('#edit_bpjs_kes').val(reply.data.bpjs_kes);
              $('#edit_bpjs_ht').val(reply.data.bpjs_ht);
              $('#edit_pph_21').val(reply.data.pph_21);
              $('#edit_absensi').val(reply.data.absensi);
              $('#edit_payroll').val(reply.data.payroll);
              $('#edit_mcu').val(reply.data.mcu);
              $('#edit_pinjaman').val(reply.data.pinjaman);
              $('#modal-edit-slip').modal('show');
            }else{
              toastr.error('Gagal memuat');
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            toastr.error( "Request failed: " + textStatus );
          });
        }

      </script>