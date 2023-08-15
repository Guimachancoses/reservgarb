<?php
    require_once 'validate.php';
    // destrói a sessão atual
    session_start();
    session_destroy();
    echo "<script>alert('Sua sessão foi encerrada por inatividade');</script>";
    // OU

    // limpa os cookies de autenticação
    // redireciona para a página de login
    setcookie('sessao', '', time() - 3600);
    header('Location: ../index.php', true, 302);
    exit();
?>