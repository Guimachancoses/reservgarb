<nav id="sidebar" class="active">

<?php
    require_once 'validate.php';
    // Query for mode color page
    $modeColor = $conn->query("SELECT colorMode FROM set_color WHERE users_id = $_SESSION[users_id]");

    // Assuming $modeColor is a valid result set
    if (mysqli_num_rows($modeColor) > 0) {
        $c_color = $modeColor->fetch_array();
        $colorMode = $c_color['colorMode'];

        // Check the value of $colorMode and set the corresponding variable
        if ($colorMode == 0) {
            $darkMode = true;
        } else {
            $lightMode = true;
        }
    } else {
        // If no results found, assume dark mode as default
        $darkMode = true;
    }

    // query for total pending
    $q_p = $conn->query("SELECT SUM(total) AS total FROM (
                                                    SELECT COUNT(*) AS total FROM lc_period WHERE mensagens_id = 37
                                                    UNION ALL
                                                    SELECT COUNT(*) AS total FROM locacao WHERE status_id = 1 AND lc_period_id IS NULL
                                                ) AS subquery; ") or die(mysqli_error($conn));
    $f_p = $q_p->fetch_array();

    // query for total pendding for locacao
		$q_loc = $conn->query("SELECT COUNT(*) as total FROM `locacao` WHERE status_id = 1 && lc_period_id IS NULL") or die(mysqli_error($conn));
		$f_loc = $q_loc->fetch_array();

    // query for total pendding for lc_period
		$q_period = $conn->query("SELECT COUNT(*) as total FROM `lc_period` WHERE mensagens_id = 37") or die(mysqli_error($conn));
		$f_period = $q_period->fetch_array();
