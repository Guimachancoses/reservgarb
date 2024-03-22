<?php
    require_once 'validate.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/SMTP.php';
    function sendMailLoc ($email, $nome, $assunto, $dtname, $dtemail, $message, $dadosLocacao){
    // Verifica se a internet está disponível
    if (!checkInternetAvailability()) {
        echo "<script>alert('Internet indisponível no momento, tente mais tarte!'); window.location.href = 'index.php';</script>";
        return;
    }

    // Separar as linhas da string $dadosLocacao em um array
    $linhas = explode(" * ", $dadosLocacao);

    // Inicializar as variáveis para armazenar os valores extraídos
    $locacao = '';
    $description = '';
    $checkin = '';
    $checkin_time = '';
    $checkout_time = '';

    // Percorrer as linhas do array e extrair os valores
    foreach ($linhas as $linha) {
        // Use a função trim() para remover espaços em branco no início e no final de cada linha
        $linha = trim($linha);

        // Verificar se a linha não está vazia antes de extrair os valores
        if (!empty($linha)) {
            // Usar a função explode() novamente para dividir a linha em "chave: valor"
            $dados = explode("#", $linha);

            // Remover espaços em branco no início e no final de cada valor
            $chave = trim($dados[0]);
            $valor = isset($dados[1]) ? trim($dados[1]) : ''; // Verifica se o índice 1 existe


            // Verificar qual é a chave e atribuir o valor à variável correspondente
            if ($chave === 'Locação') {
                $locacao = $valor;
            } elseif ($chave === 'Descrição') { 
                $description = $valor;
            } elseif ($chave === 'Data de Início') {
                $checkin = DateTime::createFromFormat('Y-m-d', $valor)->format('d-m-Y');
            } elseif ($chave === 'Hora de Início') {
                $checkin_time = DateTime::createFromFormat('H:i:s', $valor)->format('H:i');
            } elseif ($chave === 'Hora Final') {
                $checkout_time = DateTime::createFromFormat('H:i:s', $valor)->format('H:i');
            }
            
        }
    }

        // Cria uma nova instância do PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'reservegarbuio@gmail.com';
            $mail->Password = 'qfjysgfhsfealnxa';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configurações do email
            $mail->CharSet = 'UTF-8';
            $mail->setFrom($email, $nome);
            $mail->addAddress( $dtemail, $dtname);
            $mail->Subject = $assunto;
            // $mail->Body = $message;

            define('BASE_DIR', dirname(__DIR__));

            // Obter o caminho absoluto da imagem "logo_title.png"
            $imagePath = BASE_DIR . '\img\logo_title.png';

            // Obter o caminho absoluto da imagem "logo_title.png"
            $imagePath2 = BASE_DIR . '\img\lg_garbuio.png';

            // Obter o caminho absoluto da imagem de fundo "background_1.jpg"
            $imagePath3 = BASE_DIR  . '\img\background_1.jpg';

            // Adicionar a imagem ao e-mail com o identificador "cid:background"
            $mail->AddEmbeddedImage($imagePath3, 'background', 'background_1.jpg');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath, 'logoimg', 'logo_title.png');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath2, 'logogarb', 'lg_garbuio.png');

            
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
                        <br />
                        <h5><strong>Olá, '.$dtname.'.</strong></h5>
                        <h5><strong>Você tem uma mensagem enviada de:</strong></h5>
                        <h5><strong>Nome: '.$nome.'.</strong></h5>
                        <h5><strong>Email: '.$email.'</strong></h5>
                        <br />
                        <h5>
                        <strong>Locação solicitada.</strong>
                        </h5>
                        <br />
                        <h5>
                        <strong>Informações da reserva:</strong>
                        </h5>
                        <li><strong>Locação: </strong> '.$locacao.'</li>
                        <li><strong>Descrição: </strong> '.$description.'</li>
                        <li><strong>Data: </strong> '.$checkin.'</li>
                        <li><strong>Hora de Início: </strong> '.$checkin_time.' horas</li>
                        <li><strong>Hora Final: </strong> '.$checkout_time.' horas</li>
                    </div>
                    <div class="card">
                        <h5><strong>Aguardando sua aprovação.</strong></h5>
                        <div
                            class="page-item"
                            style="display: flex; align-items: center; justify-content: center"
                            >
                            <a
                            style="border-radius: 10px 10px 10px 10px; text-decoration: none"
                            class="n-overlay"
                            href="http://agenda.garbuio.int/reservgarb/index.php"
                            target="_blank"
                            >Aprovar</a>
                        </div>
                    </div>
                    <div style="padding-top: 50px">
                        <img src="cid:logogarb"/>
                    </div>
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

            error_reporting(E_ALL);
            ini_set('display_errors', 1);


            echo "<script>alert('Corfirmação enviada com sucesso!'); window.location.href = 'reservlab.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('$e Erro ao enviar o email: " . $mail->ErrorInfo . "'); window.location.href = 'reservlab.php';</script>";
        }
    }
    // Função para verificar a disponibilidade da internet
    function checkInternetAvailability() {
        $url = 'http://www.google.com';
        $timeout = 5; // Defina um tempo limite maior, se necessário
    
        // Inicializa uma instância de cURL
        $curl = curl_init($url);
    
        // Configura as opções do cURL
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
    
        // Executa a solicitação cURL
        $response = curl_exec($curl);
    
        // Verifica se ocorreu um erro durante a solicitação
        if ($response === false) {
            return false;
        }
    
        // Obtém o código de resposta HTTP
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
        // Fecha a instância do cURL
        curl_close($curl);
    
        // Verifica se o código de resposta é 200 (OK)
        return $httpCode === 200;
    }

?>