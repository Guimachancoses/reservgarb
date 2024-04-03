function upgradePasswordForce(caminhos) {
  caminhos.forEach((caminho) => {
    fetch(caminho)
      .then((response) => response.text())
      .then((data) => console.log(data))
      .catch((error) => console.error(error));
  });
}

// Lista de caminhos que deseja executar
const caminho = ["./update_password.php"]; // Convertido para array

// Chamando a função e passando a lista de caminhos
upgradePasswordForce(caminho);
