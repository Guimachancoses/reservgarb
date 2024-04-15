<?php
    require_once 'validate.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/SMTP.php';
    function sendMailPer ($email, $nome, $assunto, $dtname, $dtemail, $message, $dadosLocacao){
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
    $weekday = '';
    $checkin = '';
    $checkout = '';
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
            } elseif ($chave === 'Dia da Semana') { 
                $weekday = $valor;
            } elseif ($chave === 'Data de Início') {
                $checkin = DateTime::createFromFormat('Y-m-d', $valor)->format('d-m-Y');
            } elseif ($chave === 'Data Final') {
                $checkout = DateTime::createFromFormat('Y-m-d', $valor)->format('d-m-Y');
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

            // Obter o caminho absoluto da imagem "Banner topo"
            $imagePathlg = BASE_DIR . '\img\icon_garbuio.png';

            // Obter o caminho absoluto da imagem "Banner topo"
            $imagePath = BASE_DIR . '\img\bannermail.png';

            // Obter o caminho absoluto da imagem "Banner esquerda"
            $imagePath2 = BASE_DIR . '\img\bannermail2.jpeg';

            // Obter o caminho absoluto da imagem de fundo "icon_insta"
            $imagePath3 = BASE_DIR  . '\img\icon_insta.gif';

            // Obter o caminho absoluto da imagem de fundo "icon_whats"
            $imagePath4 = BASE_DIR  . '\img\icon_whats.gif';
            
            // Obter o caminho absoluto da imagem de fundo "icon_face"
            $imagePath5 = BASE_DIR  . '\img\icon_face.gif';
            
            // Obter o caminho absoluto da imagem de fundo "icon_linkedin"
            $imagePath6 = BASE_DIR  . '\img\icon_linkedin.gif';

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePathlg, 'icongarbuio', 'icon_garbuio.png');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath, 'bannerimg', 'bannermail.png');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath2, 'bannerimg2', 'bannermail2.jpeg');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath3, 'iconinsta', 'icon_insta.gif');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath4, 'iconwhats', 'icon_whats.gif');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath5, 'iconface', 'icon_face.gif');

            // Adicionar a imagem ao e-mail
            $mail->AddEmbeddedImage($imagePath6, 'iconlinkedin', 'icon_linkedin.gif');

            
            // Configurar o corpo do e-mail em HTML
            $mail->isHTML(true);
            $mail->Subject = $assunto;
            $mail->Body = '
            <html xmlns="http://www.w3.org/1999/xhtml">
              <link type="text/css" rel="stylesheet" id="dark-mode-custom-link" /><link
                type="text/css"
                rel="stylesheet"
                id="dark-mode-general-link"
              /><style lang="en" type="text/css" id="dark-mode-custom-style"></style
              ><style lang="en" type="text/css" id="dark-mode-native-style"></style
              ><head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <!--[if !mso]><!-->
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <!--<![endif]-->
                <title>Reserve Garbuio</title>
                <link rel="icon" type="image/jpg" href="./img/logo_title.png" />
                <style type="text/css">
                  /* Reset styles */
                  @font-face {
                    font-family: "Cachet", sans-serif;
                    font-weight: 800;
                    src: url("./font/Cachet\ Std\ Book.otf") format("truetype");
                }

                  a,
                  a:link,
                  a:hover,
                  a:visited,
                  a:active {
                    color: #000000;
                    text-decoration: none;
                  }
                  .reset-blue-link {
                    color: #000000 !important;
                  }
                  .iosLink a {
                    color: #444444 !important;
                    text-decoration: none !important;
                  }
                  .iosLinkWhite a {
                    color: #ffffff !important;
                    text-decoration: none !important;
                  }
                  a.disable-link {
                    pointer-events: none;
                    cursor: default;
                  }
                  a[x-apple-data-detectors="true"] {
                    color: inherit !important;
                    text-decoration: inherit !important;
                    pointer-events: none !important;
                  }
                  u ~ div a,
                  #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                    font-weight: inherit;
                  }
                  .yshortcuts a {
                    border-bottom: none !important;
                  }
                  #outlook a {
                    padding: 0;
                  }
                  span.MsoHyperlink {
                    mso-style-priority: 99;
                    color: inherit;
                  }
                  span.MsoHyperlinkFollowed {
                    mso-style-priority: 99;
                    color: inherit;
                  }
                  .ReadMsgBody {
                    width: 100%;
                    background-color: #ffffff;
                  }
                  .ExternalClass {
                    width: 100%;
                  }
                  .ExternalClass,
                  .ExternalClass p,
                  .ExternalClass span,
                  .ExternalClass font,
                  .ExternalClass td,
                  .ExternalClass div {
                    line-height: 100%;
                  }

                  table,
                  td,
                  th {
                    border-collapse: collapse;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                  }
                  body,
                  table,
                  td,
                  th,
                  p,
                  a,
                  li,
                  blockquote {
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%;
                  }
                  body {
                    margin: 0;
                    padding: 0;
                    background-color: #ffffff;
                    -webkit-font-smoothing: antialiased;
                    -moz-osx-font-smoothing: grayscale;
                  }
                  p {
                    margin: 0;
                  }
                  ol,
                  ul {
                    padding-left: 2em;
                  }
                  sup {
                    font-size: 0.6em;
                    vertical-align: 0.5em;
                    line-height: 1em;
                  }
                  body,
                  table,
                  td,
                  th,
                  p,
                  ul,
                  ol,
                  li {
                    font-family: Cachet, sans-serif;
                    font-size: 13px;
                    line-height: 16px;
                    font-weight: 800;
                  }
                  img,
                  a img {
                    display: block;
                    border: 0;
                    text-decoration: none;
                    font-size: 13px;
                    line-height: 16px;
                    color: #070707;
                    font-family: Cachet, sans-serif;
                  }
                  hr {
                    border: 0;
                    border-top: 1px solid #aaaaaa;
                  }
                  img {
                    -ms-interpolation-mode: bicubic;
                  }
                  .showMobile {
                    display: none;
                  }
                  .n-overlay {
                    padding: 10px;
                    color: white;
                    background: #5faa4f;
                    border: 2px solid white;
                    border: 3px solid transparent;
                    cursor: pointer;
                  }

                  .n-overlay:hover {
                    color: #5faa4f;
                    background-color: white;
                    box-shadow: 5px 3px 10px #5faa4f;
                    border: 3px solid transparent;
                    cursor: pointer;
                  }
                  /* Android 4.4 */
                  body[style*="margin: 0 10px"] {
                    margin: 0 auto !important;
                    padding: 0px !important;
                  }
                  div[style*="margin: 16px 0"] {
                    margin: 0 auto !important;
                    font-size: 100% !important;
                  }
                  /* Gmail */
                  * img[tabindex="0"] + div {
                    display: none !important;
                  }

                  /* ------------- MOBILE START  ------------------ */

                  @media screen and (max-width: 600px) {
                    u ~ div #fw-container {
                      min-width: 100vw !important;
                    }
                    #m-p-container {
                      padding: 10px !important;
                    }
                    /* ------------- Hero Image Swap  ------------------ */

                    img[class="topbannerSwitcher"] {
                      display: block !important;
                      content: url() !important;
                      width: 100% !important;
                      height: auto !important;
                    }

                    img[class="mobile"] {
                      display: block !important;
                      width: 100% !important;
                      height: auto !important;
                    }

                    /* ------------- END Hero Image Swap  ------------------ */

                    .wrap {
                      width: 100% !important;
                      height: auto !important;
                    }
                    .showMobile {
                      display: block !important;
                    }
                    .hide {
                      display: none !important;
                    }
                    .stack {
                      width: 100% !important;
                      height: auto !important;
                      display: block !important;
                      border: none !important;
                    }
                    .m-p-reset {
                      padding-top: 10px !important;
                    }
                    .m-px-reset {
                      padding-left: 0 !important;
                      padding-right: 0 !important;
                    }
                    .m-py-reset {
                      padding-top: 0 !important;
                      padding-bottom: 0 !important;
                    }
                    .m-p-10 {
                      padding: 10px !important;
                    }
                    .m-p-15 {
                      padding: 15px !important;
                    }
                    .m-px-20 {
                      padding-left: 20px !important;
                      padding-right: 20px !important;
                    }
                    .m-px-15 {
                      padding-left: 15px !important;
                      padding-right: 15px !important;
                    }
                    .m-px-10 {
                      padding-left: 10px !important;
                      padding-right: 10px !important;
                    }
                    .m-pb-10 {
                      padding-bottom: 10px !important;
                    }
                    .m-pb-45 {
                      padding-left: 45px !important;
                    }
                    .m-pb-20 {
                      padding-bottom: 20px !important;
                    }
                    .m-pt-10 {
                      padding-bottom: 10px !important;
                    }
                    .m-pt-20 {
                      padding-top: 20px !important;
                    }
                    .mobile-skinny-banner-padding {
                      padding: 0 0 15px 0 !important;
                    }
                    .hero-padding {
                      padding-top: 25px !important;
                      padding-bottom: 15px !important;
                    }
                    .mobile-cta-padding {
                      padding: 10px 0px 0px 0px !important;
                    }
                    .mobile-cta-padding2 {
                      padding: 10px 0px 20px 0px !important;
                    }
                    .width-auto {
                      width: auto !important;
                    }
                    .height-auto {
                      height: auto !important;
                    }
                    .align-center {
                      text-align: center !important;
                    }
                    .img-center {
                      margin-left: auto;
                      margin-right: auto;
                    }
                    .align-left,
                    .align-left td {
                      text-align: left !important;
                    }
                    .fs13 {
                      font-size: 11px !important;
                      line-height: 13px !important;
                    }
                    .promo {
                      font-size: 104px !important;
                      line-height: 54px !important;
                    }
                    .promo-text {
                      font-size: 40px !important;
                      line-height: 42px !important;
                    }
                    .hero-subhead-padding {
                      padding-top: 10px !important;
                      padding-bottom: 15px !important;
                    }
                    .product-padding {
                      padding-left: 20px !important;
                      padding-right: 20px !important;
                      padding-bottom: 15px !important;
                    }
                    .product-padding img {
                      width: 100% !important;
                      height: auto !important;
                    }
                    .product-padding-b15 {
                      padding-left: 0px !important;
                      padding-right: 0px !important;
                      padding-bottom: 15px !important;
                    }
                    .product-padding-b15 img {
                      width: 100% !important;
                      height: auto !important;
                    }
                    .product-nopadding img {
                      width: 100% !important;
                      height: auto !important;
                    }
                    .product-col {
                      padding-bottom: 25px !important;
                    }
                    .product-col-border {
                      padding-top: 25px !important;
                      border-top: 1px solid #c8c9c7 !important;
                    }
                    .product-col-middle-border {
                      padding: 25px 0 !important;
                      border-top: 1px solid #c8c9c7 !important;
                    }
                    #coop-banner .image1 {
                      width: calc(120px * 1.5) !important;
                    }
                    #coop-banner .image2 {
                      width: calc(53px * 1.5) !important;
                    }
                    #coop-banner .image3 {
                      width: calc(74px * 1.5) !important;
                    }
                    .stack.mobile-ql table {
                      border-bottom: 1px solid #ffffff !important;
                    }
                    .stack.mobile-ql table * {
                      border-bottom: 0 !important;
                    }
                    .mobile-ql .stack {
                      padding: 5px 0 !important;
                    }
                    .connect-text-padding {
                      padding: 0 0 10px !important;
                    }
                    .wd_auto_3up4 {
                      width: 100% !important;
                      height: auto !important;
                      border-right: none !important;
                      padding: 15px 15px !important;
                    }
                    .wd_auto_3up3 {
                      width: 100% !important;
                      height: auto !important;
                      padding-top: 10px !important;
                    }
                    .padding_mid {
                      padding-left: 15px !important;
                      padding-right: 15px !important;
                    }
                    .h_auto {
                      height: auto !important;
                    }
                    .noneMobile {
                      display: none !important;
                    }
                    td[class="hero-product"] .product_image_small {
                      display: table-cell !important;
                      height: auto !important;
                      max-height: inherit !important;
                      overflow: visible !important;
                      float: none !important;
                      padding-bottom: 10px;
                    }
                    td[class="hero-product"] .product_image_small img {
                      width: 100%;
                      height: auto !important;
                      display: block !important;
                    }
                    .config-border {
                      width: 100% !important;
                      height: auto !important;
                      border-right: none !important;
                      padding-bottom: 15px !important;
                      /*border-bottom: 1px solid #aaaaaa !important;*/
                    }
                    .cta-button a {
                      padding: 12px 20px !important;
                    }
                  }
                  
                </style>

                <!-- Non-Gmail supported CSS -->
                <style>
                  /* Outlook app iOS */

                  body[data-outlook-cycle] #m-p-container {
                    padding: 10px !important;
                    background-color: #ffffff !important;
                  }

                  /* Outlook app Android */
                  @media (min-resolution: 1dpi) {
                    body[data-outlook-cycle] #m-p-container {
                      padding: 0px !important;
                    }
                  }
                </style>

                <link
                  rel="stylesheet"
                  type="text/css"
                  href="chrome-extension://jggobmlojchhlngdhmmdghgganciigof/css/translate_popup.css"
                />
                <style type="text/css" id="operaUserStyle"></style>
              </head>

              <body bgcolor="#ffffff" style="margin: 0; padding: 0px">
                <table
                  role="presentation"
                  align="center"
                  width="100%"
                  border="0"
                  cellspacing="0"
                  cellpadding="0"
                >
                  <tbody>
                    <tr>
                      <td align="center" valign="top" bgcolor="#ffffff" id="fw-container">
                        <table
                          role="presentation"
                          align="center"
                          width="100%"
                          border="0"
                          cellspacing="0"
                          cellpadding="0"
                        >
                          <tbody>
                            <tr>
                              <td
                                align="center"
                                valign="top"
                                style="padding: 25px"
                                id="m-p-container"
                              >
                                <table
                                  role="presentation"
                                  width="600"
                                  bgcolor="#ffffff"
                                  class="wrap"
                                  align="center"
                                  cellpadding="0"
                                  cellspacing="0"
                                  border="0"
                                  style="width: 600px; margin: 0 auto"
                                >
                                  <!--  EMAIL HEADER -->
                                  <!-- -------------- SSL   -->

                                  <tbody>
                                    
                                    <!-- -------------- END SSL -->

                                    <!-- -------------- CSB OR ISG HEADER -->
                                    <tr>
                                      <td valign="top" bgcolor="#ffffff" class="noneMobile">
                                        <table
                                          role="presentation"
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tbody>
                                            <tr>
                                              <td
                                                valign="top"
                                                style="padding: 0px"
                                                class="m-p-15"
                                              >
                                                <table
                                                  role="presentation"
                                                  width="100%"
                                                  border="0"
                                                  cellspacing="0"
                                                  cellpadding="0"
                                                >
                                                  <tbody>
                                                    <tr>
                                                                                                         
                                                      <!-- ### FUNDING  ### -->

                                                      <td align="center">
                                                        <table
                                                          cellpadding="0"
                                                          cellspacing="0"
                                                        >
                                                          <tbody>
                                                            <tr>
                                                              <td align="right">
                                                                <img
                                                                  src="cid:icongarbuio"
                                                                  alt="Garbuio"
                                                                  style="
                                                                    display: block;
                                                                    border: 0;
                                                                    width: 100px;
                                                                  "
                                                                />
                                                              </td>
                                                            </tr>                                                            
                                                          </tbody>
                                                        </table>
                                                      </td>

                                                      <!--  END FUNDING   -->
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td height="15"></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>

                                    <!--[if !mso]><!-->
                                    <tr>
                                      <td
                                        class="showMobile"
                                        bgcolor="#ffffff"
                                        style="padding-bottom: 10px"
                                      >
                                        <table
                                          role="presentation"
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tbody>
                                            <tr>                                  
                                              <td align="center">
                                                <table
                                                  role="presentation"
                                                  width="100%"
                                                  border="0"
                                                  cellspacing="0"
                                                  cellpadding="0"
                                                >
                                                  <tbody>
                                                    <tr>
                                                      <td width="100%" align="right">
                                                        <table
                                                          cellpadding="0"
                                                          cellspacing="0"
                                                        >
                                                        </table>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <!--<![endif]-->
                                    <!-- -------------- END CSB OR ISG HEADER   -->

                                    <!-- -------------- COUNTDOWN TIMER  ### -->

                                    <tr style="
                                    outline: none;
                                    background-color: #2bc220;
                                    text-decoration: none;
                                    display: flex;
                                    height: 10px;
                                  ">
                                    </tr>

                                    <!-- -------------- COUNTDOWN TIMER END / ### -->

                                    <!-- ### HERO  ### -->
                                    <tr>
                                      <td width="600" align="center">
                                        <table cellpadding="0" cellspacing="0">
                                          <!---- HERO LAYOUT 1 START --->

                                          <tbody>
                                            <tr>
                                              <td
                                                align="center"
                                                valign="top"
                                                style="padding-top: 0px"
                                              >
                                                <table
                                                  role="presentation"
                                                  border="0"
                                                  cellspacing="0"
                                                  cellpadding="0"
                                                >
                                                  <tbody>
                                                    <tr>
                                                      <td align="center" valign="middle">
                                                        <a
                                                          ><img
                                                            src="cid:bannerimg"
                                                            alt="Garbuio"
                                                            border="0"
                                                            style="
                                                              display: flex;
                                                              font-size: 16px;
                                                              color: #0076ce;
                                                              width: 70%;
                                                            "
                                                            class="wrap"
                                                        /></a>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>

                                    <tr style="
                                    outline: none;
                                    background-color: #2bc220;
                                    text-decoration: none;
                                    display: flex;
                                    height: 10px;
                                  ">
                                    </tr>

                                    <tr>
                                      <td height="20"></td>
                                    </tr>
                                    <!-- ### BANNER 1 IMAGE  ### -->
                                    <tr>
                                      <td
                                        bgcolor="#ffffff"
                                        align="center"
                                        valign="top"
                                        style="padding: 0px"
                                      >
                                        <table
                                          dir="rtl"
                                          role="presentation"
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tbody>
                                            <tr>
                                              <td align="center" style="padding: 0px">
                                                <table
                                                  width="100%"
                                                  role="presentation"
                                                  border="0"
                                                  cellspacing="0"
                                                  cellpadding="0"
                                                >
                                                  <tbody>
                                                    <tr>
                                                      <th
                                                        align="left"
                                                        valign="top"
                                                        class="stack"
                                                      >
                                                        <table
                                                          role="presentation"
                                                          width="100%"
                                                          border="0"
                                                          cellspacing="0"
                                                          cellpadding="0"
                                                        >
                                                          <tbody>
                                                            <tr>
                                                              <td
                                                                align="center"
                                                                valign="middle"
                                                                class="product-padding-b15"
                                                              >
                                                                <a
                                                                  href=""
                                                                  _label="Banner_1"                                                      
                                                                  ><img
                                                                    src="cid:bannerimg2"
                                                                    alt="Garbuio"
                                                                    border="0"
                                                                    style="
                                                                    display: block;
                                                                    width: 70%;
                                                                    "
                                                                /></a>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      </th>
                                                      <th
                                                        align="center"
                                                        valign="top"
                                                        class="stack"
                                                        style="padding: 0 0px"
                                                      >
                                                        <table
                                                          dir="ltr"
                                                          role="presentation"
                                                          width="100%"
                                                          border="0"
                                                          cellspacing="0"
                                                          cellpadding="0"
                                                        >
                                                          <tbody>
                                                            <tr>
                                                              <td
                                                                style="padding: 0px 20px"
                                                                class="m-pb-20"
                                                              >
                                                                <table
                                                                  role="presentation"
                                                                  width="100%"
                                                                  border="0"
                                                                  cellspacing="0"
                                                                  cellpadding="0"
                                                                >
                                                                  <tbody>
                                                                    <tr>
                                                                      <td
                                                                        align="left"
                                                                        style="
                                                                          font-family: Arial,
                                                                            Helvetica,
                                                                            sans-serif;
                                                                        "
                                                                        class="align-center"
                                                                      >
                                                                        <table
                                                                          role="presentation"
                                                                          width="100%"
                                                                          border="0"
                                                                          cellspacing="0"
                                                                          cellpadding="0"
                                                                        >
                                                                          <tbody>
                                                                            <tr>
                                                                              <td
                                                                                height="20"
                                                                                class="noneMobile"
                                                                              >
                                                                                &nbsp;
                                                                              </td>
                                                                            </tr>

                                                                            

                                                                            <tr>
                                                                              <td
                                                                                style="
                                                                                  font-family: Arial,
                                                                                    Helvetica,
                                                                                    sans-serif;
                                                                                  font-size: 11px;
                                                                                  line-height: 14px;
                                                                                  color: #444444;                                                                      
                                                                                "
                                                                                class="align-center"
                                                                              >
                                                                                <a
                                                                                  href=""
                                                                                  _label="INFO"
                                                                                  target="_blank"
                                                                                  style="
                                                                                    outline: none;
                                                                                    color: #444444;
                                                                                    text-decoration: none;                                                                        
                                                                                  "
                                                                                  >ESSA MENSAGEM É AUTOMÁTICA, FAVOR NÃO RESPONDER.

                                                                                    <h5><strong>Olá, '.$dtname.'.</strong><br>
                                                                                    <strong>Você tem uma mensagem enviada de:</strong><br>
                                                                                    <strong>Nome: '.$nome.'.</strong><br>
                                                                                    <strong>Email: '.$email.'</strong><br><br>

                                                                                    <p>
                                                                                    <strong style="color: red;">Seu pedido de reserva foi confirmado.</strong>
                                                                                    </p><br>

                                                                                    <strong>Informações da reserva:</strong>
                                                                                    <ul>
                                                                                        <li>Locação: '.$locacao.'</li>
                                                                                        <li>Descrição: '.$description.'</li>
                                                                                        <li>Dia da Semana: '.$weekday.'</li>
                                                                                        <li>Data: '.$checkin.'</li>
                                                                                        <li>Data Final: '.$checkout.'</li>
                                                                                        <li>Hora de Início: '.$checkin_time.'</li>
                                                                                        <li>Hora Final: '.$checkout_time.'</li><br>
                                                                                    </ul>

                                                                                    <strong>Acesse o portal para visualizar sua reserva.</strong></h5>
                                                                                </a>
                                                                              </td>
                                                                            </tr>

                                                                            <tr>
                                                                              <td
                                                                                height="10"
                                                                              ></td>
                                                                            </tr>

                                                                            <tr>
                                                                              <td
                                                                                class="align-center m-px-5 m-pt-15"
                                                                                valign="top"
                                                                              >
                                                                                <table
                                                                                
                                                                                  role="presentation"
                                                                                  border="0"
                                                                                  cellpadding="0"
                                                                                  cellspacing="0"
                                                                                  class="wrap"
                                                                                >
                                                                                  <tbody>
                                                                                    <tr>
                                                                                      <td
                                                                                      
                                                                                        valign="middle"
                                                                                        align="CENTER"
                                                                                        style="
                                                                                          font-family: Arial,
                                                                                            Helvetica,
                                                                                            sans-serif;
                                                                                          font-size: 14px;
                                                                                          mso-line-height-rule: exactly;
                                                                                          line-height: 16px;
                                                                                          font-weight: 700;
                                                                                          color: #444444;
                                                                                          letter-spacing: 0.03em;
                                                                                      "
                                                                                        class="cta-button"
                                                                                      >
                                                                                        <a
                                                                                        
                                                                                          href="http://agenda.garbuio.int/reservgarb/index.php"
                                                                                          _label="Página Inicial"
                                                                                          target="_blank"
                                                                                          style="
                                                                                            color:#444444;
                                                                                            border: 2px
                                                                                              solid
                                                                                              #444444;
                                                                                            text-decoration: none;
                                                                                            padding: 20px
                                                                                              20px;
                                                                                            display: block;                                                                                        
                                                                                          "
                                                                                          >Página Inicial
                                                                                        </a>
                                                                                      </td>
                                                                                    </tr>
                                                                                  </tbody>
                                                                                </table>
                                                                              </td>
                                                                            </tr>
                                                                          </tbody>
                                                                        </table>
                                                                      </td>
                                                                    </tr>
                                                                  </tbody>
                                                                </table>
                                                              </td>
                                                            </tr>
                                                          </tbody>
                                                        </table>
                                                      </th>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td width="100%" align="center">
                                        <table cellpadding="0" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td align="center">
                                                <table cellpadding="0" cellspacing="0">
                                                  <tbody>
                                                    <tr>
                                                      <td
                                                        class="social-icon"
                                                        align="center"
                                                        style="padding: 0 5px"
                                                      >
                                                        <a
                                                          href="https://www.instagram.com/transportadoragarbuio/?theme=dark"
                                                          _label="Instagram"
                                                          target="_blank"
                                                          style="outline: none"
                                                          ><img
                                                            src="cid:iconinsta"
                                                            alt="Instagram"
                                                            style="border: 0"
                                                        /></a>
                                                      </td>
                                                      <td
                                                        class="social-icon"
                                                        align="center"
                                                        style="padding: 0 5px"
                                                      >
                                                        <a
                                                          href="https://api.whatsapp.com/send/?phone=5519982280312&text&type=phone_number&app_absent=0"
                                                          _label="Whatsapp"
                                                          target="_blank"
                                                          style="outline: none"
                                                          ><img
                                                            src="cid:iconwhats"
                                                            alt="Whatsapp"
                                                            style="
                                                            border: 0;
                                                            "
                                                        /></a>
                                                      </td>
                                                      <td
                                                        class="social-icon"
                                                        align="center"
                                                        style="padding: 0 5px"
                                                      >
                                                        <a
                                                          href="https://www.facebook.com/garbuiotransportadora"
                                                          _label="Facebook"
                                                          target="_blank"
                                                          style="outline: none"
                                                          ><img
                                                            src="cid:iconface"
                                                            alt="Facebook"
                                                            style="border: 0"
                                                        /></a>
                                                      </td>
                                                      <td
                                                        class="social-icon"
                                                        align="center"
                                                        style="padding: 0 5px"
                                                      >
                                                        <a
                                                          href="https://www.linkedin.com/company/transportadoragarbuio/mycompany/"
                                                          _label="LinkedIn"
                                                          target="_blank"
                                                          style="outline: none"
                                                          ><img
                                                            src="cid:iconlinkedin"
                                                            alt="LinkedIn"
                                                            style="border: 0"
                                                        /></a>
                                                      </td>
                                                    </tr>
                                                  </tbody>
                                                </table>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td valign="top" style="padding: 20px">
                                        <table
                                          role="presentation"
                                          width="100%"
                                          border="0"
                                          cellspacing="0"
                                          cellpadding="0"
                                        >
                                          <tbody>
                                            <tr>
                                              <td
                                                valign="top"
                                                style="line-height: 1px; font-size: 1px"
                                              >
                                                &nbsp;
                                              </td>
                                            </tr>

                                            <tr>
                                              <td
                                                align="center"
                                                valign="top"
                                                style="
                                                  text-align: center;
                                                  color: rgb(68, 68, 68);
                                                  line-height: 16px;
                                                  font-family: Cachet, sans-serif;
                                                  font-size: 12px;
                                                  font-weight: normal;
                                                "
                                              >
                                                <a
                                                  style="
                                                    color: rgb(0, 118, 206);
                                                    text-decoration: none;
                                                  "
                                                  href="https://www.garbuio.com.br"
                                                  _label="Empresa"
                                                  target="_blank"
                                                  >Empresa </a
                                                >&nbsp;|&nbsp;
                                                <a
                                                  style="
                                                    color: rgb(0, 118, 206);
                                                    text-decoration: none;
                                                  "
                                                  href="https://central.tiflux.com.br/r/externals/tickets/new/3aa2d6da09887613520201a9e460c267016c8c15" target="_blank"><span class="btn btn-info form-control"
                                                  _label="Abrir Ticket"
                                                  target="_blank"
                                                  >Abrir Ticket </a
                                                >&nbsp;|&nbsp;
                                                <a
                                                  style="
                                                    color: rgb(0, 118, 206);
                                                    text-decoration: none;
                                                  "
                                                  href="https://www.linkedin.com/in/guilherme-machancoses-772986233/"
                                                  _label="GuiMac"
                                                  target="_blank"
                                                >
                                                GuiMac
                                                </a>&#10084;&#65039;<p style="color:#0080ff">2024</p>
                                              </td>
                                            </tr>

                                            <tr>
                                              <td height="20"></td>
                                            </tr>
                                            
                                            <!-- ### FOOTER / ### -->
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>

                            <tr>
                              <td
                                class="hide"
                                align="center"
                                height="1"
                                style="font-size: 1px; line-height: 1px"
                              >
                                <table
                                  role="presentation"
                                  class="hide"
                                  width="600"
                                  align="center"
                                  cellpadding="0"
                                  cellspacing="0"
                                  style="min-width: 600px; mso-hide: all"
                                  border="0"
                                >
                                  <tbody>
                                    <tr>
                                      <td
                                        style="
                                          font-size: 0px;
                                          line-height: 0px;
                                          border: 0px;
                                        "
                                      >
                                        &nbsp;
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!-- --------------ADD Impression Tag HERE -->
                <style>
                  @media print {
                    #_two50 {
                      background-image: url("");
                    }
                  }
                  blockquote #_two50,
                  #mailContainerBody #_two50,
                  div.OutlookMessageHeader,
                  table.moz-email-headers-table {
                    background-image: url("");
                  }
                </style>
                <div id="_two50"></div>
                <img
                  id="_two50_img"
                  src=""
                  width="1"
                  height="1"
                  style="
                    margin: 0 !important;
                    padding: 0 !important;
                    border: 0 !important;
                    height: 1px !important;
                    width: 1px !important;
                  "
                />

                <img
                  src=""
                  border="0"
                  height="1"
                  width="1"
                  alt="Advertisement"
                />

                <img
                  height="0"
                  width="0"
                  alt=""
                  src=""
                />
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