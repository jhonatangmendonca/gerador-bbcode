function erroFilme() {
  Swal.fire(
    'FILME NÃO ENCONTRADO',
    'VERIFIQUE O CÓDIGO DO IMDB INFORMADO',
    'error'
  );
}
function searchMovieImdb() {
  const idMovieImdb = document.getElementById('idMovieImdb');
  searchImdb(idMovieImdb.value);
}

function searchImdb(aux) {
  window.location.href = `NovoFilmeImdb.php?idImdb=${aux}`;
}
