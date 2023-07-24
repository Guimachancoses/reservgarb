<nav id="sidebar" class="active">

<?php
    // query for total pending
    $q_p = $conn->query("SELECT COUNT(*) as total FROM `locacao` WHERE `status_id` = 1 ") or die(mysqli_error($conn));
    $f_p = $q_p->fetch_array();

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
					<i class="material-icons">pending</i><span>Solicitações</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu3">

                        <li>
                            <?php $mybookp = 'mybookp';
                                ?>
                            <a href="reservlab.php?<?php echo $mybookp?>"><i class="material-icons" style="color:#ff9800" >hourglass_empty</i><small>Meus Pedidos Pendentes</small></a>
                        </li>

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
                   <i class="material-icons searching">edit_calendar</i><span>Aprovar Reservas</span></a>
                   <ul class="collapse list-unstyled menu" id="pageSubmenu4">

                       <li>
                           <?php $penlab = 'penlab';
                               ?>
                           <a href="reservlab.php?<?php echo $penlab?>"><i class="material-icons" style="color:#e91e63">pending_actions</i><small>Solicitações Pendentes</small></a>
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

                </br>

                <li>
                <a href="https://central.tiflux.com.br/r/externals/tickets/new/3aa2d6da09887613520201a9e460c267016c8c15"><span class="btn btn-info form-control" style="color:white">Abrir ticket</span></a>                   
                </li>
               
               
            </ul>

           
        </nav>