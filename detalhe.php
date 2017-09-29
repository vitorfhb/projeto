<?php
include_once 'admin/DAO/DAO.passaros.lista.php';
include 'cabecalho.php';

$passaros = new DAOPassaros();
$midia = new DAOMidia();
if (isset($_GET["id"])){
$pass = $passaros->Buscar($_GET["id"]);
$imagem = $midia->ListarMidia($pass->codigo);
$imagem2 = $midia->Buscar($pass->codigo);

    $tempVisto = $pass->visto + 1;
    $retorno = $passaros->Visto($tempVisto, $_GET["id"]);
?>
<br />
<div class="container">
    <div class="row">
        <div class="col s12 m12">
            <div class="card-panel teal lighten-4 z-depth-3">
                <div class="row">
                <div class="col s12 m12">
                    <h2 id="TituloDetalhe" class="header"><?=$pass->nome;?></h2>
                    <h5>
                    <i> &nbsp; &nbsp; &nbsp; <?=$pass->nomecientifico;?></i>
                    </h5>
                <br />
                </div>
                </div>
            <div class="row">    
            <div class="card horizontal teal lighten-5 z-depth-3">
                <div class="row">
                <div class="card-image col s12 m4">
                  <img class="responsive-img" src="media/img/<?=$imagem2->caminho;?>" alt="<?=$pass->nome;?>">
                </div>
                <div class="card-stacked col s12 m8">
                    <div class="card-content">
                        <p><?=$pass->descricao;?></p>
                    </div>
                </div>
                </div>
            </div>
            </div>
                    <div class="card-action">
                        <a class="cyan waves-effect waves-light btn galeria-trigger" href="#galeria">Imagens</a>
                        <button class="btn waves-effect waves-light red" type="button" name="voltar" value="voltar" onclick="location.href='passaros.php'">Voltar
                            <i class="material-icons right">undo</i>
                        </button>
                    </div>
            </div>
        </div>
    </div>
    
    
    <div id="galeria" style="display: none;">
    <?php foreach ($imagem as $img){ ?>
        <a data-fancybox<?=count($imagem) > 1 ?"='group'":"";?> href="media/img/<?=$img->caminho;?>" data-caption="<?=$img->legenda;?>">
<!--        <img class="responsive-img" src="media/img/<?=$img->caminho;?>" alt="" data-codigo="<?=$img->codigo;?>">-->
        </a>
    <?php } ?>
     </div>
</div>

<script>
$(document).ready(function(){
    $(".galeria-trigger").on("click",function(event){
        event.preventDefault();
        $("#galeria a").first().trigger("click");
    });
    $(document).on('afterShow.fb', function( e, instance, slide ) {
            var caminhoimg = $(slide).attr("src");
            console.log(caminhoimg);
            $.ajax({
                        type: "post",
                        url: 'admin/conta.imagem.php',
                        data: { caminhoimg: caminhoimg },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("some error");
                        }
                    });
    });
    
    /*$("[data-fancybox]").fancybox({
		afterShow: function(instance, slide) {

            var codigoimagem = $("#galeria a").data("codigo");
            var codigoimagem2 = $(this).data("codigo");
            console.log(codigoimagem);
            console.log(instance.$refs);
            

		}
	});*/
    
//    $('.modal').modal();
//    $('.slider').slider();
//    $('.materialboxed').materialbox();
//    $('.carousel').carousel();
  
}); 
</script>
<?php }
    include "rodape.php";
?>