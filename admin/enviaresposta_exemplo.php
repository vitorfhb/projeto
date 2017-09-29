<!--renomear (retirar "_exemplo")-->
<?php
date_default_timezone_set('America/Sao_Paulo');
    try {
     include_once 'DAO/DAO.respostas.php';
     include_once 'DAO/DAO.contatos.php';
                
        $resposta = new DAOResposta();
        $retorno = $resposta->Buscar($_GET['dataid']);
        $contato = new DAOContato();
        $rtncontato = $contato->Buscar($retorno->codigocontato);
        
            require_once("class/class.phpmailer.php");
            require_once("class/class.smtp.php");

            # Inicia a classe PHPMailer
            $mail = new PHPMailer();

            #echo (extension_loaded('openssl')?'SSL loaded':'SSL not loaded')."\n";
            # Define os dados do servidor e tipo de conexão
            $mail->IsSMTP(); // Define que a mensagem será SMTP
            #$mail->Host = "smtp-mail.outlook.com"; # Endereço do servidor SMTP
            $mail->Host = gethostbyname('tls://smtp-mail.outlook.com');
            $mail->Port = 587; // Porta TCP para a conexão
            $mail->SMTPAutoTLS = true; // Utiliza TLS Automaticamente se disponível
            $mail->SMTPAuth = true; # Usar autenticação SMTP - Sim
            $mail->Username = 'email@email'; # Usuário de e-mail
            $mail->Password = 'password'; // # Senha do usuário de e-mail
            #$mail->SMTPDebug  = 2;
            #$mail->SMTPSecure = 'tls';
            $mail->SMTPOptions = array( //utilizar para email do outlook
                'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                )
            );
            # Define o remetente (você)
            $mail->From = "email@email"; # Seu e-mail
            $mail->FromName = "Vitor"; // Seu nome

            # Define os destinatário(s)
            $mail->AddAddress($rtncontato->email, $rtncontato->nome); # Os campos podem ser substituidos por variáveis
            #$mail->AddAddress('email@email'); # Caso queira receber uma copia
            #$mail->AddCC('ciclano@site.net', 'Ciclano'); # Copia
            #$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); # Cópia Oculta

            # Define os dados técnicos da Mensagem
            //$mail->IsHTML(true); # Define que o e-mail será enviado como HTML
            #$mail->CharSet = 'iso-8859-1'; # Charset da mensagem (opcional)

            # Define a mensagem (Texto e Assunto)
            $mail->Subject = "Mensagem de resposta."; # Assunto da mensagem
            $mail->Body = $retorno->resposta;
            $mail->AltBody = $retorno->resposta;

            # Define os anexos (opcional)
            #$mail->AddAttachment("c:/temp/documento.pdf", "documento.pdf"); # Insere um anexo

            # Envia o e-mail
            $enviado = $mail->Send();

            # Limpa os destinatários e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();

            # Exibe uma mensagem de resultado (opcional)
            if ($enviado) {
                $temp = new resposta();
                $temp->enviada = 1;
                $temp->codigo = $_GET['dataid'];
                $envio = $resposta->Envio($temp);
                echo "true";
            } else {
             echo "Não foi possível enviar o e-mail.";
             echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
            }
            
    } catch(Exception $e) {
        echo "Não foi possível enviar o e-mail.";
    }
?>