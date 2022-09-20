function searchGameSteam() {
  const idGameSteam = document.getElementById('idGameSteam');
  searchDeezer(idGameSteam.value);
}

function searchDeezer(aux) {
  window.location.href = `NovoJogoSteam.php?idSteam=${aux}`;
}

function naoEncontrado() {
  Swal.fire(
    'JOGO NÃO ENCONTRADO',
    'VERIFIQUE O CÓDIGO DO JOGO INFORMADO',
    'error'
  );
}
