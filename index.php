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
<div class="center section container bemvindo">
    <div class="row">
        <h4>Bem vindo!</h4>
        <p>
        Coletânea de imagens e informações sobre aves.<br>
        Aproveite o passeio!
        </p>
    </div>
</div>
<div class="parallax-container">
     <div class="parallax">
      <div class="parallax"><img class="responsive-img" src="media/img/index05.jpg" alt="fundo index"></div>
     </div>
    </div>
<div class="section">
    <h4 class="center" >DESTAQUES</h4>
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