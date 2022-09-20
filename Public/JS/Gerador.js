window.addEventListener('load', fnCopiarBBcode);

const CopiaDescricao = () => {
  $('textarea').select();
  const copiar = document.execCommand('copy');
  return false;
};

function fnCopiarBBcode() {
  Swal.fire(
    'DESCRIÇÃO GERADA',
    'Clique em abrir site para copiar a descrição e continuar',
    'success'
  );
}

function fnCopiar() {
  Swal.fire('DESCRIÇÃO COPIADA', '', 'success');
}
