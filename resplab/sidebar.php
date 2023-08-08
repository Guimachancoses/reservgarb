<nav id="sidebar" class="active">

<?php
    $session_id = $_SESSION['users_id'];
    // Query for mode color page
    $modeColor = $conn->query("SELECT colorMode FROM set_color WHERE users_id = $session_id");

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
    // query for total pending
    $q_p2 = $conn->query("SET @groupId = (
        SELECT approver_id
        FROM gp_approver
        WHERE users_id = $session_id
    )");
    $q_p = $conn->query("SELECT SUM(total) AS total FROM (
        SELECT
        COUNT(*) AS total
        FROM `lc_period` as lc
        LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
        INNER JOIN `users` as u ON u.users_id = lc.users_id
        LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
        LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
        INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
        WHERE ms.mensagens_id = 37 AND lc.users_id != $session_id
            AND (
                (@groupId = 1) -- Administrador
                OR
                (@groupId = 2 AND lc.vehicle_id IS NOT NULL) -- Veículos
                OR
                (@groupId = 3 AND lc.equip_id IS NOT NULL) -- Equipamentos
                OR
                (@groupId = 4 AND lc.room_id IS NOT NULL) -- Salas
            )
    UNION ALL
        SELECT
        COUNT(*) AS total
        FROM `locacao` as lc
        LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
        INNER JOIN `users` as u ON u.users_id = lc.users_id
        LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
        LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
        INNER JOIN `status` st ON st.status_id = lc.status_id
        INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
        WHERE
            lc.status_id = 1
            AND lc.users_id != $session_id
            AND ms.mensagens_id = 2
            AND lc.lc_period_id IS NULL
            AND (
                (@groupId = 1) -- Administrador
                OR
                (@groupId = 2 AND lc.vehicle_id IS NOT NULL) -- Veículos
                OR
                (@groupId = 3 AND lc.equip_id IS NOT NULL) -- Equipamentos
                OR
                (@groupId = 4 AND lc.room_id IS NOT NULL) -- Salas
            )
        ) AS subquery;") or die(mysqli_error($conn));
    $f_p = $q_p->fetch_array();

    // query for total pendding for locacao
    $q_loc2 = $conn->query("SET @groupId = (
                            SELECT approver_id
                            FROM gp_approver
                            WHERE users_id = $session_id
                        )");
    
    $q_loc = $conn->query("SELECT
                            COUNT(*) AS total
                            FROM `locacao` as lc
                            LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                            INNER JOIN `users` as u ON u.users_id = lc.users_id
                            LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                            LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                            INNER JOIN `status` st ON st.status_id = lc.status_id
                            INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
                            WHERE
                                lc.status_id = 1
                                AND lc.users_id != $session_id
                                AND ms.mensagens_id = 2
                                AND lc.lc_period_id IS NULL
                                AND (
                                    (@groupId = 1) -- Administrador
                                    OR
                                    (@groupId = 2 AND lc.vehicle_id IS NOT NULL) -- Veículos
                                    OR
                                    (@groupId = 3 AND lc.equip_id IS NOT NULL) -- Equipamentos
                                    OR
                                    (@groupId = 4 AND lc.room_id IS NOT NULL) -- Salas
                                )") or die(mysqli_error($conn));
    $f_loc = $q_loc->fetch_array();

    // query for total pendding for lc_period
    $q_period2 = $conn->query("SET @groupId = (
                            SELECT approver_id
                            FROM gp_approver
                            WHERE users_id = $session_id
                        )");
                        
    $q_period = $conn->query("SELECT
                            COUNT(*) AS total
                            FROM `lc_period` as lc
                            LEFT JOIN `laboratorios` as lb ON lb.room_id = lc.room_id
                            INNER JOIN `users` as u ON u.users_id = lc.users_id
                            LEFT JOIN `vehicles` as vs ON vs.vehicle_id = lc.vehicle_id
                            LEFT JOIN `equipment` as eq ON eq.equip_id = lc.equip_id
                            INNER JOIN `mensagens` as ms ON ms.mensagens_id = lc.mensagens_id
                            WHERE ms.mensagens_id = 37
                                AND (
                                    (@groupId = 1) -- Administrador
                                    OR
                                    (@groupId = 2 AND lc.vehicle_id IS NOT NULL) -- Veículos
                                    OR
                                    (@groupId = 3 AND lc.equip_id IS NOT NULL) -- Equipamentos
                                    OR
                                    (@groupId = 4 AND lc.room_id IS NOT NULL) -- Salas
                                )") or die(mysqli_error($conn));
	$f_period = $q_period->fetch_array();

    // query for pending message
    $q_msg = $conn->query("SELECT ms.assunto as pendente FROM mensagens as ms INNER JOIN locacao as lc ON lc.mensagens_id = ms.mensagens_id	WHERE lc.mensagens_id = 2") or die(mysqli_error($conn));
    if (mysqli_num_rows($q_msg) > 0) {
        $f_msg = $q_msg->fetch_array();
        $pendente = $f_msg['pendente'];
    } else {
        $pendente = "Sem pendências";
    }
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
                                                    WHERE lc.mensagens_id = 2 && lc.lc_period_id IS NULL && lc.users_id != $session_id
                                                    UNION ALL
                                                    SELECT DISTINCT
                                                        ms.assunto as pendente
                                                    FROM mensagens as ms
                                                    LEFT JOIN lc_period as lp ON lp.mensagens_id = ms.mensagens_id
                                                    WHERE lp.mensagens_id = 37 && lp.users_id != $session_id
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
                        <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false">
                            <i class="material-icons">person</i><span><?php echo $name;?></span></a>
                            <ul class="collapse list-unstyled menu" id="homeSubmenu1">
                                <li>
                                    <a class="nav-link" href="logout.php"><i class="material-icons text-logout">logout</i><span class="text-primary"><strong><small>Sair</small></strong></span></a>
                                </li>
                            </ul>
                    </li>
                </li>
				
				<li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false">
                            <i class="material-icons">settings</i>
                                <span>Configuração</span></a>
                            <ul class="collapse list-unstyled menu" id="homeSubmenu2">
                                <li>
                                    <a class="nav-link" href="reservlab.php?alter-account"><span><small>Alterar Sua Senha</small></span></a>
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

                <li>
                    <?php $listroom = 'listroom';
                    ?>
                    <a href="reservlab.php?<?php echo $listroom?>"><i class="material-icons">add_home_work</i><span>Salas</span></a>
                </li>



                <li>
                    <?php $editvei = 'editvei';
                        ?>
                    <a href="reservlab.php?<?php echo $editvei?>"><i class="material-icons">directions_car_filled</i><span>Veículos</span></a>
                </li>

                <li>
                    <?php $listequip = 'listequip';
                        ?>
                    <a href="reservlab.php?<?php echo $listequip?>"><i class="material-icons">api</i><span>Equipamentos</span></a>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false">
					<i class="material-icons">pending</i><span>Meus Pedidos</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu3">

                    <?php
                        $except = $conn->query("SELECT * FROM users WHERE firstname IN ('Orlando','Frederico', 'Helio') && users_id = '$_SESSION[users_id]'");
                        ?>

                    <?php if ($except->num_rows > 0): ?>
                            <!-- Oculte a <li> se houver alguma linha retornada pela consulta -->
                    <?php else: ?>
                            <li>
                                <?php $mybookp = 'mybookp'; ?>
                                <a href="reservlab.php?<?php echo $mybookp ?>"><i class="material-icons" style="color:#ff9800" >hourglass_empty</i><small>Meus Pedidos Pendentes</small></a>
                            </li>
                    <?php endif; ?>


                        <li>
                            <?php $mybookr = 'mybookr';
                                ?>
                            <a href="reservlab.php?<?php echo $mybookr?>"><i class="material-icons" style="color:#e91e63" >thumb_up_alt</i><small>Minhas Reservas</small></a>
                        </li>

                        <li>
                            <?php $mybookf = 'mybookf';
                                ?>
                            <a href="reservlab.php?<?php echo $mybookf?>"><i class="material-icons" style="color:#00bcd4" >real_estate_agent</i><small>Meus Pedidos Finalizados</small></a>
                        </li>

                        <li>
                        </li>
                    </ul>
                </li>
				
                <li class="dropdown">
                    <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false">
                        <i class="material-icons">edit_calendar</i>
                                <?php if ($f_loc['total'] > 0) { ?>
                                    <span name="notification" class="notification"><?php echo $f_loc['total'] ?></span>
                                <?php } ?>
                            <span>Aprovar Reservas</span></a>
                   <ul class="collapse list-unstyled menu" id="pageSubmenu4">

                       <li>
                           <?php $penlab = 'penlab';
                               ?>
                           <a <?php if ($f_loc['total'] > 0) { ?>style="background-color: rgba(255, 253, 253, 0.2);"<?php } ?> href="reservlab.php?<?php echo $penlab?>"><i class="material-icons" style="color:#e91e63">pending_actions</i><small>Solicitações Pendentes</small></a>
                       </li>
                       
                        <li>
                            <?php $reslab = 'reslab';
                                ?>
                            <a href="reservlab.php?<?php echo $reslab?>"><i class="material-icons" style="color:#4caf50" >lock_clock</i><small>Reservados<small></a>
                        </li>

                        <li>
                            <?php $finlab = 'finlab';
                                ?>
                            <a href="reservlab.php?<?php echo $finlab?>"><i class="material-icons" style="color:#00bcd4">history</i><small>Histórico de Locações<small></a>
                        </li>
                    </ul>
                </li>
				
				 <li>
                    <?php $calender = 'rscalender';
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

                </br>

                <li>
                <a href="https://central.tiflux.com.br/r/externals/tickets/new/3aa2d6da09887613520201a9e460c267016c8c15" target="_blank"><span class="btn btn-info form-control" style="color:white">Abrir ticket</span></a>                   
                </li>
               
               
            </ul>

           
        </nav>