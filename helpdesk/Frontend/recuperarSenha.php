<?php

    include '../Backend/conexao.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['email'])) {

        $query = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->execute(array($_POST['email']));

        $resultado = $query->fetch(PDO::FETCH_ASSOC); 

        if($resultado) {
            $matricula = $resultado['matricula'];
            $key = password_hash($resultado['senha'] . date("Y-m-d h:i:sa"), PASSWORD_DEFAULT);

            $query = $conn->prepare("UPDATE usuarios SET chave = :c WHERE matricula = :m");
            $query->bindValue(":c",$key);
            $query->bindValue(":m",$matricula);
            $query->execute();

            require('../Backend/PHPMailer/PHPMailer.php');
            require('../Backend/PHPMailer/SMTP.php');
            require('../Backend/PHPMailer/Exception.php');

            $mail = new PHPMailer(true);

            try {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'phptestemail22@gmail.com';
                $mail->Password = 'teste2223';
                $mail->Port = 587;

                $mail->setFrom('php80helpdesk@gmail.com');
                $mail->addAddress('fellippe.nascimento@gmail.com');
                $mail->addAddress('luiz.nascimento@telemacoborba.pr.gov.br');

                include 'emailRecuperarSenha.php';

                $mail->isHTML(true);
                $mail->Subject = 'Recuperação de senha Help Desk';
                $mail->Body = $conteudo;
                
                $mail->AltBody = '<a href=http://localhost/HelpDesk/helpdesk/Frontend/enviarNovaSenha.php?key='.$key.'>Clique aqui para redefinir a senha</a>';

                if($mail->send()) {
                    echo 'Email enviado com sucesso';
                } else {
                    echo 'Email nao enviado';
                }
            } catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
            }
        } else {
            echo "<script>window.alert('Endereço de e-mail não encontrado! Por favor realize o cadastro no sistema!')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Esqueceu Sua Senha??</h1>
                                        <p class="mb-4"></p>
                                    </div>
                                    <form action="recuperarSenha.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="Email" name="email" aria-describedby="emailHelp"
                                                placeholder="Seu endereço de e-mail">
                                        </div>
                                        <input type="submit" value="Recuperar Senha" class="btn btn-primary btn-user btn-block" id="enviarChave">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="cadastro.php">Cadastra-se!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="../index.php">Já possúi uma conta? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>