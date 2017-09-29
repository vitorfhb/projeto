<?php $menu_ativo="contato";$TITULO="Contatos";
include 'cabecalho.php';
include_once 'DAO/DAO.contatos.php';
include_once 'DAO/DAO.respostas.php';

$contato = new DAOContato();
$resposta = new DAOResposta();
if (isset($_GET["Acao"]) && isset($_GET["codigo"])){
        $contato->Excluir($_GET["codigo"]);
        $aviso = $contato->Excluir($msg); 
        header("Location: contatolista.php?mensagem=".$aviso);
    }
$lista = $contato->ListarTudo();
        
if ( $_GET["mensagem"] != "" ){
            echo '<div class="row"><div class="col s12 m4 l8 offset-l2"><div class="card-panel green accent-4 z-depth-4"><span class=""><strong>';
            echo $_GET["mensagem"];
            echo '</strong></span></div></div></div>';
            
        }
?>
<br/>
<!--<div class="text-right">
            <a href="contato.php" class="btn-floating btn-large waves-effect waves-light tooltipped red" data-position="right" data-delay="50" data-tooltip="Adicionar registro!">
            <i class="material-icons">add</i>
            </a>
        </div>-->
<table class="bordered striped centered responsive-table" id="listaContato">
    <thead>
        <tr>
            <th class="col s12 l3">Nome</th>
            <th class="col s12 l3">Email</th>
            <th class="col s12 l3">Data</th>
            <th class="col s12 l3">Respondido</th>
            <th class="col s12 l3">Ações</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $busca = $resposta->BuscarCOD();
        foreach ($lista as &$contato){
            $datapt = new DateTime($contato->data);
            $respondido = "Nâo";
            foreach ($busca as &$teste){
                if ($contato->codigo == $teste->codigo && $teste->respostas > 0){
                    $respondido = "Sim, " . $teste->respostas . " vez(es)" ;
                    break;
                }
            }
            echo "<tr>";
            echo '<td class="col s12 l3">' . $contato->nome . "</td>";
            echo '<td class="col s12 l3">' . $contato->email . "</td>";
            echo '<td class="col s12 l3">' . $datapt->format('d/m/Y H:i') . '</td>';
            echo '<td class="col s12 l3">' . $respondido . "</td>";
            echo '<td class="col s12 l3">';
            echo '<a href="resposta.php?id=0.'.$contato->codigo.'" class="waves-effect waves-light btn tooltipped blue" data-position="top" data-delay="50" data-tooltip="Responder"><i class="material-icons">mail</i></a> ';
            //echo '<a href="#modal1" data-nome="'.$contato->nome.'" data-id="'.$contato->codigo.'" class="waves-effect waves-light btn tooltipped red deletar" data-position="top" data-delay="50" data-tooltip="Deletar"><i class="material-icons">delete</i></a>';
            echo "</td>";
            echo "</tr>";
            
        
         } ?>
    </tbody>
</table>
<br/>
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
            <div class="modal-content">
            <h4>Atenção !</h4>
            <p>Deseja realmente apagar o registro?</p>
            <p><span class="nome"></span></p>
            </div>
            <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">
                <span class="red-text text-darken-2">Não</span></a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat delete-yes">
                <span class="green-text text-darken-2">Sim</span></a>
            </div>
            </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.deletar').on('click', function(){
            var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
            var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
            $('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
            $('a.delete-yes').attr('href', 'contatolista.php?Acao=Excluir&codigo=' +id); // mudar dinamicamente o link, href do botão confirmar da modal
            });
          $('.modal').modal({
            dismissible: true, // Modal can be dismissed by clicking outside of the modal
            opacity: .9, // Opacity of modal background
            //inDuration: 300, // Transition in duration
            //outDuration: 200, // Transition out duration
            //startingTop: '4%', // Starting top style attribute
            //endingTop: '10%', // Ending top style attribute
            //ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
                //alert("Ready");
                //console.log(modal, trigger);
                //},
            //complete: function() { alert('Closed'); } // Callback for Modal close
            });
            $('#listaContato').DataTable({
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
include 'rodape.php';
?>