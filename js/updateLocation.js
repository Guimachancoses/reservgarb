function atualizarLocacoes(caminhos) {
  caminhos.forEach((caminho) => {
    fetch(caminho)
      .then((response) => response.text())
      // .then(data =>
      //   console.log(data))
      .catch((error) => console.error(error));
  });
}

// Lista de caminhos que deseja executar
const caminhos = ["./update_location.php", "./update_periodo.php"];

// Chamando a função e passando a lista de caminhos
atualizarLocacoes(caminhos);
