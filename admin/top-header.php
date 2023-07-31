<div id="content" class="active">
<?php
    // query for total pending
    $q_p = $conn->query("SELECT SUM(total) AS total FROM (
                                                        SELECT COUNT(*) AS total FROM lc_period WHERE mensagens_id = 2
                                                        UNION ALL
                                                        SELECT COUNT(*) AS total FROM locacao WHERE status_id = 1 AND lc_period_id IS NULL
                                                    ) AS subquery; ") or die(mysqli_error($conn));
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
        <button id="sidebar-collapse" class="d-xl-block d-lg-block d-md-none d-none" hidden="hidden">
            <span  class="material-icons">arrow_back_ios</span>
        </button>
        <a class="navbar-brand" href="#">
            <img class="logoeinstein2" src="../img/lg_garbuio.png">
        </a>
        <button class="d-inline-block d-lg-none ml-auto more-button" type="button" data-toggle="collapse"
                data-target="#navbarcollapse" aria-controls="navbarcollapse" aria-expanded="false" aria-label="Toggle">
                <i style="font-size:35px;padding:10px;color:white" class="material-icons">menu</i>
        </button>        
        <div class="collapse navbar-collapse d-lg-block d-xl-block d-sm-none d-md-none d-none justify-content-end" id="navbarcollapse">
            <ul class="nav navbar-nav ml-auto">

                <li class="nav-item dropdown">
                    <a class="nav-link" id="ligthbtn" data-toggle="dropdown">
                        <span style="cursor:pointer" class = "material-icons">lightbulb</span>
                    </a>                    
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" data-toggle="dropdown">
                        <span class="material-icons" >notifications</span>
                            <?php if ($f_p['total'] > 0) { ?>
                                <span style="color:white;border-radius:100%" name="notification" class="notification"><?php echo $f_p['total'] ?></span>
                            <?php } ?> 
                   </a>
                    <ul class="dropdown-menu" style="display:flex;align-items:center;justify-content:center;">
                        <li>
                            <?php $penlab = 'penlab'; ?>
                            <a href="reservlab.php?<?php echo $penlab?>" class="text-primary"><?php echo $pendente?></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown"><span style="cursor:pointer" class = "material-icons">person</span></a>
                    <ul class="dropdown-menu">
                    <li><a class="nav-link" href="logout.php" style="display:flex;align-items:center;justify-content:center;"><span class = "material-icons text-logout" style="color:#5faa4f" >logout</span><strong>&#160SAIR</strong></span></a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" data-toggle="dropdown">
                        <span class="material-icons">settings</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                        <a href = "reservlab.php?alter-account" style="display:flex;align-items:center;justify-content:center;" class="text-primary">Alterar seu dados</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
			 
			  </nav>
	
		   
		   
		   