?>
            <div class="sidebar-header">
                <h3 style="font-family: 'Monte Serrat', sans-serif; letter-spacing: 0.1px;">
                    <img src="../img/logo_title.png" class="img-fluid" />
                        <span><strong>Reserve Garbuio</strong></span>
                </h3>
            <ul class="list-unstyled components">
			    <li>
                    <a href="reservlab.php" class="dashboard"><i class="material-icons">home</i><span>Página Inicial</span></a>
                </li>		
		      <div class="small-screen navbar-display">
                <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#homeSubmenu0" data-toggle="collapse" aria-expanded="false">
					    <i class="material-icons">notifications</i>
                            <?php if ($f_p['total'] > 0) { ?>
                                <span name="notification" class="notification"><?php echo $f_p['total'] ?></span>
                            <?php } ?>
                    <span>Notificações</span></a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu0">
                        <?php
                            // query for pending message
                            $q_msg = $conn->query("SELECT pendente FROM (
                                                    SELECT DISTINCT
                                                        ms.assunto as pendente
                                                    FROM mensagens as ms 
                                                    LEFT JOIN locacao as lc ON lc.mensagens_id = ms.mensagens_id
                                                    WHERE lc.mensagens_id = 2 && lc.lc_period_id IS NULL
                                                    UNION ALL
                                                    SELECT DISTINCT
                                                        ms.assunto as pendente
                                                    FROM mensagens as ms
                                                    LEFT JOIN lc_period as lp ON lp.mensagens_id = ms.mensagens_id
                                                    WHERE lp.mensagens_id = 37
                                                ) AS subquery
                                                ORDER BY pendente
                                                LIMIT 2") or die(mysqli_error($conn));
                            if (mysqli_num_rows($q_msg) > 0) {
                                while ($f_msg = $q_msg->fetch_array()) {
                                    $pendente = $f_msg['pendente'];
                                    ?>
                                    <?php if ($pendente === "Solicitações pendentes!") { ?>
                                        <li>
                                            <?php $penlab = 'penlab'; ?>
                                            <a href="reservlab.php?<?php echo $penlab ?>" class="text-primary"><small><?php echo $pendente ?></small></a>
                                        </li>
                                    <?php } elseif ($pendente === "Reserva Por Período Pendente!") { ?>
                                        <li>
                                            <?php $perpen = 'perpen'; ?>
                                            <a href="reservlab.php?<?php echo $perpen ?>" class="text-primary"><small><?php echo $pendente ?></small></a>
                                        </li>
                                    <?php } ?>
                                    <?php
                                }
                            } else {
                        ?>
                            <li><small>Sem pendências</small></li>
                        <?php
                            }
                        ?>                                    
                    </ul>
                </li>
				
				 <li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" >
                            <i class="material-icons">person</i><span><small><?php echo $name;?></small></span></a>
                            <ul class="collapse list-unstyled menu" id="homeSubmenu1">
                                <li>
                                    <a class="nav-link" href="logout.php"><i class="material-icons text-logout">logout</i><span class="text-primary"><strong><small>Sair</small></strong></span></a>
                                </li>
                            </ul>
                    </li>
                </li>
				
				<li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" >
                            <i class="material-icons">settings</i><span>Configuração</span></a>
                            <ul class="collapse list-unstyled menu" id="homeSubmenu2">
                                <li>
                                    <a class="nav-link" href="reservlab.php?alter-account">
                                    <i  class="material-icons" style="color:orange">auto_fix_normal</i><span class="text-primary"><small>Alterar Seu Dados</small></span></a>
                                </li>
                                <li>
                                    <?php if (isset($lightMode)) { ?>
                                        <a class="nav-link toggle-mode dark-btn" id="darkbtn" name="color" data-value="0">
                                        <i  class="material-icons" style="color:yellow">light_mode</i><small class="text-primary">Modo Claro</small></a>
                                    <?php } elseif (isset($darkMode)) { ?>
                                        <a class="nav-link toggle-mode light-btn" id="lightbtn" name="color" data-value="1">
                                        <i class="material-icons" style="color:black">dark_mode</i><small class="text-primary">Modo Escuro</small></a>
                                    <?php } ?>
                                </li>
                            </ul>
                    </li>
                </li>
				</div>
			
			
                <li class="dropdown">
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" >
					<i class="material-icons">person_add</i><span>Usuários</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu1">
                            
                        <li>
                            <?php $adduser = 'adduser';
                                ?>
                            <a href="reservlab.php?<?php echo $adduser?>"><i class="material-icons" style="color:red">add</i><small>Cadastrar Usuários</small></a>
                        </li>

                        <li>
                            <?php $edituser = 'edituser';
                            ?>
                            <a href="reservlab.php?<?php echo $edituser?>"><i class="material-icons" style="color:orange">edit</i><small>Editar Usuários</small></a>
                        </li>
                            
                        <li>
                            <?php $gpapp = 'gpapp';
                            ?>
                            <a href="reservlab.php?<?php echo $gpapp?>"><i class="material-icons" style="color:#4caf50">groups</i><small>Grupo Aprovador</small></a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>
				
				<li class="dropdown">
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false">
					<i class="material-icons searching">add_home_work</i><span>Salas</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu2">

                        <li>
                            <?php $addlab = 'addlab';
                                ?>
                            <a href="reservlab.php?<?php echo $addlab?>"><i class="material-icons" style="color:red">add</i><small>Cadastrar Sala</small></a>
                        </li>

                        <li>
                            <?php $editlab = 'editlab';
                                ?>
                            <a href="reservlab.php?<?php echo $editlab?>"><i class="material-icons" style="color:orange">edit</i><small>Editar Salas</small></a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false">
					<i class="material-icons searching">directions_car_filled</i><span>Veículos</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu3">

                        <li>
                            <?php $addvei = 'addvei';
                                ?>
                            <a href="reservlab.php?<?php echo $addvei?>"><i class="material-icons" style="color:red">add</i><small>Cadastrar Veículo</small></a>
                        </li>

                        <li>
                            <?php $editvei = 'editvei';
                                ?>
                            <a href="reservlab.php?<?php echo $editvei?>"><i class="material-icons" style="color:orange">edit</i><small>Editar Veículo</small></a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false">
					<i class="material-icons searching">laptop_mac</i><span>Equipamentos</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu4">

                        <li>
                            <?php $addequip = 'add-equip';
                                ?>
                            <a href="reservlab.php?<?php echo $addequip?>"><i class="material-icons" style="color:red">add</i><small>Cadastrar Equipamento</small></a>
                        </li>

                        <li>
                            <?php $editequip = 'editequip';
                                ?>
                            <a href="reservlab.php?<?php echo $editequip?>"><i class="material-icons" style="color:orange">edit</i><small>Editar Equipamento</small></a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false">
					    <i class="material-icons">pending</i>
                             <?php if ($f_loc['total'] > 0) { ?>
                                <span name="notification" class="notification"><?php echo $f_loc['total'] ?></span>
                            <?php } ?>
                        <span>Solicitações</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu5">

                        <li>
                            <?php $penlab = 'penlab';
                                ?>
                            <a <?php if ($f_loc['total'] > 0) { ?>style="background-color: rgba(255, 253, 253, 0.2);"<?php } ?> href="reservlab.php?<?php echo $penlab?>"><i class="material-icons" style="color:#e91e63" >pending_actions</i><small>Solicitações Pendentes</small></a>
                        </li>

                        <li>
                            <?php $reslab = 'reslab';
                                ?>
                            <a href="reservlab.php?<?php echo $reslab?>"><i class="material-icons" style="color:#4caf50" >lock_clock</i><small>Reservados</small></a>
                        </li>

                        <li>
                            <?php $finlab = 'finlab';
                                ?>
                            <a href="reservlab.php?<?php echo $finlab?>"><i class="material-icons" style="color:#00bcd4">history</i><small>Histórico de Reservas</small></a>
                        </li>
                    </ul>
                </li>
				
				 <li>
                    <?php $calender = 'calender';
                        ?>
                    <a href="reservlab.php?<?php echo $calender?>"><i class="material-icons" >calendar_month</i><span>Calendário</span></a>
                </li>
                
                <li class="dropdown">
                    <a href="#pageSubmenu6" data-toggle="collapse" aria-expanded="false">
					<i class="material-icons">timeline</i>
                        <?php if ($f_period['total'] > 0) { ?>
                            <span name="notification" class="notification"><?php echo $f_period['total'] ?></span>
                        <?php } ?>
                    <span>Reservar por Período</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu6">

                        <li>
                            <?php $addpd = 'addpd';
                                ?>
                            <a href="reservlab.php?<?php echo $addpd?>"><i class="material-icons" style="color:red">add</i><span><small>Add. Reserva</small></span></a>
                        </li> 

                        <li>
                            <?php $perpen = 'perpen';
                                ?>
                            <a <?php if ($f_period['total'] > 0) { ?>style="background-color: rgba(255, 253, 253, 0.2);"<?php } ?> href="reservlab.php?<?php echo $perpen?>"><i class="material-icons" style="color:#e91e63" >pending_actions</i><small>Reservas Pendentes</small></a>
                        </li>

                        <li>
                            <?php $perres = 'perres';
                                ?>
                            <a href="reservlab.php?<?php echo $perres?>"><i class="material-icons" style="color:#4caf50">lock_clock</i><small>Reservados</small></a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu7" data-toggle="collapse" aria-expanded="false">
                    <i class="material-icons">storage</i><span>Banco de Dados</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu7">

                        <li>
                            <?php $deluser = 'deluser';
                                ?>
                            <a href="reservlab.php?<?php echo $deluser?>"><i class="material-icons" style="color:#e91e63" >warning</i><small>Relações do Usuário</small></a>
                        </li>

                        <li>
                            <?php $dellab = 'dellab';
                                ?>
                            <a href="reservlab.php?<?php echo $dellab?>"><i class="material-icons" style="color:#e91e63" >warning</i><small>Relações da Sala</small></a>
                        </li>

                        
                        <li>
                            <?php $delvei = 'delvei';
                                ?>
                            <a href="reservlab.php?<?php echo $delvei?>"><i class="material-icons" style="color:#e91e63" >warning</i><small>Relações do Veículo</small></a>
                        </li>

                        
                        <li>
                            <?php $delequi = 'delequi';
                                ?>
                            <a href="reservlab.php?<?php echo $delequi?>"><i class="material-icons" style="color:#e91e63" >warning</i><small>Relações do Equipamento</small></a>
                        </li>

                        <li>
                            
                        </li>
                    </ul>
                </li>

                </br>

                <li>
                    <a href="https://central.tiflux.com.br/r/externals/tickets/new/3aa2d6da09887613520201a9e460c267016c8c15" target="_blank"><span class="btn btn-info form-control" style="color:white">Abrir ticket</span></a>                   
                </li>
            </ul>

           
        </nav>