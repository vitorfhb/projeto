    </main>
    
<footer id="rodape" class="page-footer cyan darken-2 z-depth-3">
            <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5>
                    <span class="white-text">Projeto SENAC - Rio Preto</span>
                </h5>
                <p class="grey-text text-lighten-4">Projeto do curso de programador WEB.</p>
              </div>
              <div class="col l6 s12 right-align">
                <!--<h5>
                    <span class="white-text"></span>
                </h5>-->
                <ul>
                <li>
                    <a class="waves-effect waves-light modal-trigger grey-text text-lighten-3 sobre" href="#modalsobre">Sobre</a>
                </li>
                <li>
                    <a class="waves-effect waves-light modal-trigger grey-text text-lighten-3 contato" href="#modal2">Contato</a>
                </li>
                </ul>
              </div>
            </div>
            </div>
    <div class="footer-copyright">
        <div class="container center">
    <p>
    Senac © <?=date('Y')?>
    <i id="assinatura">
        Create by Vitor FHB
    </i>
    </p>
        </div>
    </div>
</footer>

  <!-- Modal Structure -->
  <div id="modal2" class="modal">
    <div class="modal-content">
      <h4>Contato</h4>
        <form class="col s12 tagForm" method="post">
        <div class="row">
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">account_circle</i>
                <input type="text" name="nomecontato" id="nomecontato" class="form-control" required />
                <label for="nomecontato">Nome</label>
            </div>
            <div class="input-field col s12 m6">
                <i class="material-icons prefix">email</i>
                <input type="email" name="emailcontato" id="emailcontato" class="form-control" required />
                <label for="emailcontato">Email</label>
            </div>
        </div>
        
        <div class="row">
            <div class="input-field col s12 m12">
                <i class="material-icons prefix">message</i>
                <textarea class="materialize-textarea" name="mensagemcontato" id="mensagemcontato" required></textarea>
                <label for="mensagemcontato">Mensagem</label>
            </div>
        </div>
        
    </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat enviacontato" name="btnSalvar">Enviar</a>
    </div>
  </div>

<!-- Modal Structure -->
  <div id="modalsobre" class="modal">
    <div class="modal-content">
      <h5>Sobre</h5>
        <div class="col s10 l8">
        <p>
            Site com coletânea de imagens e informações sobre aves, resultado do projeto do curso de Programação para WEB do SENAC – São José do Rio Preto – SP.
        </p>
        <p>
            Conteúdo (imagens e informações), obtidas de pesquisar na WEB, créditos reservados aos proprietários das mesmas.

        </p>
        <p>
            Agradecimentos aos Professores:<br>
            Thiago Colebrusco<br>
            Saulo Lopes
        </p>
        </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" name="fechar">Fechar</a>
    </div>
  </div>
<script>
$(document).ready(function(){ 
    $('.tooltipped').tooltip({delay: 50});
    $(".button-collapse").sideNav();
    $('a.enviacontato').on('click', function(){
    var datacontatos = { 
        "nomecontato":$('#nomecontato').val(), 
        "emailcontato":$('#emailcontato').val(),  
        "mensagemcontato":$('#mensagemcontato').val()
    }
    console.log(datacontatos);
    $.ajax({
        type: "post",
        url: 'admin/enviacontato.php',
        data: datacontatos,
        success: function(msg){
        Materialize.toast('Mensagem enviada!', 5000)
            $('#nomecontato').val("");
            $('#emailcontato').val("");
            $('#mensagemcontato').val("");
        //alert( "Data Saved: ");
  },
  error: function(XMLHttpRequest, textStatus, errorThrown) {
     alert("some error");
  }
    });
    
      
    });
    
    
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
    //  inDuration: 300, // Transition in duration
    //  outDuration: 200, // Transition out duration
      startingTop: '10%', // Starting top style attribute
      endingTop: '30%', // Ending top style attribute
    });
  });
</script>
</body>
</html>