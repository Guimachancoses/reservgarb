<nav id="sidebar" class="active">

<?php
    // query for total pending
    $q_p = $conn->query("SELECT COUNT(*) as total FROM `locacao` WHERE `status_id` = 1 ") or die(mysqli_error($conn));
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
                    </a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu0">
                        <li>
                            <?php $penlab = 'penlab'; ?>
                            <a href="reservlab.php?<?php echo $penlab?>" class="text-primary"><?php echo $pendente?></a>
                        </li>                                    
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
                                    <a class="nav-link" href="reservlab.php?alter-account"><span class="text-primary">Alterar Seu Dados</span></a>
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
					<i class="material-icons">edit_calendar</i><span>Reservas</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu5">

                        <li>
                            <?php $penlab = 'penlab';
                                ?>
                            <a href="reservlab.php?<?php echo $penlab?>"><i class="material-icons" style="color:#e91e63" >pending_actions</i><small>Solicitações Pendentes</small></a>
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
                    <i class="material-icons">storage</i><span>Banco de Dados</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu6">

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
            </ul>

           
        </nav>