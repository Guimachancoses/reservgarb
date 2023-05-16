
function atualizarLocacoes() {
    fetch('./update_location.php')
      .then(response => response.text())   
      // .then(data => 
      //   console.log(data))
      .catch(error => console.error(error));
  }
  
  atualizarLocacoes();