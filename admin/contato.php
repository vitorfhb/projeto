<?php $menu_ativo="contato";$TITULO="Contatos";
    include 'cabecalho.php';
    include_once 'DAO/DAO.contatos.php';
    if (isset($_GET["id"])) {
        $contato = new DAOContato();
        $reg = $contato->Buscar($_GET["id"]);
    } else {
        $reg = new contato();
    }
     
    if(isset($_POST["btnSalvar"])) {
        
        $contato = new contato();
        $contato->nome = $_POST["txtNome"];
        $contato->email = $_POST["txtEmail"];
        $contato->data = date("Y-m-d", strtotime($_POST["txtData"]));
        $contato->mensagem = $_POST["txtMensag"];
        if (isset($_POST["txtCod"]))
            $contato->codigo = $_POST["txtCod"];
        
        $dao = new DAOContato();
        $retorno = $dao->Salvar($contato);
        if($retorno) {
           header("Location: contatolista.php?mensagem=".$retorno);
        }
    }

?>
<br/>
<div class="row">
    <form method="POST" action="#" class="col s12">
    <input type="hidden" name="txtCod" id="txtCod" value="<?= $reg->codigo; ?>" />
        <div class="row">
        <div class="input-field col s12 l12">
            <i class="material-icons prefix">account_circle</i>
          <input name="txtNome" id="txtNome" type="text" class="validate" value="<?= $reg->nome; ?>" required>
          <label for="txtNome">Nome</label>
        </div>
        </div>
      
      <div class="row">
        <div class="input-field col s12 l6">
            <i class="material-icons prefix">email</i>
          <input name="txtEmail" id="txtEmail" type="email" class="validate" value="<?= $reg->email; ?>" required>
          <label for="txtEmail">Email</label>
        </div>
        <div class="input-field col s12 l6">
            <i class="material-icons prefix">date_range</i>
          <input name="txtData" id="txtData" type="date" class="datepicker validate" value="<?= $reg->data; ?>" required>
          <label for="txtData">Data</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 l12">
            <i class="material-icons prefix">message</i>
            <textarea class="materialize-textarea" name="txtMensag" id="txtMensag"><?= $reg->mensagem; ?></textarea>
          <label for="txtMensag">Mensagem</label>
        </div>
      </div>
        <button class="btn waves-effect waves-light green" type="submit" name="btnSalvar" value="Salvar">Salvar
        <i class="material-icons right">check</i>
        </button>
        <button class="btn waves-effect waves-light red" type="button" name="voltar" value="voltar" onclick="location.href='contatolista.php'">Voltar
        <i class="material-icons right">undo</i>
        </button>
    </form>
  </div>

<script>
$('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    today: 'Today',
    clear: 'Clear',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });
</script>
<?php
include 'rodape.php';
?>