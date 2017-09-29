<?php $menu_ativo="passaro";$TITULO="Passaros";
    include 'cabecalho.php';
    include_once 'DAO/DAO.passaros.php';
    include_once 'DAO/DAO.midia.php';
    if (isset($_GET["id"])) {
        $passaro = new DAOPassaro();
        $midia = new DAOMidia();
        $reg = $passaro->Buscar($_GET["id"]);
        $midreg = $midia->BuscarRef($_GET["id"]);
    } else{
        $reg = new passaro();
        $midreg = new midia();
    }
    
    if(isset($_POST["btnSalvar"])) {
    /*    
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
    */
        
    }

?>
<style>
    body>main>div>form>img {

        width: 200px;
        height: auto;

    }

</style>

<br/>
<div class="row">
    <form method="POST" action="" class="col s12">
        <input type="hidden" name="txtCod" id="txtCod" value="<?= $reg->codigo; ?>" />
        <div class="row">
            <div class="input-field col s12 l6">
                <!--            <i class="material-icons prefix">account_circle</i>-->
                <input name="txtNome" id="txtNome" type="text" class="validate" value="<?= $reg->nome; ?>" required>
                <label for="txtNome">Nome</label>
            </div>

            <div class="input-field col s12 l6">
                <!--            <i class="material-icons prefix">name</i>-->
                <input name="txtNomeCien" id="txtNomeCien" type="text" class="validate" value="<?= $reg->nomecientifico; ?>" required>
                <label for="txtNomeCien">Nome Científico</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12 l12">
                <!--            <i class="material-icons prefix">vpn_key</i>-->
                <textarea name="txtDescricao" id="txtDescricao" type="text" class="materialize-textarea" required><?= $reg->descricao; ?></textarea>
                <label for="txtDescricao">Descrição</label>
            </div>
        </div>

        <?php 
                echo '<br/>';
        if (is_array($midreg) && $midreg[0]->codigo != null ) {
            foreach($midreg as $key => $tempmid) { 
                echo '<br/>';
                echo '<div class="row">';
                echo '<img class="responsive thumbnail col s12 l2" src="../media/img/'.$tempmid->caminho.'" />';
                echo '<div class="input-field col s12 l8">';
                echo '<i class="material-icons prefix">description</i>';
                echo '<input name="txtLegenda" id="txtLegenda" type="text" class="validate" value="'.$tempmid->legenda.'" required>';
                echo '<label for="txtLegenda">legenda</label>';
                echo '<div class="file-field input-field">';
                echo '<div class="btn">';
                echo '<span>Caminho</span>';
                echo '<input type="file" name="txtCaminho" id="txtCaminho" />';
                echo '</div>';
                echo '<div class="file-path-wrapper">';
                echo '<input class="file-path validate" type="text" value="'.$tempmid->caminho.'" >';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } 
        } else {
        ?>
        <div class="input-field col s12 l8">
            <input name="txtLegendaNova" id="txtLegendaNova" type="text" class="validate" required>
            <label for="txtLegendaNova">legenda</label>
            <div class="file-field input-field">
                <div class="btn"><span>Caminho</span>
                    <input type="file" name="txtCaminho" id="txtCaminho" />
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <?php } ?>
        <div id="novocampo" class="row">
        </div>
        <div class="row">
            <a class="btn-floating btn waves-effect waves-light red tooltipped addcampo" data-position="right" data-delay="50" data-tooltip="Adicionar imagem">
            <i class="material-icons">add</i>
            </a>
        </div>
        <br />
        <div class="row">
            <button class="btn waves-effect waves-light green" type="submit" name="btnSalvar" value="Salvar">Salvar
        <i class="material-icons right">check</i>
        </button>
            <button class="btn waves-effect waves-light red" type="button" name="voltar" value="voltar" onclick="location.href='passarolista.php'">Voltar
        <i class="material-icons right">undo</i>
        </button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        var nx = 0;
        $(".addcampo").click(function() {
            $("<div class='input-field col s12 l8>'").appendTo("#novocampo");
            $("<input name='txtLegendaNova" + nx + "' id='txtLegendaNova" + nx + "' type='text' class='validate' required>").appendTo("#novocampo");
            $("<label for='txtLegendaNova" + nx + "'>legenda</label>").appendTo("#novocampo");
            $("<div class='file-field input-field'><div class='btn'><span>Caminho</span><input type='file' name='txtCaminho" + nx + "' id='txtCaminho" + nx + "' /></div><div class='file-path-wrapper'><input class='file-path validate' type='text'  ></div></div>").appendTo("#novocampo");
            $("</div>").appendTo("#novocampo");
            nx = nx + 1;
        });
    });

</script>
<?php
include 'rodape.php';
?>
