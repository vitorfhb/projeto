<?php $menu_ativo="estatistica";$TITULO="Estatísticas";
    include "cabecalho.php";
    include_once 'DAO/DAO.passaros.php';
    
    $passaro = new DAOPassaro;
    $lista = $passaro->ListarTudo();
?>
<nav class="light-blue darken-5 z-depth-3">
    <div class="nav-wrapper">
    <a href="#!" class="brand-logo center">Estatística Pássaros</a>
    <a href="#" data-activates="mobile-demo2" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile2" class="right hide-on-med-and-down">
            <li class="active"><a href="estatisticapassaro.php">Pássaros</a></li>
            <li><a href="estatisticamidia.php">Midia</a></li>
        </ul>
        <ul class="side-nav" id="mobile-demo2">
            <li><a href="estatisticapassaro.php">Pássaros</a></li>
            <li><a href="estatisticamidia.php">Midia</a></li>
        </ul>
    </div>
</nav>
<table class="bordered striped left responsive-table" id="listaPassaro">
    <thead>
        <tr>
            <th class="col s12 l6">Passaro</th>
            <th class="col s12 l6">Visitas</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach ($lista as &$passaro){
            echo "<tr>";
            echo '<td class="col s12 l6">' . $passaro->nome . "</td>";
            echo '<td class="col s12 l6">' . $passaro->visto . "</td>";
            echo "</tr>";
            
        
         } ?>
    </tbody>
</table>

<script type="text/javascript">
        $(document).ready(function(){
            $('#listaPassaro').DataTable({
                "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
    },
                "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}
});
            
            $('select').material_select();
        });
	
	</script>
<?php
    include "rodape.php";
?>