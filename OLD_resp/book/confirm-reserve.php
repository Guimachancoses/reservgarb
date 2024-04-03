<?php require_once 'validate.php';?>
<div class="overlay">
  <div class="loadingio-spinner-spinner-7u0gjvj5v5j">
    <div class="ldio-z00xh444d9c">
      <div></div><div></div><div></div><div></div><div></div><div></div><div></div>
      <div></div><div></div><div></div><div></div><div></div>
    </div>
  </div>
</div>
<div class="main-content">  
    <div class="row">
			<div class="col-lg-8">
				<div class="card" style="min-height:625px">
                    <div class="card-foot" style="padding: 10px; display: flex; justify-content: flex-start;">
                        <button class="btn btn-info form-control" onclick="goBack()" style="padding: 2px; font-size: 8px; width: 50px;">
                            <i class="material-icons" style="vertical-align: middle; margin-right: 5px;">undo</i>
                        </button>
                    </div>
                    <script>
                        function goBack() {
                            window.history.back();
                        }
                    </script>
					<div class="card-header card-header-text">
						<h4 class="card-title"><strong class="text-primary"> Confimar Reserva</strong></h4>
						    <p class="category">Verifique todas as informações antes de confimar a reserva:</p>
                    <br />
                    <div class = "col-md-12"style="min-height:490px">
                    <?php $query = $conn->query("SELECT
                                                    u.firstname
                                                    ,u.lastname
                                                    ,COALESCE(lb.room_type, vs.name, eq.equipment) as locacao
                                                    ,COALESCE(lb.room_no, vs.description) as description
                                                    ,lc.locacao_id
                                                    ,lc.checkin
                                                    ,lc.checkin_time
                                                    ,lc.checkout_time
                                                    ,st.status
                                                FROM `locacao` as lc
                                                LEFT JOIN `laboratorios` as lb
                                                ON lb.room_id = lc.room_id
                                                INNER JOIN `users` as u
                                                ON u.users_id = lc.users_id
                                                LEFT JOIN `vehicles` as vs
                                                ON vs.vehicle_id = lc.vehicle_id
                                                LEFT JOIN `equipment` as eq
                                                ON eq.equip_id = lc.equip_id
                                                INNER JOIN `status` st
                                                ON st.status_id = lc.status_id
                                                WHERE lc.status_id = 1 && lc.locacao_id = '$_REQUEST[locacao_id]'") or die(mysqli_error($conn));
                        $fetch = $query->fetch_array();
                    ?>
                    <br />
                    <form method = "POST" action = "./save_form.php?locacao_id=<?php echo $fetch['locacao_id']?>">
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Nome</strong></label>
                                <br />
                                <input type = "text" value = "<?php echo $fetch['firstname']?>" name = "firstname" class = "form-control" size = "35" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Sobrenome</strong></label>
                                <br />
                                <input type = "text" value = "<?php echo $fetch['lastname']?>" name = "lastname" class = "form-control" size = "35" disabled = "disabled"/>
                            </div>
                        <br style = "clear:both;"/>
                        <br />
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Locação</strong></label>
                                <br />
                                <input type = "text" value = "<?php echo $fetch['locacao']?>" name = "locacao" class = "form-control" size = "20" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Descrição</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['description']?>" name = "description" class = "form-control" size = "35" disabled = "disabled"/>
                            </div>
                        <br style = "clear:both;" style = "float:left; margin-left:20px;"/>
                        <br />
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Data da Reserva</strong></label>
                                <br />
                                <input type = "text" value="<?php echo(date("d/m/Y", strtotime($fetch['checkin'])))?>" name = "checkin" class = "form-control" size = "10" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Hora da Reserva</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['checkin_time']?>" name = "checkin_time" class = "form-control" size = "10" disabled = "disabled"/>
                            </div>
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Hora da Devolução</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['checkout_time']?>" name = "checkout_time" class = "form-control" size = "10" disabled = "disabled"/>
                            </div>
                        <br style = "clear:both;"/>
                        <br />
                            <div class = "form-inline" style = "float:left; margin-left:20px;">
                                <label><strong>Status</strong></label>
                                <br />
                                <input type = "text" value="<?php echo $fetch['status']?>" name = "status" class = "form-control" size = "15" disabled = "disabled"/>
                            </div>
                        <br style = "clear:both;"/>
                        <br />
                        <div class = "form-inline" style = "float:left; margin-left:20px;">
                            <button  name = "add_form" class = "btn btn-primary"><i class = "glyphicon glyphicon-save"></i> Confimar</button>
                        </div>
                    </form>
                    <?php require_once './save_form.php'?>
                </div>
            </div>
        </div>
</div>

<!-- Função responsavel pelo esmanecer da tela -------------------------------------------------------------------------------------------->

<script>
function showOverlay() {
  const overlay = document.querySelector(".overlay");
  overlay.style.display = "flex"; // Show the overlay when the function is called

  // Create an image element for the loading GIF
  const loadingGif = document.createElement("img");
  loadingGif.classList.add("loading-gif");
  loadingGif.src = "loading.gif";

  // Append the loading GIF to the overlay
  overlay.appendChild(loadingGif);
}

function hideOverlay() {
  const overlay = document.querySelector(".overlay");
  overlay.style.display = "none"; // Hide the overlay when the function is called

  // Remove the child elements (loading GIF) from the overlay
  while (overlay.firstChild) {
    overlay.removeChild(overlay.firstChild);
  }
}
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const submitButton = document.querySelector(".btn-primary");

  submitButton.addEventListener("click", function() {
    showOverlay();
  });
});
</script>