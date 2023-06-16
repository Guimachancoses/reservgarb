<nav id="sidebar" class="active">

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
                    <a href="#homeSubmenu0" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
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
                        <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="material-icons">person</i><span><?php echo $name;?></span></a>
                            <ul class="collapse list-unstyled menu" id="homeSubmenu1">
                                <li>
                                    <a class="nav-link" href="logout.php"><i class="material-icons text-logout">logout</i><span class="text-primary"><strong> LOGOUT</strong></span></a>
                                </li>
                            </ul>
                    </li>
                </li>
				
				<li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
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
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >
					<i class="material-icons">person_add</i><span>Usuários</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu1">
                            
                        <li>
                            <?php $adduser = 'adduser';
                                ?>
                            <a href="reservlab.php?<?php echo $adduser?>"><i class="material-icons" style="color:red">add</i>Cadastrar Usuários</a>
                        </li>

                        <li>
                            <?php $edituser = 'edituser';
                            ?>
                            <a href="reservlab.php?<?php echo $edituser?>"><i class="material-icons" style="color:orange">edit</i>Editar Usuários</a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>
				
				<li class="dropdown">
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
					<i class="material-icons searching">add_home_work</i><span>Salas</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu2">

                        <li>
                            <?php $addlab = 'addlab';
                                ?>
                            <a href="reservlab.php?<?php echo $addlab?>"><i class="material-icons" style="color:red">add</i>Cadastrar Sala</a>
                        </li>

                        <li>
                            <?php $editlab = 'editlab';
                                ?>
                            <a href="reservlab.php?<?php echo $editlab?>"><i class="material-icons" style="color:orange">edit</i>Editar Salas</a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
					<i class="material-icons searching">directions_car_filled</i><span>Veículos</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu3">

                        <li>
                            <?php $addlab = 'addlab';
                                ?>
                            <a href="reservlab.php?<?php echo $addlab?>"><i class="material-icons" style="color:red">add</i>Cadastrar Veículo</a>
                        </li>

                        <li>
                            <?php $editlab = 'editlab';
                                ?>
                            <a href="reservlab.php?<?php echo $editlab?>"><i class="material-icons" style="color:orange">edit</i>Editar Veículo</a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
					<i class="material-icons searching">laptop_mac</i><span>Equipamentos</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu4">

                        <li>
                            <?php $addlab = 'addlab';
                                ?>
                            <a href="reservlab.php?<?php echo $addlab?>"><i class="material-icons" style="color:red">add</i>Cadastrar Equipamento</a>
                        </li>

                        <li>
                            <?php $editlab = 'editlab';
                                ?>
                            <a href="reservlab.php?<?php echo $editlab?>"><i class="material-icons" style="color:orange">edit</i>Editar Equipamento</a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
					<i class="material-icons">edit_calendar</i><span>Reservas</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu5">

                        <li>
                            <?php $penlab = 'penlab';
                                ?>
                            <a href="reservlab.php?<?php echo $penlab?>"><i class="material-icons" style="color:#e91e63" >pending_actions</i>Solicitações Pendentes</a>
                        </li>

                        <li>
                            <?php $reslab = 'reslab';
                                ?>
                            <a href="reservlab.php?<?php echo $reslab?>"><i class="material-icons" style="color:#4caf50" >lock_clock</i>Reservados</a>
                        </li>

                        <li>
                            <?php $finlab = 'finlab';
                                ?>
                            <a href="reservlab.php?<?php echo $finlab?>"><i class="material-icons" style="color:#00bcd4">history</i>Histórico de Reservas</a>
                        </li>
                    </ul>
                </li>
				
				 <li>
                    <?php $calender = 'calender';
                        ?>
                    <a href="reservlab.php?<?php echo $calender?>"><i class="material-icons" >calendar_month</i><span>Calendário</span></a>
                </li>
               
               
            </ul>

           
        </nav>