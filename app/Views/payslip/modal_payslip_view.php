      <div class="modal fade" id="modal-view-slip">
        <div class="modal-dialog modal-xl">
          <div class="modal-content text-sm">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">View Slip Gaji</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id='form_view_slip' action=''>
                <div class="modal-body">
                  <center class='text text-muted mt-0'><b>TAD</b></center>
                  <div class="row">
                    <div class="form-group col-12 col-sm-4 mb-0">
                      <label for="view_customer" class="col-form-label">Customer</label>
                      <p class="text-muted mb-0" id='view_customer'></p>
                    </div>
                    <div class="form-group col-12 col-sm-4 mb-0">
                      <label for="view_employee" class="col-form-label">Tenaga Alih Daya</label>
                      <p class="text-muted mb-0" id='view_tad'></p>
                    </div>
                    <div class="form-group col-12 col-sm-4 mb-0 ">
                      <label for="view_period" class="col-form-label">Periode Slip</label>
                      <p class="text-muted mb-0" id='view_period'></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <hr class="mb-0"><center class='text text-muted mt-0'><b>Penghasilan</b></center>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="view_gaji_pokok">Gaji Pokok</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_gaji_pokok" name="view_gaji_pokok" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="view_transport">Transport</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_transport" name="view_transport" class="form-control currency"disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="view_insentif">Insentif</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_insentif" name="view_insentif" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="view_kelebihan_hari">Insentif (Kelebihan Hari)</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_kelebihan_hari" name="view_kelebihan_hari" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="view_lembur">Insentif (Lembur)</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_lembur" name="view_lembur" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="view_shift">Tunjangan Shift</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_shift" name="view_shift" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-3" for="view_dinas_luar">Dinas Luar</label>
                        <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_dinas_luar" name="view_dinas_luar" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="view_kelebihan_m-1">Kelebihan Hari (M-1)</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_kelebihan_hari_m-1" name="view_kelebihan_hari_m-1" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <hr class="">
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="view_total_penghasilan">Total Penghasilan</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_total_penghasilan" name="view_total_penghasilan" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-sm-6">
                      <hr class="mb-0"><center class='text text-muted mt-0'><b>Potongan</b></center>
                      <div class="form-group row">
                          <label class="col-12 col-sm-4" for="view_bpjs_tk">BPJS Ketenagakerjaan</label>
                          <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_bpjs_tk" name="view_bpjs_tk" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="view_bpjs_kes">BPJS Kesehatan</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_bpjs_kes" name="view_bpjs_kes" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="view_bpjs_ht">BPJS Hari Tua</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_bpjs_ht" name="view_bpjs_ht" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="view_pph_21">PPH 21</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_pph_21" name="view_pph_21" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="view_absensi">Absensi</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_absensi" name="view_absensi" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="view_payroll">Payroll</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_payroll" name="view_payroll" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="view_mcu">MCU</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_mcu" name="view_mcu" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-12 col-sm-3" for="view_pinjaman">Pinjaman (SPH)</label>
                          <div class="col-12 col-sm-9 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_pinjaman" name="view_pinjaman" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                          </div>
                      </div>
                      <hr class="">
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="view_total_potongan">Total Potongan</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_total_potongan" name="view_total_potongan" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-12 col-sm-4" for="view_netto">Penghasilan Netto</label>
                        <div class="col-12 col-sm-8 input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">Rp</span>
                            </div>
                            <input type="number" id="view_netto" name="view_netto" class="form-control currency" disabled>
                            <div class="input-group-append">
                              <span class="input-group-text">.00</span>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  

                </div>

                <input type="hidden" id="csrf" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />  
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <script type="text/javascript">
        function viewSlip(data) {
          toastr.info('Memuat Data');
          var form_data = new FormData();
          form_data.append('<?=csrf_token()?>',$('#<?=csrf_token()?>').val());
          form_data.append('id',data['id']);
          form_data.append('type','view');
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
            $('#<?=csrf_token()?>').val(reply['new_csrf']);
            if(reply['status'] == 1 ){
              toastr.success('Slip gaji berhasil diinput');
              $('#view_customer').text(reply.data.customer_name+' ('+reply.data.location_name+')');
              $('#view_tad').text(reply.data.name);
              $('#view_period').text(reply.data.period);
              $('#view_gaji_pokok').val(reply.data.gaji_pokok);
              $('#view_transport').val(reply.data.transport);
              $('#view_insentif').val(reply.data.insentif);
              $('#view_kelebihan_hari').val(reply.data.kelebihan_hari);
              $('#view_lembur').val(reply.data.lembur);
              $('#view_shift').val(reply.data.shift);
              $('#view_dinas_luar').val(reply.data.dinas_luar);
              $('#view_kelebihan_hari_m-1').val(reply.data['kelebihan_hari_m-1']);
              $('#view_total_penghasilan').val(reply.data.total_penghasilan);
              $('#view_bpjs_tk').val(reply.data.bpjs_tk);
              $('#view_bpjs_kes').val(reply.data.bpjs_kes);
              $('#view_bpjs_ht').val(reply.data.bpjs_ht);
              $('#view_pph_21').val(reply.data.pph_21);
              $('#view_absensi').val(reply.data.absensi);
              $('#view_payroll').val(reply.data.payroll);
              $('#view_mcu').val(reply.data.mcu);
              $('#view_pinjaman').val(reply.data.pinjaman);
              $('#view_total_potongan').val(reply.data.total_potongan);
              $('#view_netto').val(reply.data.netto);
              $('#modal-view-slip').modal('show');
            }else{
              toastr.error('Gagal memuat data');
            }
          });
          request.fail(function( jqXHR, textStatus ) {
            toastr.error( "Request failed: " + textStatus );
          });
          // body...
        }
      </script>