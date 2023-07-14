(calendar = document.querySelector(".calendar")),
  (date = document.querySelector(".date")),
  (daysContainer = document.querySelector(".days")),
  (prev = document.querySelector(".prev")),
  (next = document.querySelector(".next")),
  (todayBtn = document.querySelector(".today-btn")),
  (gotoBtn = document.querySelector(".goto-btn")),
  (dateInput = document.querySelector(".date-input")),
  (eventDay = document.querySelector(".event-day")),
  (eventDate = document.querySelector(".event-date")),
  (eventsContainer = document.querySelector(".events")),
  (addEventBtn = document.querySelector(".add-event")),
  (addEventWrapper = document.querySelector(".add-event-wrapper ")),
  (addEventCloseBtn = document.querySelector(".close ")),
  (addEventTitle = document.querySelector(".event-name ")),
  (addEventFrom = document.querySelector(".event-time-from ")),
  (addEventTo = document.querySelector(".event-time-to ")),
  (addEventDisc = document.querySelector(".event-disc")),
  (addEventSubmit = document.querySelector(".add-event-btn "));

let today = new Date();
let activeDay;
let month = today.getMonth();
let year = today.getFullYear();

const months = [
  "Janeiro",
  "Fevereiro",
  "Março",
  "Abril",
  "Maio",
  "Junho",
  "Julho",
  "Augosto",
  "Setembro",
  "Outubro",
  "Novembro",
  "Dezembro",
];

const eventsArr = [];
getEvents();

//--------------------------------------------------------------------------------------------------------------------------------------
//function para adicionar dias em dias com a class day e data anterior próxima data no mês anterior e dias do próximo mês e ativo hoje
function initCalendar() {
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const prevLastDay = new Date(year, month, 0);
  const prevDays = prevLastDay.getDate();
  const lastDate = lastDay.getDate();
  const day = firstDay.getDay();
  const nextDays = 7 - lastDay.getDay() - 1;

  date.innerHTML = months[month] + " " + year;

  let days = "";

  for (let x = day; x > 0; x--) {
    days += `<div class="day prev-date">${prevDays - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDate; i++) {
    //verifique se o evento está presente naquele dia
    let event = false;
    eventsArr.forEach((eventObj) => {
      if (
        eventObj.day === i &&
        eventObj.month === month + 1 &&
        eventObj.year === year
      ) {
        event = true;
      }
    });
    if (
      i === new Date().getDate() &&
      year === new Date().getFullYear() &&
      month === new Date().getMonth()
    ) {
      activeDay = i;
      getActiveDay(i);
      updateEvents(i);
      if (event) {
        days += `<div class="day today active event">${i}</div>`;
      } else {
        days += `<div class="day today active">${i}</div>`;
      }
    } else {
      if (event) {
        days += `<div class="day event">${i}</div>`;
      } else {
        days += `<div class="day ">${i}</div>`;
      }
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next-date">${j}</div>`;
  }
  daysContainer.innerHTML = days;
  addListner();
}

//--------------------------------------------------------------------------------------------------------------------------------------
//function para adicionar mês e ano no botão anterior e seguinte
function prevMonth() {
  month--;
  if (month < 0) {
    month = 11;
    year--;
  }
  initCalendar();
}

function nextMonth() {
  month++;
  if (month > 11) {
    month = 0;
    year++;
  }
  initCalendar();
}

prev.addEventListener("click", prevMonth);
next.addEventListener("click", nextMonth);

initCalendar();

