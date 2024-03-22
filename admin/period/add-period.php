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
			<div class="col-lg-7 ">
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
						<h4 class="card-title"><strong class="text-primary"> Locação por Período</strong></h4>
						    <p class="category">Escolha o que você deseja reservar e o período que você deseja:</p>
                    <div class = "col-md-11" style="min-height:810px;">	
                        <form method = "POST" action="locacao_periodo.php" enctype = "multipart/form-data" autocomplete="off" onsubmit="submit()">
                            <div class="card-foot">
                                <label><strong> Usuário:</strong></label>
                                <select class = "form-control" name = "users_id" required = required>
                                                                                                                       
                                <option class="select-box" syle="border:none; outline:none; color:#5faa4f;"value="" disabled selected>Escolha o quem irá locar</option>
                                <?php  
                                  $queryad = $conn->query("SELECT * FROM `users` ORDER BY 2 ASC") or die(mysqli_error($conn));
                                  while($fetch = $queryad->fetch_array()){
                                    $users_id = $fetch['users_id'];
								                ?>
                                    <option class="select-box" value="<?php echo $users_id?>"><?php echo $fetch['firstname']." ".$fetch['lastname'];?></option>
                                <?php
                                }
                                ?>
                                </select>
                                
                            </div>
                            <div class="card-foot">
                                <label><strong> Reservar:</strong></label>
                                <select class = "form-control" name = "eventTitle" id="Title" onchange="checkSelection()" required = required>
                                                                                                                       
                                    <!-- query para trazer as salas -->
                                    <option value="" disabled selected>Escolha o que você deseja locar</option>
                                    <optgroup label="Salas">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `laboratorios`") or die(mysqli_error($conn));
                                        while($fetch = $queryad->fetch_array()){
                                        $room_type = $fetch['room_type'];
                                    ?>     
                                        <option class="select-box" value="<?php echo $room_type?>"><?php echo $fetch['room_type']." - ".$fetch['room_no']?></option>
                                      <?php
                                      }
                                      ?>
                                    </optgroup>
                                    <!-- query para trazer as veículos -->
                                    <optgroup label="Veículos">
                                    <?php  
                                        $queryad = $conn->query("SELECT * FROM `vehicles`") or die(mysqli_error($conn));
                                        while($fetch = $queryad->fetch_array()){
                                        $name = $fetch['name']. " - ". $fetch['description'];
                                    ?>     
                                        <option class="select-box" value="<?php echo $name?>"><?php echo $fetch['name']." - ".$fetch['model']?></option>
                                      <?php
                                      }
                                      ?>
                                    </optgroup>
                                    <!-- query para trazer as equipameantos -->
                                    <optgroup label="Equipamentos">
                                    <?php  
                                      $queryad = $conn->query("SELECT * FROM `equipment`") or die(mysqli_error($conn));
                                      while($fetch = $queryad->fetch_array()){
                                      $equip = $fetch['equipment'];
                                    ?>     
                                      <option class="select-box" value="<?php echo $equip?>"><?php echo $fetch['equipment']?></option>
                                    <?php
                                    }
                                    ?>
                                    </optgroup>
                                
                                </select>
                            </div>
                            <div class="card-foot">
                                <label><strong> Data de Início:</strong></label>
                                <input type="date" class="form-control" name="checkin" id="checkin" required />
                                <span id="checkin-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Data Fim:</strong></label>
                                <input type="date" class = "form-control" name = "checkout" id="checkout" required = required/>
                                <span id="checkout-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Dia da Semana:</strong></label>
                                <select class="form-control" name="dia_semana" id="Semana" onchange="checkSelection()" required = required>
                                    <option class="select-box" value="" disabled selected>Escolha o dia da semana</option>
                                    <option class="select-box" value="Monday">Segunda-feira</option>
                                    <option class="select-box" value="Tuesday">Terça-feira</option>
                                    <option class="select-box" value="Wednesday">Quarta-feira</option>
                                    <option class="select-box" value="Thursday">Quinta-feira</option>
                                    <option class="select-box" value="Friday">Sexta-feira</option>
                                    <option class="select-box" value="Saturday">Sábado</option>
                                    <option class="select-box" value="Sunday">Domingo</option>
                                    <option class="select-box" value="AllDays">Todos os dias</option>
                                </select>
                            </div>
                            <script>
                                // Função para verificar as seleções do usuário e mostrar/ocultar o input dinamicamente
                                function checkSelection() {
                                    var eventTitle = document.getElementById("Title");
                                    var diaSemana = document.getElementById("Semana");
                                    var confirmSelect = document.getElementById("confirm-select");

                                    var selectedOption = eventTitle.options[eventTitle.selectedIndex];
                                    var locacao = '';

                                    // Verificar se a opção selecionada está dentro do optgroup "Veículos"
                                    if (selectedOption.parentElement.label === "Veículos") {
                                        locacao = "Veiculos";
                                    } else {
                                        locacao = selectedOption.value;
                                    }

                                    var dia = diaSemana.value;
                                  
                                    // Verificar se ambas as seleções foram feitas
                                    if (locacao != "" && dia != "") {
                                        console.log("locacao: " + locacao + " dia: " + dia);
                                        // Verificar se a opção "Veículos" e "Todos os dias" foram selecionadas
                                        if (locacao === "Veiculos" && dia== "AllDays") {
                                            // Mostrar o select de confirmação
                                            confirmSelect.style.display = "block";
                                        } else {
                                            // Ocultar o select de confirmação
                                            confirmSelect.style.display = "none";

                                        }
                                    } else {
                                        // Ocultar o select de confirmação
                                        confirmSelect.style.display = "none";
                                    }
                                }
                                
                            </script>

                            <div class="card-foot" id="confirm-select" style="display:none">
                                <spam style="color: red; font-size: smaller;"><strong>* Sua locação irá preencher todos os horários do período do seu agendamento? (Sim)</strong></spam>
                                <br />
                                <spam style="color: red; font-size: smaller;"><strong>* Ou ela irá deixar algum horário do expediente livre? (Não)</strong></spam>
                                <select class="form-control" name="confirmacao">
                                    <option value="" disabled selected>Escolha uma das opções</option>
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>
                            <div class="card-foot">
                                <label><strong> Hora de Início:</strong></label>
                                <input type="time" class = "form-control" name = "checkin_time" id="checkin_time" required = required/>
                                <span id="time-error" style="color: red; font-size: smaller;"></span>
                            </div>
                            <div class="card-foot">
                                <label><strong> Hora Fim:</strong></label>
                                <input type="time" class = "form-control" name = "checkout_time" required = required/>
                            </div>
                            <br />
                            <div class="card-foot">
                                <button id="periodSubmit" type="submit" name = "locacao_periodo" class = "btn btn-primary form-control"><i class = "glyphicon glyphicon-save"></i> Salvar</button>
                            </div>
                        </form>
                        <?php require_once 'locacao_periodo.php'?>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>

