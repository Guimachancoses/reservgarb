<div id="content" class="active">
<?php
    $session_id = $_SESSION['users_id'];
    // Query for mode color page
    $modeColor = $conn->query("SELECT colorMode FROM set_color WHERE users_id = $session_id") or die(mysqli_error($conn));

    // Assuming $modeColor is a valid result set
    if (mysqli_num_rows($modeColor) > 0) {
        $c_color = $modeColor->fetch_array();
        $colorMode = $c_color['colorMode'];
    
        // Check if $colorMode is not set or is NULL, then set it to "0"
        if (!isset($colorMode) || $colorMode === NULL) {
            $colorMode = 0;
        }
    
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
            WHERE ms.mensagens_id = 37
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
?>

<!-- top navbar design -->
<div class="top-navbar">
    <nav class="navbar  navbar-expand-lg">
        <button id="sidebar-collapse" class="d-xl-block d-lg-block d-md-none d-none" hidden="hidden">
            <span hidden="hidden"  class="material-icons">arrow_back_ios</span>
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
                <li>
                    <?php if (isset($lightMode)) { ?>
                        <a class="nav-link toggle-mode dark-btn" id="darkbtn" name="color" data-toggle="dropdown" data-value="0">
                            <span style="cursor:pointer" class="material-icons">light_mode</span>
                        </a>
                    <?php } elseif (isset($darkMode)) { ?>
                        <a class="nav-link toggle-mode light-btn" id="lightbtn" name="color" data-toggle="dropdown" data-value="1">
                            <span style="cursor:pointer" class="material-icons">dark_mode</span>
                        </a>
                    <?php } ?>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link " href="#" data-toggle="dropdown">
                        <span class="div-link material-icons" >notifications</span>
                            <?php if ($f_p['total'] > 0) { ?>
                                <span style="color:white;border-radius:100%" name="notification" class="notification"><?php echo $f_p['total'] ?></span>
                            <?php } ?> 
                   </a>
                   <ul class="dropdown-menu" style="display:flex;align-items:center;justify-content:center;flex-direction: column;">
                        <?php
                        // query for pending message
                        $q_msg = $conn->query("SELECT pendente FROM (
                                                SELECT 
                                                    ms.assunto as pendente
                                                FROM mensagens as ms 
                                                LEFT JOIN locacao as lc ON lc.mensagens_id = ms.mensagens_id
                                                WHERE lc.mensagens_id = 2
                                                UNION ALL
                                                SELECT 
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
                                        <a href="reservlab.php?<?php echo $penlab ?>" class="text-primary"><?php echo $pendente ?></a>
                                    </li>
                                <?php } elseif ($pendente === "Reserva Por Período Pendente!") { ?>
                                    <li>
                                        <?php $perpen = 'perpen'; ?>
                                        <a href="reservlab.php?<?php echo $perpen ?>" class="text-primary"><?php echo $pendente ?></a>
                                    </li>
                                <?php } ?>
                                <?php
                            }
                        } else {
                            ?>
                                <li class="text-primary"><small>Sem pendências</small></li>
                            <?php
                        }
                        ?>
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
                        <a href = "reservlab.php?alter-account" style="display:flex;align-items:center;justify-content:center;" class="text-primary">Alterar sua senha</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
			 
			  </nav>
	
              <script>
    $(document).ready(function() {
        // Função para lidar com o clique nas linhas
        $('.toggle-mode').on('click', function() {
            // Obtém o valor do atributo data-value
            var modeValue = $(this).data('value');

            // Exibir o valor no console para verificar se está correto
            console.log("Valor capturado pelo GET: " + modeValue);

            // Faz a chamada à API usando fetch
            fetch('change_color_query.php?color=' + modeValue, {
                method: 'GET'
            })
            .then(response => response.text())
            .then(data => {
                // Ação após o sucesso, se necessário
                console.log(data);
            })
            .catch(error => {
                // Tratar erros, se necessário
                console.log(error);
            });
        });
    });
</script>	   
		   
		   