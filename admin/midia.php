<?php $menu_ativo="midia"; $TITULO="Midia";
    include 'cabecalho.php';
    include_once 'DAO/DAO.midia.php';
    include_once 'DAO/DAO.passaros.php';
    if (isset($_GET["id"])) {
        $midia = new DAOMidia();
        $reg = $midia->Buscar($_GET["id"]);
    } else{
        $reg = new midia(); }
    
    if(isset($_POST["btnSalvar"])) {
        $midia = new midia();
        
            $destino = realpath(dirname(__FILE__)) . '//..//media/img//';
            $arquivodestino = $destino . basename($_FILES['txtCaminho']['name']);
            $foto = "";
            if (move_uploaded_file($_FILES['txtCaminho']['tmp_name'],$arquivodestino)){
                $foto = $_FILES["txtCaminho"]["name"];                
            }else{
                $foto = $_POST["txtCaminho"];
            }
        if (isset($foto) && $foto !=""){
            $midia->caminho = $foto;
        } else{
            $midia->caminho = $reg->caminho;
        }
        $midia->legenda = $_POST["txtLegenda"];
        $midia->refpassaros = $_POST["txtRefpassaros"];
        if (isset($_POST["txtCod"]))
            $midia->codigo = $_POST["txtCod"];
        
        $dao = new DAOMidia();
        $retorno = $dao->Salvar($midia);
       
        if($retorno) {
           header("Location: midialista.php?mensagem=".$retorno);
        }
    }

    
?>
<br />
<div class="row">
    <form method="POST" action="" class="col s12" enctype="multipart/form-data">
    <input type="hidden" name="txtCod" id="txtCod" value="<?= $reg->codigo; ?>" />
      <div class="row">
        <div class="input-field col s12 l12">
            <select name="txtRefpassaros" id="txtRefpassaros">
                <option value='' disabled selected>Selecione</option>
            <?php 
                $passaros= new DAOPassaro();
                $listapass=$passaros->ListarTudo();
                foreach ($listapass as $pass){ ?>
                
                <option value='<?=$pass->codigo;?>'<?=($pass->codigo==$reg->refpassaros?" selected":"");?>><?=$pass->nome;?></option>
                
                <?php }?>
            </select>
          <label for="txtRefpassaros">Referência</label>
        </div>
        </div>
        
        <div class="row">
        <div class="input-field col s12 l12">
            <i class="material-icons prefix">description</i>
          <input name="txtLegenda" id="txtLegenda" type="text" class="validate" value="<?= $reg->legenda; ?>" required>
          <label for="txtLegenda">legenda</label>
        </div>
      </div>
      
      
      <div class="row">
        <div class="col s12 l12">
            <div class="file-field input-field">
                <div class="btn">
                    <span>Caminho</span>
                    <input type="file" name="txtCaminho" id="txtCaminho" />
                </div>
                <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
            </div>
        </div>
      </div>
        <br/>
        <?=($reg->caminho != "") ?'<img src="../media/img/'.$reg->caminho.'" />':""; ?>
        <br/>
        <button class="btn waves-effect waves-light green" type="submit" name="btnSalvar" value="Salvar">Salvar
        <i class="material-icons right">check</i>
        </button>
        <button class="btn waves-effect waves-light red" type="button" name="voltar" value="voltar" onclick="location.href='midialista.php'">Voltar
        <i class="material-icons right">undo</i>
        </button>
    </form>
  </div>

<script>
$(document).ready(function() {
    $('select').material_select();
  });
</script>
<?php
include 'rodape.php';
?>