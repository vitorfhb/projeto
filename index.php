<?php
    include_once 'admin/DAO/DAO.passaros.lista.php';
    include "cabecalho.php";
    $passaros = new DAOPassaros();
    $midia = new DAOMidia();

    $lista = $passaros->ListarInicial();
?>
<div class="parallax-container">
     <div class="parallax">
      <div class="parallax"><img class="responsive-img" src="media/img/index.jpg" alt="fundo index"></div>
     </div>
</div>
<div class="section container bemvindo">
<h5>Bem vindo!</h5>
    <p>
        Site com coletânea de imagens e informações sobre aves.
    </p>

</div>
<div class="parallax-container">
     <div class="parallax">
      <div class="parallax"><img class="responsive-img" src="media/img/index05.jpg" alt="fundo index"></div>
     </div>
    </div>
<div class="section">
    <h5 class="center" >DESTAQUES</h5>
    <div class="carousel">
        <?php foreach ($lista as $passaros){ 
        $imagem=$midia->Buscar($passaros->codigo);
        ?>
        <a class="carousel-item tooltipped" href="detalhe.php?id=<?=$passaros->codigo;?>" data-position="top" data-delay="50" data-tooltip="<?=$passaros->nome;?>"><img src="media/img/<?=$imagem->caminho;?>" alt="<?=$passaros->nome;?>"></a>
        <?php } ?>
    </div>
</div>
<div class="parallax-container">
     <div class="parallax">
      <div class="parallax"><img class="responsive-img" src="media/img/index03.jpg" alt="fundo index"></div>
     </div>
    </div>
<script>
$(document).ready(function(){
    $('.parallax').parallax();
    $('.carousel').carousel();
    });
</script>
<?php
    include "rodape.php";
?>