<?php
include_once 'admin/DAO/DAO.passaros.lista.php';
include 'cabecalho.php';

$passaros = new DAOPassaros();
$midia = new DAOMidia();

$lista = $passaros->ListarTudo();

?>
<br/>
<ul class="collection container">
    <div class="row">
    <?php foreach ($lista as $passaros){ 
    $imagem = $midia->Buscar($passaros->codigo);
    ?>
        <div class="col s12 l6">
        <li class="collection-item avatar">
        <div class="section">
        <img src="media/img/<?=$imagem->caminho;?>" alt="" class="circle responsive-img">
            <span class="title"><a href="detalhe.php?id=<?=$passaros->codigo;?>"><?=$passaros->nome;?></a></span>
        <p><i><?php echo substr($passaros->nomecientifico, 0, 60);?></i></p>
        </div>
        </li>
        </div>
    <?php } ?>
    </div>
</ul>
<br/>
<?php
    include "rodape.php";
?>