<?php
include_once 'admin/DAO/DAO.passaros.lista.php';
include 'cabecalho.php';

$passaros = new DAOPassaros();
$midia = new DAOMidia();

$lista = $passaros->ListarTudo();

?>
<style>
    .listNav, .ln-letters {
        overflow: hidden;
        display: table;
        width: 100%;
    }
    .ln-letters a {
        position: relative;    
        display: table-cell;
        padding: 6px 6px;
        border: 1px solid silver;
        border-right: none;
        text-decoration: none;
        text-align: center;
    }
    .ln-letters a:hover, .ln-letters .ln-selected {
        background-color: #0097a7;
        color: white;
    }
    @media only screen and (min-width: 699px){
        .ln-letters a {  
        float: none;
        } 
    }
}
</style>
<br/>
<div class="container">
<i class="col s1 l1 small material-icons prefix">search</i>
<input class="col s11 l11" type="text" id="myInput" onkeyup="myFunction()" placeholder="Procurar por nome..">
<ul id="listaPassaros" class="row">
   
<?php foreach ($lista as $passaros){ 
$imagem = $midia->Buscar($passaros->codigo);
?>
    <li class="col s12 l6" style="padding: 3px 0">
        <div>
        <div class="valign-wrapper">
        <img src="media/img/<?=$imagem->caminho;?>" alt="<?=$passaros->nome;?>" class="circle" height="70" width="70">
            <a href="detalhe.php?id=<?=$passaros->codigo;?>">
                <strong> &nbsp; <?=$passaros->nome;?></strong>
            </a>
        <i style="line-height: 110%; margin: .82rem 0 .656rem 0; font-size: small;">, <?=$passaros->nomecientifico;?></i>
        </div>
        </div>
    </li>

<?php } ?>
    
</ul>
<br/>
<br/>
</div>
<script type="text/javascript">
    $('#listaPassaros').listnav({
        includeAll: true,
        includeOther: true,
        includeNums: false,
        removeDisabled: false,
        allText: 'Todos',
        noMatchText: 'Nenhum registro encontrado!',
        cookieName: 'selec-lista'
    });
    function myFunction() {
    // Declare variables
    var input, filter, ul, li, a, i;
    input = document.getElementById('myInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("listaPassaros");
    li = ul.getElementsByTagName('li');

    // Loop through all list items, and hide those who don't match the search query
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
    }
</script>
<?php
    include "rodape.php";
?>