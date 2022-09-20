function searchDeezerAlbum() {
  const idAlbumDeezer = document.getElementById('idAlbumDeezer');
  searchDeezer(idAlbumDeezer.value);
}

function searchDeezer(aux) {
  window.location.href = `NovaMusicaDeezer.php?idDeezer=${aux}`;
}

function errorRequest() {
  Swal.fire(
    'ÁLBUM NÃO ENCONTRADO',
    'VERIFIQUE O CÓDIGO DO DEEZER INFORMADO',
    'error'
  );
}
