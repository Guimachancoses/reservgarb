<div id="content">
<?php
    // query for total pending
    $q_p = $conn->query("SELECT COUNT(*) as total FROM `locacao` WHERE `status_id` = 1 ") or die(mysqli_error());
    $f_p = $q_p->fetch_array();

    // query for pending message
    $q_msg = $conn->query("SELECT ms.assunto as pendente FROM mensagens as ms INNER JOIN locacao as lc ON lc.mensagens_id = ms.mensagens_id	WHERE lc.mensagens_id = 2") or die(mysqli_error());
    if (mysqli_num_rows($q_msg) > 0) {
        $f_msg = $q_msg->fetch_array();
        $pendente = $f_msg['pendente'];
    } else {
        $pendente = "Sem pendências";
    }
?>

<!-- top navbar design -->
<div class="top-navbar">
    <nav class="navbar  navbar-expand-lg">
        <button type="button" id="sidebar-collapse" class="d-xl-block d-lg-block d-md-none d-none">
            <span class="material-icons">arrow_back_ios</span>
        </button>
        <a class="navbar-brand" href="#">
            <img class="logoeinstein" src="../img/lg_garbuio.png">
        </a>
        <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
                data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle">
                <i style="font-size:35px;padding:10px;color:white" class="material-icons">menu</i>
        </button>        
        <div class="collapse navbar-collapse d-lg-block d-xl-block d-sm-none d-md-none d-none" id="navbarcollapse">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" data-toggle="dropdown">
                        <span class="material-icons" >notifications</span>
                            <?php if ($f_p['total'] > 0) { ?>
                                <span name="notification" class="notification"><?php echo $f_p['total'] ?></span>
                            <?php } ?> 
                   </a>
                    <ul class="dropdown-menu">
                        <li>
                            <?php $penlab = 'penlab'; ?>
                            <a href="reservlab.php?<?php echo $penlab?>" class="text-primary"><?php echo $pendente?></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown"><span style="cursor:pointer" class = "material-icons">person</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="logout.php"><span class = "material-icons text-logout">logout</span><strong> LOGOUT</strong></span></a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" data-toggle="dropdown">
                        <span class="material-icons">settings</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href = "reservlab.php?alter-account" class="text-primary">Alterar seu dados</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
			 
			  </nav>
		   </div>
		   
		   
		   