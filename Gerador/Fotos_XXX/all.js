function CopiaDescricao() {
    // Executa o evento click no button 
    // Seleciona o conteúdo do input
    $('textarea').select();
    // Copia o conteudo selecionado
    var copiar = document.execCommand('copy');
    // Verifica se foi copia e retona mensagem
    if (copiar) {
        alert('SEU BBCODE FOI COPIADO COM SUCESSO!');
    } else {
        alert('Erro ao copiar, seu navegador pode não ter suporte a essa função.');
    }
    // Cancela a execução do formulário
    return false;
}

$("#faixas").sceditor({
    plugins: "bbcode",
    style: "minified/jquery.sceditor.default.min.css",
    locale: "pt-BR"
});