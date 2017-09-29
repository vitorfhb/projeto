<?php $menu_ativo="resposta";$TITULO="Respostas";
    include 'cabecalho.php';
    include_once 'DAO/DAO.contatos.php';
    include_once 'DAO/DAO.respostas.php';
    
    $org = explode(".", $_GET["id"]);
    

    if (isset($_GET["id"]) && $org[0] == 0) {
        $contato = new DAOContato();
        $reg = $contato->Buscar($org[1]);
//        $rresposta = new resposta();
    } elseif (isset($_GET["id"]) && $org[0] == 1){
        $resp = new DAOResposta();
        $rresposta = $resp->Buscar($org[1]);
        $contato = new DAOContato();
        $reg = $contato->Buscar($rresposta->codigocontato);
    } else {
        $reg = new contato();
        $rresposta = new resposta();
    }
    
    if(isset($_POST["btnSalvar"])) {
        
        $resposta = new resposta();
        $resposta->codigocontato = $org[1];
        $resposta->data = date("Y-m-d H:i");
        $resposta->resposta = $_POST["txtResposta"];
        if (isset($_POST["txtCod"]))
            $resposta->codigo = $_POST["txtCod"];
        
        $dao = new DAOResposta();
        $retorno = $dao->Salvar($resposta);
        if($retorno) {
           header("Location: respostalista.php?mensagem=".$retorno);
        }
    }


    /*if (!isset($reg))
        */
?>
<br/>
<div class="row">
    <form method="POST" action="#" class="col s12">
    <input type="hidden" name="txtCod" id="txtCod" value="<?= $rresposta->codigo; ?>" />
        <table class="bordered centered">
        <thead>
          <tr>
              <th>Nome</th>
              <th>Email</th>
              <th>Data</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td><?= $reg->nome; ?></td>
            <td><?= $reg->email; ?></td>
            <td><?= $reg->data; ?></td>
          </tr>
        </tbody>
      </table>
        <br/>    
      <div class="row">
        <div class="input-field col s12 l12">
            <i class="material-icons prefix">message</i>
            <textarea class="materialize-textarea" name="txtMensag" id="txtMensag" readonly><?= $reg->mensagem; ?></textarea>
          <label for="txtMensag">Mensagem</label>
        </div>
      </div>
        <div class="row">
        <div class="input-field col s12 l12">
            <i class="material-icons prefix">message</i>
            <textarea class="materialize-textarea" name="txtResposta" id="txtResposta"><?= $rresposta->resposta; ?></textarea>
          <label for="txtResposta">Resposta</label>
        </div>
      </div>
        <button class="btn waves-effect waves-light green" type="submit" name="btnSalvar" value="Salvar">Salvar
        <i class="material-icons right">check</i>
        </button>
        <button class="btn waves-effect waves-light red" type="button" name="voltar" value="voltar" onclick="<?=($org[0]==0)? "location.href='contatolista.php'" : "location.href='respostalista.php'" ?>">Voltar
        <i class="material-icons right">undo</i>
        </button>
<br/>
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