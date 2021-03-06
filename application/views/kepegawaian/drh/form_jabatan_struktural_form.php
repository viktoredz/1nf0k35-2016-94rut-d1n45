
<form action="#" method="POST" name="frmPegawai">
  <div class="row" style="margin: 15px 5px 15px 5px">
    <div class="col-sm-8">
      <?php if(validation_errors()!=""){ ?>
      <div class="alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4>  <i class="icon fa fa-check"></i> Information!</h4>
        <?php echo validation_errors()?>
      </div>
      <?php } ?>

      <?php if($alert_form!=""){ ?>
      <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4>  <i class="icon fa fa-check"></i> Information!</h4>
        <?php echo $alert_form?>
      </div>
      <?php } ?>
    </div>
    <div class="col-sm-12" style="text-align: right">
      <!-- <button type="button" name="btn_pendidikan_struktural_save" class="btn btn-warning"><i class='fa fa-save'></i> &nbsp; Simpan</button> -->
      <button type="button" name="btn_pendidikan_struktural_close" class="btn btn-primary"><i class='fa fa-close'></i> &nbsp; Tutup</button>
    </div>
  </div>

  <div class="row" style="margin: 5px">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="row" style="margin: 5px">
                <div class="col-md-4" style="padding: 5px">
                  Jenis Diklat Struktural
                </div>
                <div class="col-md-8">
                  <select  name="mst_peg_id_pendidikan_struktural" type="text" class="form-control" <?php if($action=="edit") echo "disabled"?>>
                    <option value=''>-</option>
                      <?php 
                      if(set_value('mst_peg_id_diklat')=="" && isset($mst_peg_id_diklat)){
                        $mst_peg_id_diklat = $mst_peg_id_diklat;
                      }else{
                        $mst_peg_id_diklat = set_value('mst_peg_id_diklat');
                      }
                      foreach($kode_diklat as $diklat) : 
                        $select = $diklat->id_diklat == $mst_peg_id_diklat ? 'selected' : '' ;
                      ?>
                        <option value="<?php echo $diklat->id_diklat ?>" <?php echo $select ?>><?php echo $diklat->nama_diklat ?></option>
                      <?php endforeach ?>
                  </select>
                </div>
              </div>


              <div class="row" style="margin: 5px">
                <div class="col-md-4" style="padding: 5px">
                  Nomor 
                </div>
                <div class="col-md-8">
                  <input type="text" class="form-control" name="nomor_sertifikat_struktural" placeholder="Nomor Sertifikat" value="<?php 
                  if(set_value('nomor_sertifikat')=="" && isset($nomor_sertifikat)){
                    echo $nomor_sertifikat;
                  }else{
                    echo  set_value('nomor_sertifikat');
                  }
                  ?>">
                </div>
              </div>

              <div class="row" style="margin: 5px">
                <div class="col-md-4" style="padding: 5px">
                  Tanggal 
                </div>
                <div class="col-md-8">
                  <div id='tgl_diklat' name="tgl_pendidikan_struktural" value="<?php
                    if(set_value('tgl_diklat')=="" && isset($tgl_diklat)){
                      $tgl_diklat = strtotime($tgl_diklat);
                    }else{
                      $tgl_diklat = strtotime(set_value('tgl_diklat'));
                    }

                    if($tgl_diklat=="") $tgl_diklat = time();
                    echo date("Y-m-d",$tgl_diklat);
                  ?>" >
                  </div>
                </div>
              </div>

              <div class="row" style="margin: 5px">
                <div class="col-md-4" style="padding: 5px">
                  Nama Diklat Struktural
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="nama_pendidikan_struktural" placeholder="Nama Diklat Struktural" value="<?php 
                    if(set_value('nama_diklat')=="" && isset($nama_diklat)){
                      echo $nama_diklat;
                    }else{
                      echo  set_value('nama_diklat');
                    }
                    ?>">
                </div>
              </div>

              <br>
            </div>
          </div>
  </div>
</form>

<script>
  $(function () { 
    $('input').prop('disabled',true);
    $('select').prop('disabled',true);
    tabIndex = 1;

    $("[name='tgl_pendidikan_struktural']").jqxDateTimeInput({ formatString: 'dd-MM-yyyy', theme: theme, height:30});

    $("[name='btn_pendidikan_struktural_close']").click(function(){
        $("#popup_pendidikan_struktural").jqxWindow('close');
    });

  
    $("[name='btn_pendidikan_struktural_save']").click(function(){
        var data = new FormData();
        $('#biodata_notice-content').html('<div class="alert">Mohon tunggu, proses simpan data....</div>');
        $('#biodata_notice').show();

        data.append('mst_peg_id_diklat',    $("[name='mst_peg_id_pendidikan_struktural']").val());
        data.append('tgl_diklat',           $("[name='tgl_pendidikan_struktural']").val());
        data.append('nomor_sertifikat',     $("[name='nomor_sertifikat_struktural']").val());
        data.append('nama_diklat',          $("[name='nama_pendidikan_struktural']").val());
        data.append('tipe', 'struktural');

        $.ajax({
            cache : false,
            contentType : false,
            processData : false,
            type : 'POST',
            url : '<?php echo base_url()."kepegawaian/drh_pedidikan/biodata_pendidikan_struktural_{action}/{id}/{id_diklat}"   ?>',
            data : data,
            success : function(response){
              if(response=="OK"){
                $("#popup_pendidikan_struktural").jqxWindow('close');
                alert("Data diklat berhasil disimpan.");
                $("#jqxgridPendidikanStruktural").jqxGrid('updatebounddata', 'filter');
              }else{
                $('#popup_pendidikan_struktural_content').html(response);
              }
            }
        });

        return false;
    });

  });
</script>
