<?php $menu_ativo="usuario"; $TITULO="Usuários";
    include 'cabecalho.php';
    include_once 'DAO/DAO.usuarios.php';
    
    if (isset($_GET["id"])) {
        $usuario = new DAOUsuario();
        $reg = $usuario->Buscar($_GET["id"]);
    } else{
        $reg = new usuario();
    }


    if(isset($_POST["btnSalvar"])) {
        
        
        $usuario = new usuario();
        if ($_POST["txtSenha"] === $_POST["txtSenha2"]){
            $usuario->nome = $_POST["txtNome"];
            $usuario->email = $_POST["txtEmail"];
        
            if (isset($_POST["txtSenha"]) && ($_POST["txtSenha"] != ""))
            {
                $usuario->senha = crypt($_POST["txtSenha"], 'st');
            } else {
                $usuario->senha = $reg->senha;
            }
            
            if (isset($_POST["txtCod"]))
                $usuario->codigo = $_POST["txtCod"];
        
            $dao = new DAOUsuario();
            $retorno = $dao->Salvar($usuario);
            if($retorno) {
                header("Location: usuariolista.php?mensagem=".$retorno);
            }
        } else  { 
                echo '<div class="row"><div class="col s12 m4 l8 offset-l2"><div class="card-panel red darken-3 z-depth-4"><span class="white-text"><strong>';
                echo "A senha deve ser idêntica!";
                echo '</strong></span></div></div></div>';
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
            <i class="material-icons prefix">email</i>
          <input name="txtEmail" id="txtEmail" type="email" class="validate" value="<?= $reg->email; ?>" required>
          <label for="txtEmail">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12 l12">
            <i class="material-icons prefix">vpn_key</i>
          <input name="txtSenha" id="txtSenha" type="password" class="validate" <?php if (!isset($_GET["id"])) { echo "required"; } ?>>
          <label for="txtSenha">Senha</label>
        </div>
      </div><div class="row">
        <div class="input-field col s12 l12">
            <i class="material-icons prefix">vpn_key</i>
          <input name="txtSenha2" id="txtSenha2" type="password" class="validate" <?php if (!isset($_GET["id"])) { echo "required"; } ?>>
          <label for="txtSenha2">Repita a senha</label>
        </div>
      </div>
        <button class="btn waves-effect waves-light green" type="submit" name="btnSalvar" value="Salvar">Salvar
        <i class="material-icons right">check</i>
        </button>
        <button class="btn waves-effect waves-light red" type="button" name="voltar" value="voltar" onclick="location.href='usuariolista.php'">Voltar
        <i class="material-icons right">undo</i>
        </button>
    </form>
  </div>

<?php
include 'rodape.php';
?>