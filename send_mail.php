<?php
    // Função responsável por enviar os e-mails
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require './phpmailer/src/PHPMailer.php';
    require './phpmailer/src/Exception.php';
    require './phpmailer/src/SMTP.php';

    function sendMail ($email, $nome, $assunto, $dtname, $dtemail, $message, $codigo){
        // Verifica se a internet está disponível
        if (!checkInternetAvailability()) {
            echo "<script>alert('Internet indisponível no momento, tente mais tarte!'); window.location.href = 'index.php';</script>";
            return;
        }

        // Define o tempo máximo de execução em 1 minuto (60 segundos)
        set_time_limit(60);

        // Cria uma nova instância do PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'guilherme.machancoses@gmail.com';
            $mail->Password = 'wntdhflnzjcnnwjj';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configurações do email
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($email, $nome); // email administrator, responsável por enviar
            $mail->addAddress($dtemail, $dtname); // dados do destinatário
            $mail->Subject = $assunto;
            // $mail->Body = $message;

            // Obter o caminho absoluto da imagem "logo_title.png"
            $imagePath = __DIR__ . '\img\logo_title.png';

            // Obter o caminho absoluto da imagem "logo_title.png"
            $imagePath2 = __DIR__ . '\img\lg_garbuio.png';

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath, 'logoimg', 'logo_title.png');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath2, 'logogarb', 'lg_garbuio.png');

            // Obter o caminho absoluto da imagem de fundo "background_1.jpg"
            $imagePath3 = __DIR__ . '/img/background_1.jpg';

            // Adicionar a imagem ao e-mail com o identificador "cid:background"
            $mail->AddEmbeddedImage($imagePath3, 'background', 'background_1.jpg');


            // Configurar o corpo do e-mail em HTML
            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta
                name="viewport"
                content="width=device-width, initial-scale=1, shrink-to-fit=no"
                />
                <meta
                name="viewport"
                content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"
                />
                <link
                href="https://fonts.googleapis.com/css2?family=Monte+Serrat&display=swap"
                rel="stylesheet"
                />
                <title>Reserve Garbuio</title>
                <style>
                html {
                    line-height: 1.8;
                    font-family: "Roboto", sans-serif;
                    color: #555e58;
                    /* text-transform:capitalize; */
                    font-weight: 400;
                    margin: 0px;
                    padding: 0px;
                    background-color: #f0f0f0;
                }

                @media (min-width: 1981px) and (max-width: 10000px) {
                    .header {
                      position: relative;
                      height: 100px;
                      background-image: linear-gradient(
                          to right,
                          rgba(255, 255, 255, 0.5),
                          rgba(0, 0, 0, 0.5)
                        ),
                        url("cid:background");
                      background-size: cover;
                      background-position: center;
                      padding: 20px;
                      text-align: center;
                      align-items: center;
                      justify-content: center;
                      color:#fff;
                      letter-spacing: 2px;
                      font-family: Monte Serrat;
                      font: sans-serif;
                      font-size: 30px;
                    }
                  }
            
                  @media (min-width: 1551px) and (max-width: 1980px) {
                    .header {
                      position: relative;
                      height: 100px;
                      background-image: linear-gradient(
                          to right,
                          rgba(255, 255, 255, 0.5),
                          rgba(0, 0, 0, 0.5)
                        ),
                        url("cid:background");
                      background-size: cover;
                      background-position: center;
                      text-align: center;
                      align-items: center;
                      justify-content: center;
                      color:#fff;
                      letter-spacing: 2px;
                      font-family: Monte Serrat;
                      font: sans-serif;
                      font-size: 25px;
                    }
                  }
            
                  @media (min-width: 1025px) and (max-width: 1550px) {
                    .header {
                      position: relative;
                      height: 100px;
                      background-image: linear-gradient(
                          to right,
                          rgba(255, 255, 255, 0.5),
                          rgba(0, 0, 0, 0.5)
                        ),
                        url("cid:background");
                      background-size: cover;
                      background-position: center;
                      text-align: center;
                      align-items: center;
                      justify-content: center;
                      color:#fff;
                      letter-spacing: 2px;
                      font-family: Monte Serrat;
                      font: sans-serif;
                      font-size: 25px;
                    }
                  }
            
                  @media (min-width: 426px) and (max-width: 1024px) {
                    .header {
                      position: relative;
                      height: 100px;
                      background-image: linear-gradient(
                          to right,
                          rgba(255, 255, 255, 0.5),
                          rgba(0, 0, 0, 0.5)
                        ),
                        url("cid:background");
                      background-size: cover;
                      background-position: center;
                      text-align: center;
                      align-items: center;
                      justify-content: center;
                      color:#fff;
                      letter-spacing: 2px;
                      font-family: Monte Serrat;
                      font: sans-serif;
                      font-size: 19px;
                    }
                  }
            
                  @media (max-width: 480px) {
                    .header {
                      position: relative;
                      height: 100px;
                      background-image: linear-gradient(
                          to right,
                          rgba(255, 255, 255, 0.5),
                          rgba(0, 0, 0, 0.5)
                        ),
                        url("cid:background");
                      background-size: cover;
                      background-position: center;
                      text-align: center;
                      align-items: center;
                      justify-content: center;
                      color:#fff;
                      letter-spacing: 2px;
                      font-family: Monte Serrat;
                      font: sans-serif;
                      font-size: 10px;
                    }
                  }

                .logo {
                    width: 80px;
                    margin-right: 10px;
                    position: absolute;
                    left: 20px;
                    top: 50%;
                    transform: translateY(-50%);
                    text-align: center;
                    align-items: center;
                }

                .main-content {
                    background-image: linear-gradient(
                    to right,
                    rgba(255, 255, 255, 0.5),
                    rgba(104, 193, 66, 0.5)
                    );
                    background-size: cover;
                    padding: 5% 10%; /* Adapta o padding internamente */
                    color: #000000;
                    text-align: center;
                    min-height: 50vh; /* Define a altura em 100% da altura da viewport (tela) */
                }

                .footer {
                    border-radius: 10px 10px 0px 0px;
                    border-top: 1px solid #000000;
                    background-color: #000000;
                    padding: 10px 0;
                    position: relative;
                    width: 100%;
                }

                .footer .copyright {
                    color: white;
                    padding: 15px;
                    font-size: 14px;
                    margin: 0;
                    text-align: right; /* Alinha o texto à direita */
                }

                /* Media query para telas menores, como celulares */
                @media (max-width: 480px) {
                    .header {
                    min-height: 150px;
                    }

                    .logo {
                    width: 60px;
                    }

                    .main-content {
                    padding: 20px;
                    }
                }

                /* Media query para telas menores, como celulares */
                @media (min-width: 481px) and (max-width: 768px) {
                    .header {
                    min-height: 150px;
                    }

                    .logo {
                    width: 60px;
                    }

                    .main-content {
                    padding: 20px;
                    }
                }

                /* Media query para telas médias, como tablets */
                @media (min-width: 769px) and (max-width: 1200px) {
                    .header {
                        min-height: 200px;
                    }

                    .logo {
                    width: 70px;
                    }

                    .main-content {
                    padding: 25px;
                    }
                }

                @media (min-width: 1201px) {
                    .header {
                        min-height: 200px;
                    }
                    
                    .logo {
                    width: 90px;
                    }

                    .main-content {
                    padding: 30px;
                    }
                }
                .page-item .n-overlay {
                    padding: 10px;
                    color: white;
                    background: #5faa4f;
                    border: 2px solid white;
                    border: 3px solid transparent;
                    cursor: pointer;
                }

                .page-item .n-overlay:hover {
                    color: #5faa4f;
                    background-color: white;
                    box-shadow: 5px 3px 10px #5faa4f;
                    border: 3px solid transparent;
                    cursor: pointer;
                }

                .card {
                    display: inline-block;
                    position: relative;
                    width: 75%;
                    margin: 15px 0;
                    border-radius: 6px;
                    background-color: #fff;
                    box-shadow: 10px 10px 10px #00000049;
                    text-align: left;
                    align-items: left;
                    padding: 20px;
                }

                .card h5 {
                    margin: 10px 0px;
                }
                /* Estilo para as tags <li> dentro da classe .card com a mesma fonte de <h5> */
                .card li {
                    font-size: 12px; /* Tamanho da fonte igual ao de <h5> */
                    margin: 10px 0px; /* Margem igual à de <h5> */
                }
                </style>
            </head>
            <body>
                <div class="header">
                    <img
                        style="padding-top: 50px"
                        align="left"
                        class="logo"
                        src="cid:logoimg"
                    />
                    <h1 style="padding-top: 50px;padding-right:15   0px">Reserve Garbuio</h1>
                </div>
                <div class="main-content">
                    <div class="card">
                        <h5
                        style="
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: red;
                        "
                        >
                        <strong>ESSA MENSAGEM É AUTOMÁTICA, FAVOR NÃO RESPONDER.</strong>
                        </h5>
                        <br/>
                        <h5><strong>Olá, '.$dtname.'.</strong></h5>
                        <h5><strong>Você tem uma mensagem enviada de:</strong></h5>
                        <h5><strong>Administrador:  '.$nome.'.</strong></h5>
                        <h5><strong>Email:  '.$email.'</strong></h5>
                        <h5>
                        <br/>
                        <strong
                            >Você recebeu esse e-mail para recuperar seu acesso ao portal de
                            reservas da Garbuio</strong
                        >
                        </h5>
                        <h5>
                        <strong
                            >Caso não tenha sido você que tenha solicitado, desconsidere esse
                            email.</strong
                        >
                        </h5>
                        <h5>
                        <strong>Senão use o código informado e clique no botão abaixo</strong>
                        </h5>
                    </div>
                    <div class="card">
                        <h3
                        >
                            <strong>Código: '.$codigo.'</strong>
                        </h3>
                        <h5><strong>Confirme abaixo para mudar sua senha.</strong></h5>
                        <div
                            class="page-item"
                            style="display: flex; align-items: center; justify-content: center"
                            >
                            <a
                            style="border-radius: 10px 10px 10px 10px; text-decoration: none"
                            class="n-overlay"
                            href="http://localhost/reservgarb/forgot/validateuser.php"
                            target="_blank"
                            >Confirmar</a
                            >
                        </div>
                    </div>
                </div>
                <div style="padding-top: 50px">
                    <img src="cid:logogarb" />
                </div>
                <footer class="footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <p class="copyright">
                                &copy;
                                <a
                                    style="color: white; text-decoration: none"
                                    href="https://www.linkedin.com/in/guilherme-machancoses-772986233/"
                                    target="blank"
                                    >GuiMac</a
                                >&#160; &#10084;&#65039; 2023
                                </p>
                            </div>
                        </div>
                    </div>
                </footer>
            </body>
            </html>
            ';

            // Configurar o corpo alternativo do e-mail (caso o cliente não suporte HTML)
            $mail->AltBody = $message;

            // Envia o email
            $mail->send();

            echo "<script>alert('Foi encaminhado um e-mail com as instruções para recuperar o seu acesso!'); window.location.href = 'index.php';</script>";
        } catch (Exception $e) {
            echo 'Erro ao enviar o email: ', $mail->ErrorInfo;
        }
    }

    // Função para verificar a disponibilidade da internet
    function checkInternetAvailability() {
        $dns = 'www.google.com';
        $timeout = 1;

        if (checkdnsrr($dns, 'A') || checkdnsrr($dns, 'AAAA')) {
            return true;
        }

        return false;
    }
?>