//--------------------------------------------------------------------------------------------------------------------------------------
//function para adicionar atividade no dia
function addListner() {
  const days = document.querySelectorAll(".day");
  days.forEach((day) => {
    day.addEventListener("click", (e) => {
      getActiveDay(e.target.innerHTML);
      updateEvents(Number(e.target.innerHTML));
      activeDay = Number(e.target.innerHTML);
      //remove atividade
      days.forEach((day) => {
        day.classList.remove("active");
      });
      //se clicar em data anterior ou próxima data, mude para esse mês
      if (e.target.classList.contains("prev-date")) {
        prevMonth();
        //adicionar atividade ao dia clicado após mês é alteração
        setTimeout(() => {
          //adicionar atividade onde não há data anterior ou próxima data
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("prev-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else if (e.target.classList.contains("next-date")) {
        nextMonth();
        //adicionar atividade ao dia clicado após o mês ser alterado
        setTimeout(() => {
          const days = document.querySelectorAll(".day");
          days.forEach((day) => {
            if (
              !day.classList.contains("next-date") &&
              day.innerHTML === e.target.innerHTML
            ) {
              day.classList.add("active");
            }
          });
        }, 100);
      } else {
        e.target.classList.add("active");
      }
    });
  });
}

//--------------------------------------------------------------------------------------------------------------------------------------
// Pegar a data, mês e ano com um click
todayBtn.addEventListener("click", () => {
  today = new Date();
  month = today.getMonth();
  year = today.getFullYear();
  initCalendar();
});

//--------------------------------------------------------------------------------------------------------------------------------------
// Configurar o recebibento da data em goto
dateInput.addEventListener("input", (e) => {
  dateInput.value = dateInput.value.replace(/[^0-9/]/g, "");
  if (dateInput.value.length === 2) {
    dateInput.value += "/";
  }
  if (dateInput.value.length > 7) {
    dateInput.value = dateInput.value.slice(0, 7);
  }
  if (e.inputType === "deleteContentBackward") {
    if (dateInput.value.length === 3) {
      dateInput.value = dateInput.value.slice(0, 2);
    }
  }
});

//--------------------------------------------------------------------------------------------------------------------------------------
// função vá para a data escolhida "Mês e ano"
gotoBtn.addEventListener("click", gotoDate);

function gotoDate() {
  const dateArr = dateInput.value.split("/");
  if (dateArr.length === 2) {
    if (dateArr[0] > 0 && dateArr[0] < 13 && dateArr[1].length === 4) {
      month = dateArr[0] - 1;
      year = dateArr[1];
      initCalendar();
      return;
    }
  }
  alert("Data inválida");
}

//--------------------------------------------------------------------------------------------------------------------------------------
//função obter nome e data do dia do dia da atividade e atualizar evento do dia e a data do evento
function getActiveDay(date) {
  const weekdays = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];
  const day = new Date(year, month, date);
  const dayName = weekdays[day.getDay()];
  eventDay.innerHTML = dayName;
  eventDate.innerHTML = date + " " + months[month] + " " + year;
}

//---------------------------------------------------------------------------------------------------------------------------------------
//function atualizar "eventos" quanto houver eventos ativos
function updateEvents(date) {
  let events = "";
  eventsArr.forEach((event) => {
    if (
      date === event.day &&
      month + 1 === event.month &&
      year === event.year
    ) {
      event.events.forEach((event) => {
        events += `<div class="event">
            <div class="title">
              <i class="fas fa-circle"></i>
              <h3 class="event-title">${event.title}</h3>
            </div>
            <div class="event-time">
              <span class="event-time">${event.time}</span>
            </div>
        </div>`;
      });
    }
  });
  if (events === "") {
    events = `<div class="no-event">
            <h3>Sem eventos</h3>
        </div>`;
  }
  eventsContainer.innerHTML = events; //para exibir os eventos no html
}

//--------------------------------------------------------------------------------------------------------------------------------------
//function adicionar evento no click
addEventBtn.addEventListener("click", () => {
  addEventWrapper.classList.toggle("active");
});

addEventCloseBtn.addEventListener("click", () => {
  addEventWrapper.classList.remove("active");
});

document.addEventListener("click", (e) => {
  if (e.target !== addEventBtn && !addEventWrapper.contains(e.target)) {
    addEventWrapper.classList.remove("active");
  }
});

//--------------------------------------------------------------------------------------------------------------------------------------
//permitir 50 caracteres no título do evento
addEventTitle.addEventListener("input", (e) => {
  addEventTitle.value = addEventTitle.value.slice(0, 60);
});

//--------------------------------------------------------------------------------------------------------------------------------------
// função define as propriedades da div 'event' no html
function defineProperty() {
  var osccred = document.createElement("div");
  osccred.style.position = "absolute";
  osccred.style.bottom = "0";
  osccred.style.right = "0";
  osccred.style.fontSize = "10px";
  osccred.style.color = "#ccc";
  osccred.style.fontFamily = "sans-serif";
  osccred.style.padding = "5px";
  osccred.style.background = "#fff";
  osccred.style.borderTopLeftRadius = "5px";
  osccred.style.borderBottomRightRadius = "5px";
  osccred.style.boxShadow = "0 0 5px #ccc";
  document.body.appendChild(osccred);
}

defineProperty();

//--------------------------------------------------------------------------------------------------------------------------------------
// funções para configurar o tipo de hora recebida no input e aceitar apagar todo o campo com "backspace"
addEventFrom.addEventListener("keydown", (e) => {
  if (e.key === "Backspace") {
    addEventFrom.value = "";
    return;
  }
  addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
  if (addEventFrom.value.length === 2) {
    addEventFrom.value += ":";
  }
  if (addEventFrom.value.length > 5) {
    addEventFrom.value = addEventFrom.value.slice(0, 5);
  }
});

addEventFrom.addEventListener("input", (e) => {
  addEventFrom.value = addEventFrom.value.replace(/[^0-9:]/g, "");
  if (addEventFrom.value.length === 2) {
    addEventFrom.value += ":";
  }
  if (addEventFrom.value.length > 5) {
    addEventFrom.value = addEventFrom.value.slice(0, 5);
  }
});

addEventTo.addEventListener("keydown", (e) => {
  if (e.key === "Backspace") {
    addEventTo.value = "";
    return;
  }
  addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
  if (addEventTo.value.length === 2) {
    addEventTo.value += ":";
  }
  if (addEventTo.value.length > 5) {
    addEventTo.value = addEventTo.value.slice(0, 5);
  }
});

addEventTo.addEventListener("input", (e) => {
  addEventTo.value = addEventTo.value.replace(/[^0-9:]/g, "");
  if (addEventTo.value.length === 2) {
    addEventTo.value += ":";
  }
  if (addEventTo.value.length > 5) {
    addEventTo.value = addEventTo.value.slice(0, 5);
  }
});

//--------------------------------------------------------------------------------------------------------------------------------------
//funções de verificação sendo essa para não adicionar um evento vazio.
addEventSubmit.addEventListener("click", () => {
  const eventTitle = addEventTitle.value;
  const eventDisc = addEventDisc.value;
  const eventTimeFrom = addEventFrom.value;
  const eventTimeTo = addEventTo.value;
  if (
    eventTitle === "" ||
    eventTimeFrom === "" ||
    eventTimeTo === "" ||
    eventDisc === ""
  ) {
    alert("Por favor preencha todos os campos!!!");
    return;
  }

  //verifique o formato de hora correto 24 horas
  const timeFromArr = eventTimeFrom.split(":");
  const timeToArr = eventTimeTo.split(":");
  if (
    timeFromArr.length !== 2 ||
    timeToArr.length !== 2 ||
    timeFromArr[0] > 23 ||
    timeFromArr[1] > 59 ||
    timeToArr[0] > 23 ||
    timeToArr[1] > 59
  ) {
    alert("Formato de hora inválido!!!");
    return;
  }

  // adiciona '00' aos minutos, caso os minutos não tenham sido fornecidos
  if (timeFromArr[1].length === 0) {
    timeFromArr[1] = "00";
  }
  if (timeToArr[1].length === 0) {
    timeToArr[1] = "00";
  }

  // reconstroi as strings da hora
  const eventTimeFromFormatted = timeFromArr.join(":");
  const eventTimeToFormatted = timeToArr.join(":");

  // verifique se a hora inserida de inicio pelo usuário é maior ou igual à hora atual
  // converter as horas de strings para formato date
  const timeFrom = convertTime(eventTimeFromFormatted);
  const timeTo = convertTime(eventTimeToFormatted);
  const now = new Date();
  const inputDate = new Date(year, month, activeDay);
  inputDate.setHours(timeFromArr[0]);
  inputDate.setMinutes(timeFromArr[1]);
  if (inputDate < now && inputDate.toDateString() === now.toDateString()) {
    alert("A hora inicio não pode ser menor que a hora atual.");
    return;
  }

  // Compara as datas, se data for menor que a data atual não aceitar
  if (inputDate < now) {
    alert(
      "Não é possível inserir uma locação em uma data anterior à data atual."
    );
    return;
  }

  // Verifica se a hora final é menor que a hora atual para a data atual.
  if (inputDate == now && addEventTo <= addEventFrom) {
    alert("A hora final não pode ser menor que a hora inicial.");
    return false;
  }

  // Verifica se a hora que está sendo programado a locação está dentro do horário de funcionamento do laboratório.
  const dateCompare = new Date(year, month, activeDay);
  dateCompare.setHours(timeFromArr[0], timeFromArr[1], 0, 0);
  const startForbidden = new Date(dateCompare);
  startForbidden.setHours(6, 0, 0, 0);
  const endForbidden = new Date(dateCompare);
  endForbidden.setHours(24, 0, 0, 0);

  if (
    dateCompare >= endForbidden ||
    dateCompare < startForbidden ||
    timeTo >= endForbidden
  ) {
    alert("Não é possível inserir uma locação neste horário.");
    return;
  }

  // Chama a função SaveEvent se for salvo contia e armazera em um array se não "Evento já adicionado ou hora com conflito"
  const eventSave = saveEvents(
    eventTitle,
    eventDisc,
    eventTimeFromFormatted,
    eventTimeToFormatted
  );
  eventSave
    .then(() => {
      const newEvent = {
        title: eventTitle,
        time: timeFrom + " - " + timeTo,
      };

      let eventAdded = false;

      if (eventsArr.length > 0) {
        eventsArr.forEach((item) => {
          if (
            item.day === activeDay &&
            item.month === month + 1 &&
            item.year === year
          ) {
            item.events.push(newEvent);
            eventAdded = true;
          }
        });
      }

      if (!eventAdded) {
        eventsArr.push({
          day: activeDay,
          month: month + 1,
          year: year,
          events: [newEvent],
        });
      }

      addEventWrapper.classList.remove("active");
      addEventTitle.value = "";
      addEventFrom.value = "";
      addEventTo.value = "";
      updateEvents(activeDay);

      //selecione o dia evento e adicione a classe de active, se não for adicionado não faça nada.
      const activeDayEl = document.querySelector(".day.active");
      if (!activeDayEl.classList.contains("event")) {
        activeDayEl.classList.add("event");
      }
    })
    .catch((error) => {
      console.log(error);
      alert(error); // exibir mensagem de erro ao usuário
      return false;
    });
  return true; // se a promessa ainda não foi resolvida ou rejeitada, retorna true.
});

//---------------------------------------------------------------------------------------------------------
//função para excluir evento quando clicado no evento
eventsContainer.addEventListener("click", (e) => {
  if (e.target.classList.contains("event")) {
    if (confirm("Tem certeza de que deseja excluir este evento?")) {
      // Separa o eventTitle em duas partes usando a string " - Nº " como separador, para pegar o nome da room
      const eventTitle = e.target.children[0].children[1].innerHTML;
      const eventTimeFrom = e.target.children[1].children[0].innerHTML;
      const times = eventTimeFrom.split("-").map((time) => time.trim());
      const firstTime = times[0];

      // Separa o a segunda parte de eventTitle em duas partes usando a string " *" como separador, para pegar o número da room
      var titleParts = eventTitle.split(" - ");
      var title = titleParts[0]; // A primeira parte contém o título do evento
      var numString = titleParts[1]; // A segunda parte contém o número da sala
      var numParts = numString.split(" *");
      var room_no = numParts[0];

      // Envia uma solicitação POST para a API "delete_event.php" para excluir o evento do banco de dados
      const formData = new FormData();
      const inputDate = new Date(year, month, activeDay);
      var checkin = inputDate.toLocaleDateString();

      formData.append("title", title);
      formData.append("room_no", room_no);
      formData.append("eventCheckin", checkin);
      formData.append("eventTimeFrom", firstTime);
      fetch("./delete_cal_query.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((result) => {
          if (result === "") {
            alert("Esse evento não pode ser excluído.");
          } else {
            // Remova o evento da matriz "eventsArr" e atualize os eventos no calendário
            eventsArr.forEach((event) => {
              if (
                event.day === activeDay &&
                event.month === month + 1 &&
                event.year === year
              ) {
                event.events.forEach((item, index) => {
                  if (item.title === eventTitle) {
                    event.events.splice(index, 1);
                  }
                });
                // Se nenhum evento restante em um dia, remova esse dia de eventsArr
                if (event.events.length === 0) {
                  eventsArr.splice(eventsArr.indexOf(event), 1);
                  //remover event class do dia
                  const activeDayEl = document.querySelector(".day.active");
                  if (activeDayEl.classList.contains("event")) {
                    activeDayEl.classList.remove("event");
                  }
                }
              }
            });
            updateEvents(activeDay);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    }
  }
});

//--------------------------------------------------------------------------------------------------------------------------------------
// Define a função para realizar o INSERT no banco de dados
function saveEvents(eventTitle, eventDisc, eventTimeFrom, eventTimeTo) {
  return new Promise((resolve, reject) => {
    const inputDate = new Date(year, month, activeDay);
    var checkin = inputDate.toLocaleDateString();

    // Separa o eventTitle em duas partes usando a string " - " como separador
    var titleParts = eventTitle.split(" - ");
    var title = titleParts[0]; // A primeira parte contém o título do evento

    // Separa o eventDisc em duas partes usando a string " " como separador
    var nameParts = eventDisc.split(" ");
    var firstname = nameParts[0]; // A primeira parte contém o primeiro nome
    var lastname = nameParts[1]; // A segunda parte contém o segundo nome

    console.log(firstname, lastname);

    // Envia uma solicitação POST para a API "locacao_query.php" para inserir o evento do banco de dados
    var inser = new FormData();
    inser.append("firstname", firstname);
    inser.append("lastname", lastname);
    inser.append("title", title);
    inser.append("eventCheckin", checkin);
    inser.append("eventTimeFrom", eventTimeFrom);
    inser.append("eventTimeTo", eventTimeTo);

    fetch("./locacao_query.php", {
      method: "POST",
      body: inser,
    })
      .then((response) => response.text())
      .then((result) => {
        if (result == "") {
          console.log(result);
          reject(
            " - ERRO -\n \n * Verifique se já existe uma reserva nesse horário. *"
          );
        } else {
          console.log(result);
          // Caso a API retorne evento cadastrado, set true
          resolve(true);
        }
      })
      .catch((error) => {
        // Caso a API retorne evento vazio, set false
      });
  });
}

//--------------------------------------------------------------------------------------------------------------------------------------
// Envia uma solicitação GET para o endpoint de API que retorna os eventos para o array eventsArr
function getEvents() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "list_event_query.php", true);
  xhr.onload = function () {
    // Converte os dados JSON em um array de objetos JavaScript
    const response = JSON.parse(xhr.responseText);
    const eventos = Array.isArray(response)
      ? response
      : Object.values(response).map((obj) => obj);

    if (eventos.length > 0) {
      eventos.forEach((item) => {
        const { day, month, year, title, time } = item;
        const newEvent = { title, time };

        let eventAdded = false;

        if (eventsArr.length > 0) {
          eventsArr.forEach((eventObj) => {
            if (
              eventObj.day === day &&
              eventObj.month === month &&
              eventObj.year === year
            ) {
              eventObj.events.push(newEvent);
              eventAdded = true;
            }
          });
        }

        if (!eventAdded) {
          eventsArr.push({
            day: day,
            month: month,
            year: year,
            events: [newEvent],
          });
        }

        addEventWrapper.classList.remove("active");
        addEventTitle.value = "";
        addEventFrom.value = "";
        addEventTo.value = "";
        initCalendar();
      });
    }
  };
  xhr.send();
}

//--------------------------------------------------------------------------------------------------------------------------------------
//converter hora para o formato de 24 horas
function convertTime(time) {
  let timeArr = time.split(":");
  let timeHour = timeArr[0];
  let timeMin = timeArr[1];
  let timeFormat = timeHour >= 12 ? "PM" : "AM";
  timeHour = timeHour % 12 || 12;
  time = timeHour + ":" + timeMin + " " + timeFormat;
  return time;
}
