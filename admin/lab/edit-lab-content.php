<div class="main-content">  
    <div class="row">
        <div class="col-lg-8">
            <div class="card" style="min-height:750px">
                <div class="card-header card-header-text">
                    <h4 class="card-title"><strong class="text-primary"> Editar Laboratório</strong></h4>
                    <!-- <p class="category">New employees on 15th December, 2016</p> (data atual)-->
                <br />
                <?php
                    $query = $conn->query("SELECT * FROM `laboratorios` WHERE `room_id` = '$_REQUEST[room_id]'") or die(mysqli_error());
                    $fetch = $query->fetch_array();
                ?>
                <div class = "col-md-10"style="min-height:425px">	
                    <form method = "POST" enctype = "multipart/form-data" autocomplete="off" onsubmit="return validateForm()">
                        <div class="card-foot">
                            <label><strong> Tipo de Sala:</strong></label>
                            <input type = "text" class = "form-control" value = "<?php echo $fetch['room_type']?>" name = "room_type" required = "required"/>
                        </div>
                        <div class="card-foot">
                            <label><strong> Capacidade:</strong></label>
                            <input type = "text" value = "<?php echo $fetch['capacity']?>" class = "form-control" name = "capacity" required = "required"/>
                        </div>
                        <div class="card-foot">
                            <label><strong> Descrição:</strong></label>
                            <input type = "text"  value = "<?php echo $fetch['room_no']?>" class = "form-control"  id = "room_no" name = "room_no" required = "required"/>
                        </div>
                        <br/>
                        <div class="card-foot">
                            <button name = "edit_room" class = "btn btn-warning form-control"><i class = "glyphicon glyphicon-edit"></i> Salvar alterações</button>
                        </div>
                    </form>
                    <?php require_once 'edit_query_room.php'?>
                </div>
            </div>
        </div>
    </div>
<div>
<script>
    function validateForm() {
        var capacityInput = document.getElementById('capacity');
        var noInput = document.getElementById('no');
        var capacityError = document.getElementById('capacity-error');
        var noError = document.getElementById('no-error');
        var capacityValue = capacityInput.value.trim();
        var noValue = noInput.value.trim();

        // Verifica se a capacidade é um número
        if (!/^\d+$/.test(capacityValue)) {
            capacityError.innerText = 'A capacidade deve ser um número.';
            return false;
        } else {
            capacityError.innerText = '';
        }

        return true;
    }

    window.onbeforeunload = function() {
        document.querySelector('form').reset();
    };
</script>