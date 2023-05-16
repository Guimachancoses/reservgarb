<?php
    // destrói a sessão atual
    session_start();
    session_destroy();

    // OU

    // limpa os cookies de autenticação
    // redireciona para a página de login
    setcookie('sessao', '', time() - 3600);
    header('Location: ../index.php', true, 302);
    exit();
?>