<!-- Função responsavel por tratar o recebimento de data de inicio e data fim ------------------------------------------------------------------------------->
<script>
    function getBrasiliaDateWithoutTime() {
        const dataAtual = new Date();

        // Ajustar o fuso horário para "America/Sao_Paulo" (Brasília)
        const fusoHorarioBrasilia = 0; // O horário de Brasília é UTC-3
        dataAtual.setHours(dataAtual.getHours() - fusoHorarioBrasilia);

        return dataAtual;
        }

    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const checkinErrorSpan = document.getElementById('checkin-error');
    const checkoutErrorSpan = document.getElementById('checkout-error');

    checkinInput.addEventListener('blur', function () {
        const checkinDateStr = (checkinInput.value);
        const [day, month, year] = checkinDateStr.split('/'); // Separar o dia, mês e ano
        const checkinDate = new Date(`${year}/${month}/${day}`); // Criar o objeto Date com a data no formato "yyyy/mm/dd"

        const currentDate = getBrasiliaDateWithoutTime();

        checkinDate.setHours(currentDate.getHours());
        checkinDate.setMinutes(currentDate.getMinutes() + 1);
        checkinDate.setSeconds(currentDate.getSeconds());

        const timeDifference = Math.abs(checkinDate - currentDate);
        const daysDifference = timeDifference / (1000 * 60 * 60 * 24);
        const maxDay = 30;

        // Add a check for "Invalid Date" before creating the Date object
        if (checkinDate == 'Invalid Date') {
            checkinErrorSpan.textContent = 'Data inválida.';
            return;
        }

        if (checkinDate < currentDate) {
                checkinErrorSpan.textContent = 'A data de início não pode ser menor que a data atual ou ser maior que 30 dias.';
            } else if (daysDifference > maxDay) {
                checkinErrorSpan.textContent = 'A data de início não pode ser menor que a data atual ou ser maior que 30 dias.'; 
            }else {
                checkinErrorSpan.textContent = ''; // Limpa a mensagem de erro se a data for válida
            }
        });

    function isDateValid(selectedDate, maxDaysDifference) {
        const currentDate = getBrasiliaDateWithoutTime();
        const [year, month, day] = selectedDate.split('-'); // Extrai ano, mês e dia
        const formattedDate = `${year}/${month}/ ${day}`; // Formata para "yyyy/mm/dd"
        const selectedDateObj = new Date(formattedDate);

         // Subtrai um dia do objeto Date
        selectedDateObj.setDate(selectedDateObj.getDate() - 1);

        const timeDifference = Math.abs(selectedDateObj - currentDate);
        const daysDifference = timeDifference / (1000 * 60 * 60 * 24);

        return selectedDateObj >= currentDate && daysDifference <= maxDaysDifference;
    }

    checkoutInput.addEventListener('blur', function () {
        const checkinDate = new Date(checkinInput.value);
        const checkoutDate = new Date(checkoutInput.value);
        const maxDate = new Date(checkinDate);
        maxDate.setMonth(maxDate.getMonth() + 6);

        if ((checkoutDate <= checkinDate) || checkoutDate >= maxDate) {
            checkoutErrorSpan.textContent = 'A data final não pode ser igual a data de início ou superior a 6 meses.';
        } else {
            checkoutErrorSpan.textContent = ''; // Limpa a mensagem de erro se a data for válida
        }
    });
