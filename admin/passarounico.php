<?php $menu_ativo="passaro";$TITULO="Passaros";
    include 'cabecalho.php';
    include_once 'DAO/DAO.passaros.php';
    if (isset($_GET["id"])) {
        $passaro = new DAOPassaro();
        $reg = $passaro->Buscar($_GET["id"]);
    } else{
        $reg = new passaro();
    }
    
    if(isset($_POST["btnSalvar"])) {
        
        $passaro = new passaro();
        $passaro->nome = $_POST["txtNome"];
        $passaro->nomecientifico = $_POST["txtNomeCien"];
        $passaro->descricao = $_POST["txtDescricao"];
        if (isset($_POST["txtCod"]))
            $passaro->codigo = $_POST["txtCod"];
        
        $dao = new DAOPassaro();
        $retorno = $dao->Salvar($passaro);
        if($retorno) {
           header("Location: passarolista.php?mensagem=".$retorno);
        }
    }

?>
<br/>
<div class="row">
    <form method="POST" action="#" class="col s12">
    <input type="hidden" name="txtCod" id="txtCod" value="<?= $reg->codigo; ?>" />
      <div class="row">
        <div class="input-field col s12 l6">
            <i class="material-icons prefix">account_circle</i>
          <input name="txtNome" id="txtNome" type="text" class="validate" value="<?= $reg->nome; ?>" required>
          <label for="txtNome">Nome</label>
        </div>
      
        <div class="input-field col s12 l6">
            <i class="material-icons prefix">name</i>
          <input name="txtNomeCien" id="txtNomeCien" type="text" class="validate" value="<?= $reg->nomecientifico; ?>" required>
          <label for="txtNomeCien">Nome Científico</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 l12">
            <i class="material-icons prefix">vpn_key</i>
            <textarea name="txtDescricao" id="txtDescricao" type="text" class="materialize-textarea" required><?= $reg->descricao; ?></textarea>
          <label for="txtDescricao">Descrição</label>
        </div>
      </div>
        <button class="btn waves-effect waves-light green" type="submit" name="btnSalvar" value="Salvar">Salvar
        <i class="material-icons right">check</i>
        </button>
        <button class="btn waves-effect waves-light red" type="button" name="voltar" value="voltar" onclick="location.href='passarolista.php'">Voltar
        <i class="material-icons right">undo</i>
        </button>
    </form>
  </div>

<?php
include 'rodape.php';
?>