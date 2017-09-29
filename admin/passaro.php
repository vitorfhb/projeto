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
    
    if(isset($_POST["btnSalvar"])){
            
        $passaro = new passaro();
        $passaro->nome = $_POST["txtNome"];
        $passaro->nomecientifico = $_POST["txtNomeCien"];
        $passaro->descricao = $_POST["txtDescricao"];
        if (isset($_POST["txtCod"]))
            $passaro->codigo = $_POST["txtCod"];
        
        $dao = new DAOPassaro();
        $retorno = $dao->Salvar($passaro);
        if($retorno) {
            $mensagem = $retorno[0];
            $id = $retorno[1];
        }
        $midia = new midia();
        $i = 0;
        $dir = realpath(dirname(__FILE__)) . '//..//media/img//';
        $fotos = $_FILES["files"];
        $legenda = array();
        
        foreach($_FILES["files"]["error"] as &$temp) {
    
        if(@move_uploaded_file($fotos['tmp_name'][$i], $dir . $fotos['name'][$i])) {
            $midia->caminho = $fotos['name'][$i];
            $midia->legenda = $_POST['legenda'.$i];
            $midia->refpassaros = $id;
            $dao = new DAOMidia();
            $retorno2 = $dao->Salvar($midia);
         }
            ++$i;
        }
        header("Location: passarolista.php?mensagem=".$mensagem);
    }
?>

<style>
#post-form > div > img {
        width: 200px;
        height: auto;
    }
</style>

    <form id="post-form" class="post-form" method="POST" enctype="multipart/form-data">
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
                <textarea name="txtDescricao" id="txtDescricao" class="materialize-textarea" required><?= $reg->descricao; ?></textarea>
                <label for="txtDescricao">Descrição</label>
            </div>
        </div>
  
        
<!--        <label for="files" style="font-weight:bold;"> Fotos: </label>-->
        <div class="file-field input-field">
            <div class="btn"><span>Imagens</span>
        <input type="file" name="files[]" id="gallery-photo-add" multiple="multiple" />
            </div>
            <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
            </div>
        </div>
<!--      <input type="submit" name="btnSalvar" id="enviar" value="Enviar" />-->
        
        <br />
        <div class="gallery">
        </div>
        <div class="row">
            <button class="btn waves-effect waves-light green" type="submit" name="btnSalvar" value="Salvar">Salvar
        <i class="material-icons right">check</i>
        </button>
            <button class="btn waves-effect waves-light red" type="button" name="voltar" value="voltar" onclick="location.href='passarolista.php'">Voltar
        <i class="material-icons right">undo</i>
        </button>
        </div>
    </form>


<script>
  $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            
                var reader = new FileReader();
                var filesAmount = input.files.length;
                var currentImage = 0;
            
                reader.onload = function(event) {
                    $($.parseHTML('<br />')).appendTo(placeToInsertImagePreview);
                    var vDiv = $("<div>")
                    vDiv.attr('class','row')
                        .append(
                            $('<img>')
                                .attr('class','col s12 l2')
                                .attr('src', event.target.result)
                                .attr('alt','imagem')    
                        )
                        .append(
                            $('<input>')
                                .attr('class','col s12 l10')
                                .attr('name', 'legenda'+ currentImage)
                                .attr('required','required')
                                .attr('placeholder','Legenda da Imagem')
                                .attr('type','text')
                        );

                    vDiv.appendTo(placeToInsertImagePreview);
                };
                
                reader.readAsDataURL(input.files[currentImage]);
            
                reader.onloadend = function () {
                    currentImage ++;
                    if (currentImage < filesAmount)
                        reader.readAsDataURL(input.files[currentImage]);
                }
                    
        }

    };

      
      
    $('#gallery-photo-add').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});   
    
    
    
</script>
<?php
include 'rodape.php';
?>