</script>

<!-- Função responsavelação pelo select ---------------------------------------------------------------------------------------------------------------------->
<script>
  function getDaysOfWeekBetweenDates(startDate, endDate) {
    const daysOfWeek = ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"];
    const start = new Date(startDate);
    const end = new Date(endDate);
    
    // Adiciona uma hora à data final para corrigir o fuso horário
    end.setHours(end.getHours() + 1);
    
    let selectedDays = [];

    // Itera sobre o intervalo de datas
    while (start <= end) {
      const dayOfWeek = daysOfWeek[start.getDay()]; // Obtém o dia da semana em formato string
      if (!selectedDays.includes(dayOfWeek)) {
        selectedDays.push(dayOfWeek);
      }
      start.setDate(start.getDate() + 1); // Avança para o próximo dia
    }

    return selectedDays;
  }

  // Função para atualizar o select com os dias da semana selecionados
  function updateSelectOptions() {
    const startDate = document.getElementById("checkin").value;
    const endDate = document.getElementById("checkout").value;

    if (startDate && endDate) {
      const daysOfWeek = getDaysOfWeekBetweenDates(startDate, endDate);
      const select = document.getElementsByName("dia_semana")[0];
      select.innerHTML = ""; // Limpa as opções atuais

      // Sempre adicione a opção "Todos os dias"
      select.options.add(new Option("Escolha o dia da semana", ""));

      // Sempre adicione a opção "Todos os dias"
      select.options.add(new Option("Todos os dias", "AllDays"));

      // Adicione todos os dias da semana individualmente
      daysOfWeek.forEach((day) => {
        select.options.add(new Option(day, day));
      });
    }
  }

  // Event listener para chamar a função sempre que as datas forem alteradas
  document.getElementById("checkin").addEventListener("change", updateSelectOptions);
  document.getElementById("checkout").addEventListener("change", updateSelectOptions);
