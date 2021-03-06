
<script type="text/javascript">

  $(function(){
      $('#btn-close-opname').click(function(){
        close_popup_opname();
      }); 

      $('#form-ss').submit(function(){
          var data = new FormData();
          $('#notice-content').html('<div class="alert">Mohon tunggu, proses simpan data....</div>');
          $('#notice').show();
          data.append('id_mst_inv_barang_habispakai_jenis', $('#id_mst_inv_barang_habispakai_jenis').val());
          data.append('id_inv_inventaris_habispakai_opname', $('#id_inv_inventaris_habispakai_opname').val());
          data.append('id_mst_inv_barang_habispakai', $('#id_mst_inv_barang_habispakai').val());
          data.append('batch', $('#batch').val());
          data.append('uraian', $('#uraian').val());
          data.append('jumlah', $('#jumlah').val());
          data.append('harga', $('#harga').val());
          data.append('jumlahopname', $('#jumlahopname').val());
          data.append('merek_tipe', $('#merek_tipe').val());

          $.ajax({
              cache : false,
              contentType : false,
              processData : false,
              type : 'POST',
              url : '<?php echo base_url()."inventory/bhp_pemusnahan/".$action."_barang/{tanggal_opnam}/{kodeopname}/{idbarang}/{batch}" ?>',
              data : data,
              success : function(response){
                var res  = response.split("|");
                if(res[0]=="OK"){
                    $('#notice').hide();
                    $('#notice-content').html('<div class="alert">'+res[1]+'</div>');
                    $('#notice').show();
                    $("#jqxgrid_barang").jqxGrid('updatebounddata', 'cells');
                    close_popup_opname();
                }
                else if(res[0]=="Error"){
                    $('#notice').hide();
                    $('#notice-content').html('<div class="alert">'+res[1]+'</div>');
                    $('#notice').show();
                }
                else{
                    $('#popup_content').html(response);
                }
            }
          });
          return false;
      });
      var jmlasli = "<?php if(set_value('jumlah')=="" && isset($jmlawal)){
                            echo $jmlawal;
                          }else{
                            echo  set_value('jumlah');
                          } ?>";
      $("#jumlahopname").val(jmlasli - $("#jumlahmusnah").val());
      $("#jumlahmusnah").change(function(){
          if ($("#jumlahmusnah").val() < 0) {
            alert('Maaf, jumlah pemusnahan tidak boleh minus');
            $("#jumlahopname").val(jmlasli);
            $("#jumlahmusnah").val(jmlasli);
          }
          if (parseInt($("#jumlahmusnah").val()) > parseInt(jmlasli)) {
            alert('Maaf, jumlah pemusnahan tidak boleh lebih dari '+ jmlasli);
            $("#jumlahopname").val(jmlasli);
            $("#jumlahmusnah").val(jmlasli);
          }
          $("#jumlahopname").val(jmlasli- $(this).val());
      });

    });
</script>

