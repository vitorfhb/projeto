<?php $menu_ativo="resposta";$TITULO="Respostas";
include 'cabecalho.php';
include_once 'DAO/DAO.respostas.php';
include_once 'DAO/DAO.contatos.php';

$resposta = new DAOResposta();
$contato = new DAOContato();
//if (isset($_GET["Acao"]) && isset($_GET["codigo"])){
//        $resposta->Excluir($_GET["codigo"]);
//        $aviso = $resposta->Excluir($msg); 
//        header("Location: respostalista.php?mensagem=".$aviso);
//    }
$lista = $resposta->ListarTudo();
        
if ( $_GET["mensagem"] != "" ){
            echo '<div class="row"><div class="col s12 m4 l8 offset-l2"><div class="card-panel green accent-4 z-depth-4"><span class=""><strong>';
            echo $_GET["mensagem"];
            echo '</strong></span></div></div></div>';
            
        }
?>
<br/>
<div class="text-right">
            
        </div>
<table class="bordered striped centered responsive-table" id="listaResposta">
    <thead>
        <div class="row">
        <tr>
            <th class="col s12 l3">Contato</th>
            <th class="col s12 l3">Data</th>
            <th class="col s12 l3">Resposta</th>
            <th class="col s12 l3">Enviada</th>
            <th class="col s12 l3">Ações</th>
        </tr>
        </div>
    </thead>
    <tbody>
        <div class="row">
    <?php 
        foreach ($lista as &$resposta){
            $reg=$contato->Buscar($resposta->codigocontato);
            $datapt = new DateTime($resposta->data);
            echo "<tr>";
            echo '<td class="col s12 l3">' . $reg->nome . "</td>";
            echo '<td class="col s12 l3">' . $datapt->format('d/m/Y H:i') . "</td>";
            echo '<td class="col s12 l3">' . $resposta->resposta . "</td>";
            echo '<td class="col s12 l3">';
            if ($resposta->enviada == 0) { echo '<i class="material-icons red-text">clear</i>';} else { echo '<i class="material-icons green-text">check</i>';} 
            echo "</td>";
            echo '<td class="col s12 l3">';
            echo '<a href="resposta.php?id=1.'.$resposta->codigo.'" class="waves-effect waves-light btn tooltipped blue" data-position="top" data-delay="50" data-tooltip="Editar"><i class="material-icons">edit</i></a> ';
            echo '<a href="#modal2" data-nome="'.$reg->nome.'" data-id="'.$resposta->codigo.'" class="waves-effect waves-light btn green tooltipped envioresp" data-position="top" data-delay="50" data-tooltip="Enviar"><i class="material-icons">send</i></a> ';
            echo "</td>";
            echo "</tr>";
            
        
         } ?>
        </div>
    </tbody>
</table>
<br/>
            <!-- Modal1 Structure -->
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
            <!-- Modal2 Structure -->
            <div id="modal2" class="modal">
            <div class="modal-content">
            <h4>Atenção !</h4>
            <p>Deseja enviar a mensagem?</p>
            <p><span class="nome"></span></p>
            <p id="demo"></p>
            </div>
            <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">
                <span class="red-text text-darken-2">Não</span></a>
            <a href="#!" class="modal-action waves-effect waves-green btn-flat enviaresposta">
                <span class="green-text text-darken-2">Sim</span></a>
            </div>
            </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.deletar').on('click', function(){
            var nome = $(this).data('nome'); // vamos buscar o valor do atributo data-name que temos no botão que foi clicado
            var id = $(this).data('id'); // vamos buscar o valor do atributo data-id
            $('span.nome').text(nome+ ' (id = ' +id+ ')'); // inserir na o nome na pergunta de confirmação dentro da modal
            $('a.delete-yes').attr('href', 'respostalista.php?Acao=Excluir&codigo=' +id); // mudar dinamicamente o link, href do botão confirmar da modal
            });
           
            $('.envioresp').on('click', function(){
                var nome2 = $(this).data('nome');
                var dataid = $(this).data('id');
                $('span.nome').text(nome2+ ' (id = ' +dataid+ ')');
                $('a.enviaresposta').unbind('click');
                $('a.enviaresposta').on('click', function(){
                    console.log(dataid);
                    document.getElementById("demo").innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
                    $('a.btn-flat').attr('disabled', true);
                    $.ajax({
                        type: "get",
                        url: 'enviaresposta.php',
                        data: {
                            "dataid": dataid
                        },
                        success: function(msg){
                            $('a.btn-flat').attr('disabled', false);
                            $('#modal2').modal('close');
                            if(msg == "true"){
                                var $msgtoast = $('<spam class="green-text">Mensagem enviada!</spam>');
                                Materialize.toast($msgtoast, 5000);
                                window.setTimeout(window.location.reload(), 6000);
                            }
                            else {
                                var $msgtoast = $('<spam class="red-text">Não foi possivel enviar!</spam>');
                                Materialize.toast($msgtoast, 5000);
                                console.log(msg)
                            }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("some error");
                        }
                    });


                });
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
            $('#listaResposta').DataTable({
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