</script>


<!-- Função responsavel pelo tratamento da hora de início------------------------------------------------------------------------------------------ -->

<script>
    const timeErrorSpan = document.getElementById('time-error');
  // Função para verificar o horário de início
  function checkTimeInput() {
    const checkinTimeInput = document.getElementById('checkin_time');
    const startTime = checkinTimeInput.value.trim(); // Remove espaços em branco no início e fim

    if (!startTime) {
      timeErrorSpan.textContent = 'Campo obrigatório. Insira o horário de check-in.';
    } else {
      // Pega o valor do campo de data de início
      const checkinDateInput = document.getElementById('checkin');
      const checkinDateValue = checkinDateInput.value.trim(); // Remove espaços em branco no início e fim

      // Formata a data para criar o objeto Date no formato "AAAA/MM/DD"
      const [day, month, year] = checkinDateValue.split('/');
      const formattedDate = `${year}/${month}/${day}`;
      const startDateTime = new Date(`${formattedDate} ${startTime}`);

      // Pega a data atual de Brasília
      const currentDate = getBrasiliaDateWithoutTime();

        // Verificar se a hora de início não é menor que a hora atual
        if (startDateTime < currentDate) {
            timeErrorSpan.textContent = 'A hora inicial não pode ser menor que a hora atual de Brasília.';
        } else {
            timeErrorSpan.textContent = '';    
        }
    }
  }
  const checkinTimeInput = document.getElementById('checkin_time');
  checkinTimeInput.addEventListener('blur', checkTimeInput);
</script>

<script>
function hasErrors() {
    const checkinErrorSpan = document.getElementById('checkin-error');
    const checkoutErrorSpan = document.getElementById('checkout-error');
    const timeErrorSpan = document.getElementById('time-error');

    return (
      checkinErrorSpan.textContent.trim() !== '' ||
      checkoutErrorSpan.textContent.trim() !== '' ||
      timeErrorSpan.textContent.trim() !== ''
    );
  }

  // Interceptando o envio do formulário (submit)
  const form = document.querySelector('form'); // Seleciona o formulário
  form.addEventListener('submit', function(event) {
    if (hasErrors()) {
      event.preventDefault(); // Cancela o envio do formulário caso haja mensagens de erro
    }
  });

</script>

<!-- Função responsavel pelo esmanecer a tela -------------------------------------------------------------------------------------------->

<script>
  // Function responsible for showing the overlay
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

  // Add event listener for the form submission
  document.addEventListener("DOMContentLoaded", function() {
    const submitButton = document.querySelector(".btn-primary");

    submitButton.addEventListener("click", function(event) {
      const usersId = document.getElementsByName("users_id")[0].value;
      const eventTitle = document.getElementsByName("eventTitle")[0].value;
      const checkin = document.getElementsByName("checkin")[0].value;
      const checkout = document.getElementsByName("checkout")[0].value;
      const diaSemana = document.getElementsByName("dia_semana")[0].value;
      const checkinTime = document.getElementsByName("checkin_time")[0].value;
      const checkoutTime = document.getElementsByName("checkout_time")[0].value;

      if (
        usersId === "" ||
        eventTitle === "" ||
        checkin === "" ||
        checkout === "" ||
        diaSemana === "" ||
        checkinTime === "" ||
        checkoutTime === ""
      ) {
        // If any field is empty, prevent the form submission
        event.preventDefault();
      } else {
        // If all fields are filled, show the overlay
        showOverlay();
      }
    });
  });
</script>