<div style="padding:15px">
  <div id="notice" class="alert alert-success alert-dismissable" <?php if ($notice==""){ echo 'style="display:none"';} ?> >
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>
    <i class="icon fa fa-check"></i>
    Information!
    </h4>
    <div id="notice-content">{notice}</div>
  </div>
  <div class="row">
    <?php echo form_open(current_url(), 'id="form-ss"') ?>
          <div class="box-body">
          <div class="row" style="margin: 5px">
            <div class="col-md-4" style="padding: 5px">Nama Barang</div>
            <div class="col-md-8">
                <?php 
                  if(set_value('uraian')=="" && isset($uraian)){
                    echo $uraian;
                  }else{
                    echo  set_value('uraian');
                  }
                ?>
                <input type="hidden" class="form-control" name="id_inv_inventaris_habispakai_opname" id="id_inv_inventaris_habispakai_opname" placeholder="Nama Barang" value="<?php 
                if(set_value('id_inv_inventaris_habispakai_opname')=="" && isset($kode)){
                  echo $kode;
                }else{
                  echo  set_value('id_inv_inventaris_habispakai_opname');
                }
                ?>" readonly="readonly">
            </div>
          </div>
          <?php 
            if (isset($id_mst_inv_barang_habispakai_jenis)) {
              if ($id_mst_inv_barang_habispakai_jenis=="8") {
          ?>
          <div class="row" style="margin: 5px">
            <div class="col-md-4" style="padding: 5px">Nomor Batch</div>
            <div class="col-md-8">
              <input type="hidden" class="form-control" name="batch" id="batch" placeholder="Nomor Batch" value="<?php 
                if(set_value('batch')=="" && isset($batch)){
                  echo $batch;
                }else{
                  echo  set_value('batch');
                }
                ?>" readonly="readonly">
                 <?php 
                if(set_value('batch')=="" && isset($batch)){
                  echo $batch;
                }else{
                  echo  set_value('batch');
                }
                ?>
            </div>
          </div>
          <?php
           # code...
              }else{

              }
            }
          ?>
          <div class="row" style="margin: 5px">
            <div class="col-md-4" style="padding: 5px">Merek Tipe</div>
            <div class="col-md-8">
              <input type="text" class="form-control" name="merek_tipe" id="merek_tipe" placeholder="merek_tipe" value="<?php 
                if(set_value('merek_tipe')=="" && isset($merek_tipe)){
                  echo $merek_tipe;
                }else{
                  echo  set_value('merek_tipe');
                }
                ?>" readonly="" >
            </div>
          </div>
           <div class="row" style="margin: 5px">
            <div class="col-md-4" style="padding: 5px">Harga</div>
            <div class="col-md-8">
              <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php 
                if(set_value('harga')=="" && isset($harga)){
                  echo $harga;
                }else{
                  echo  set_value('harga');
                }
                ?>" readonly="" >
            </div>
          </div>
          
              <input type="hidden" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php 
                if(set_value('jumlah')=="" && isset($jmlawal)){
                  echo $jmlawal;
                }else{
                  echo  set_value('jumlah');
                }
                ?>" readonly="readonly">
          
            <input type="hidden" class="form-control" name="id_mst_inv_barang_habispakai_jenis" id="id_mst_inv_barang_habispakai_jenis" placeholder="Jumlah" value="<?php 
                if(set_value('id_mst_inv_barang_habispakai_jenis')=="" && isset($id_mst_inv_barang_habispakai_jenis)){
                  echo $id_mst_inv_barang_habispakai_jenis;
                }else{
                  echo  set_value('id_mst_inv_barang_habispakai_jenis');
                }
                ?>" readonly="readonly">
                <input type="hidden" class="form-control" name="id_mst_inv_barang_habispakai" id="id_mst_inv_barang_habispakai" placeholder="Jumlah" value="<?php 
                if(set_value('id_mst_inv_barang_habispakai')=="" && isset($id_mst_inv_barang_habispakai)){
                  echo $id_mst_inv_barang_habispakai;
                }else{
                  echo  set_value('id_mst_inv_barang_habispakai');
                }
                ?>" readonly="readonly">
          
          <div class="row" style="margin: 5px">
            <div class="col-md-4" style="padding: 5px">Jumlah Pemusnahan</div>
            <div class="col-md-8">
              <input type="hidden" class="form-control" name="jumlahopname" id="jumlahopname" placeholder="Jumlah Opname" value="<?php 
                if(set_value('jumlahopname')=="" && isset($jmlawal)){
                  echo $jmlawal;
                }else{
                  echo  set_value('jumlahopname');
                }
                ?>">
                 <input type="number" class="form-control" name="jumlahmusnah" id="jumlahmusnah" placeholder="Jumlah Pemusnahan" value="<?php 
                if(set_value('jumlahmusnah')=="" && isset($jmlawal)){
                  echo $jmlawal;
                }else{
                  echo  set_value('jumlahmusnah');
                }
                ?>">
            </div>
          </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" id="btn-close-opname" class="btn btn-warning">Batal</button>
        </div>
    </div>
</form>
</div>
<div id="popup_masterbarang" style="display:none">
  <div id="popup_mastertitle">Data master Barang</div>
  <div id="popup_mastercontent">&nbsp;</div>
</div>