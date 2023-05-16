<nav id="sidebar">

<?php
    // query for total pending
    $q_p = $conn->query("SELECT COUNT(locacao_id) as total FROM `locacao` WHERE `status_id` = 2 && `users_id` = '$_SESSION[users_id]'") or die(mysqli_error());
    $f_p = $q_p->fetch_array();

    // query for pending message
    $q_msg = $conn->query("SELECT ms.assunto as pendente FROM mensagens as ms INNER JOIN locacao as lc ON lc.mensagens_id = ms.mensagens_id	WHERE lc.mensagens_id = 3 && users_id = '$_SESSION[users_id]'") or die(mysqli_error());
    if (mysqli_num_rows($q_msg) > 0) {
        $f_msg = $q_msg->fetch_array();
        $pendente = $f_msg['pendente'];
    } else {
        $pendente = "Sem pendências";
    }
?>
            <div class="sidebar-header">
                <h3><img src="https://production.listennotes.com/podcasts/itens-geniais-do-curso-de-análise-e-sFK9He0Q-Sb-AsjZeX6kxW0.1400x1400.jpg" class="img-fluid"/><span>Rerserve Lab</span></h3>
            </div>
            <ul class="list-unstyled components">
			    <li>
                    <a href="reservlab.php" class="dashboard"><i class="material-icons">home</i><span>Página Inicial</span></a>
                </li>		
		      <div class="small-screen navbar-display">
                <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#homeSubmenu0" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="material-icons">notifications</i>
                            <?php if ($f_p['total'] > 0) { ?>
                                <i name="notification" class="notification"><?php echo $f_p['total'] ?></i>
                            <?php } ?>
                    </a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu0">
                        <li>
                            <?php $reslab = 'reslab';
                                ?>
                            <a href="reservlab.php?<?php echo $reslab?>" class="text-primary"><?php echo $pendente?></a>
                         </li>                
                    </ul>
                </li>
				
				 <li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                        <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="material-icons">person</i><span><?php echo $name;?></span></a>
                            <ul class="collapse list-unstyled menu" id="homeSubmenu1">
                                <li>
                                    <a class="nav-link" href="logout.php"><i class="material-icons text-logout">logout</i><span><strong> LOGOUT</strong></span></a>
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
                                    <a class="nav-link" href="reservlab.php?alter-account"><span>Alterar Seu Dados</span></a>
                                </li>
                            </ul>
                    </li>
                </li>
				</div>
			
			
                <li class="dropdown">
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle" >
					<i class="material-icons">subject</i><span>Disciplinas</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu1">
                            
                        <li>
                            <?php $addsubj = 'addsubj';
                                ?>
                            <a href="reservlab.php?<?php echo $addsubj?>"><i class="material-icons" style="color:red">add</i>Cadastrar Disciplinas</a>
                        </li>

                        <li>
                            <?php $editsubj = 'editsubj';
                            ?>
                            <a href="reservlab.php?<?php echo $editsubj?>"><i class="material-icons" style="color:orange">edit</i>Editar Disciplinas</a>
                        </li>

                        <li>
                            <?php $addreq = 'addreq';
                            ?>
                            <a href="reservlab.php?<?php echo $addreq?>"><i class="material-icons" style="color:blue">post_add</i>Add Requisitos</a>
                        </li>

                        <li>
                            <a></a>
                        </li>
                    </ul>
                </li>
				
                <li class="dropdown">
                    <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
					<i class="material-icons">pending</i><span>Solicitações</span></a>
                    <ul class="collapse list-unstyled menu" id="pageSubmenu3">
                        
                        <li>
                            <?php $addcalled = 'addcalled';
                                ?>
                            <a href="reservlab.php?<?php echo $addcalled?>"><i class="material-icons" style="color:green" >file_open</i>Abrir Chamado</a>
                        </li>

                        <li>
                            <?php $listcall = 'listcall';
                                ?>
                            <a href="reservlab.php?<?php echo $listcall?>"><i class="material-icons" style="color:#e91e63" >summarize</i>Listar os Chamados</a>
                        </li>
                    </ul>
                </li>
				
                <li class="dropdown">
                    <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                   <i class="material-icons searching">edit_calendar</i><span>Reservas</span></a>
                   <ul class="collapse list-unstyled menu" id="pageSubmenu4">

                       <li>
                           <?php $penlab = 'penlab';
                               ?>
                           <a href="reservlab.php?<?php echo $penlab?>"><i class="material-icons" style="color:#4caf50">lock_open</i>Aguardando Aprovação</a>
                       </li>
                       
                        <li>
                            <?php $reslab = 'reslab';
                                ?>
                            <a href="reservlab.php?<?php echo $reslab?>"><i class="material-icons" style="color:red" >lock_clock</i>Laboratórios Reservados</a>
                        </li>

                        <li>
                            <?php $finlab = 'finlab';
                                ?>
                            <a href="reservlab.php?<?php echo $finlab?>"><i class="material-icons" style="color:#00bcd4">history</i>Histórico de Locações</a>
                        </li>
                    </ul>
                </li>
				
				<li class="dropdown">
                    <a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                   <i class="material-icons searching">calendar_month</i><span>Reservar Laboratório</span></a>
                   <ul class="collapse list-unstyled menu" id="pageSubmenu5">

                        <li>
                            <?php $calender = 'calender';
                                ?>
                            <a href="reservlab.php?<?php echo $calender?>"><i class="material-icons" style="color:#b38add">event</i>Reservar Dia</a>
                        </li>
                       
                        <li>
                            <?php $period = 'period';
                                ?>
                            <a href="reservlab.php?<?php echo $period?>"><i class="material-icons" style="color:#5d0f8a">timeline</i>Reservar por Período</a>
                        </li>

                        <li>
                            <?php $labscontent = 'labscontent';
                                ?>
                            <a href="reservlab.php?<?php echo $labscontent?>"><i class="material-icons" style="color:#373c4f" >maps_home_work</i>Listar Laboratórios</a>
                        </li>

                        <li>

                        </li>
                    </ul>
                </li>
               
               
            </ul>

           
        </nav>