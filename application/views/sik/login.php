<div id="popup" style="display:none;">
  <div id="popup_title">Login Manajemen Organisasi Dinas</div><div id="popup_content" style="background:#efefef;color:orange">{popup}</div>
</div>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
  <tbody><tr>
    <td>
      <form action="<?php echo base_url()?>morganisasi/login" method="POST" id="form_puskesmas">
      <table border="0" cellpadding="0" cellspacing="0" width="80%">
      <tbody><tr>
        <td colspan="2" align="center" height="20">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" style="font-family:Calibri;font-size:16pt;color:#FFFFFF;font-style:italic;text-shadow:1px 1px 1px #000;padding:0 0 10px 30px;" align="left" height="30"><img src="<?php echo base_url()?>public/themes/login/img/user.png" align="absmiddle" height="50">Login Menu</td>
      </tr>
      <tr>
        <td class="username-bg">Kabupaten</td>
        <td class="textfield-bg"><input placeholder=" Kabupaten" name="kabupaten" size="20" class="input ac_input" autocomplete="off" type="text" readonly>
        <input size="15" name="kode" id="kode" style="border:0px;background:tranparent" type="hidden"> 
        </td>
      </tr>
      <tr><td colspan="2" height="10"></td></tr>
      <tr>
        <td class="username-bg">Username</td>
        <td class="textfield-bg"><input placeholder=" Username" name="username" size="20" class="input" autocomplete="off" type="text"></td>
      </tr>
      <tr><td colspan="2" height="10"></td></tr>
      <tr>
        <td class="username-bg">Password</td>
        <td class="textfield-bg"><input  placeholder=" Password" name="password" size="20" class="input" type="password"></td>
      </tr>
      <tr><td colspan="2" height="10"></td></tr>
      <tr>
        <td colspan="2" align="right"><input value="Login" class="btn-green" id="submit" type="submit"></td>
      </tr>
      <tr>
        <td colspan="2" style="font-size:9pt;font-family:Calibri;color:#FFFFFF;padding:10px 20px;">Silahkan anda login terlebih dahulu, untuk menggunakan fasilitas <i>infoKes</i><br>&nbsp;</td>
      </tr>
      </tbody></table>
      </form>
    </td>
  </tr>
  </tbody>
</table>

<script>
    $(document).ready(function(){
      var theme = "orange";

      $("input[name=kode]").val('3205');
      $("input[name=kabupaten]").val('KABUPATEN GARUT');
      $("input[name=kabupaten]").attr('readonly','true');
      $("input[name=kabupaten]").css('background','#7ddb49');

      $('#submit').click(function(){
        $(".body-login-table").hide("fade");

        $("#popup_content").html("<div style='text-align:center'><br><br><br><br><img src='<?php echo base_url()?>public/themes/login/img/loading.gif' alt='. . . . . . . . .'><br><br>l o a d i n g . . .</div>");
        $("#popup").jqxWindow({
          theme: theme, resizable: false,
          width: 400,
          height: 200,
          isModal: true, autoOpen: false, modalOpacity: 0.4
        });
        $("#popup").jqxWindow('open');


      });
      
  <?php if(validation_errors() !="" || $this->session->flashdata('notification') !=""){ 
    $err_msg = str_replace("\n", "", validation_errors()."<p>".$this->session->flashdata('notification')."</p>");
  ?>
        $("#popup_content").html("<?php echo $err_msg?>");
        $("#popup").jqxWindow({
          theme: theme, resizable: false,
          width: 400,
          height: 200,
          isModal: true, autoOpen: false, modalOpacity: 0.4
        });
        $("#popup").jqxWindow('open');
  <?php } ?>
  });
</script>