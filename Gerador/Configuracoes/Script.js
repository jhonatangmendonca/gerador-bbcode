// habilita os campos de edição do detalhamento
function fnAbreEditar() {
    if ($('#BntSalvar').hasClass('item-hide')) {
        $('#Assinatura1').removeAttr('disabled');
        $('#Assinatura2').removeAttr('disabled');
        $('#UrlLancamentos').removeAttr('disabled');
        $('#Background').removeAttr('disabled');
        $('#TipoFonteTitulo').removeAttr('disabled');
        $('#TipoFonteCorpo').removeAttr('disabled');
        $('#TagExtra').removeAttr('disabled');
        $('#FonteCorpo').removeAttr('disabled');
        $('#FonteTitulo').removeAttr('disabled');
        $('#FonteSubTitulo').removeAttr('disabled');
        $('#AlinhamentoTag').removeAttr('disabled');
        $('#AlinhamentoTexto').removeAttr('disabled');
        $('#AlinhamentoAssinatura').removeAttr('disabled');
        $('#BntSalvar').removeClass('item-hide');
        $('#BntExcluir').addClass('item-hide');
        $('#BntSalvar').addClass('mt-0');
    } else {
        $('#BntSalvar').addClass('item-hide');
        $('#BntExcluir').removeClass('item-hide');
        $('#Assinatura1').attr('disabled', '');
        $('#Assinatura2').attr('disabled', '');
        $('#UrlLancamentos').attr('disabled', '');
        $('#Background').attr('disabled', '');
        $('#TagExtra').attr('disabled', '');
        $('#TipoFonteTitulo').attr('disabled', '');
        $('#TipoFonteCorpo').attr('disabled', '');
        $('#FonteCorpo').attr('disabled', '');
        $('#AlinhamentoTag').attr('disabled', '');
        $('#AlinhamentoTexto').attr('disabled', '');
        $('#AlinhamentoAssinatura').attr('disabled', '');
        $('#FonteTitulo').attr('disabled', '');
        $('#FonteSubTitulo').attr('disabled', '');
    }
}
// habilita os campos de edição da senha (Configurações de Usuário - Senha)
function fnAbreEditarSenha() {
    if ($('#BntSalvarSenha').hasClass('item-hide')) {
        $('#Senha').removeAttr('disabled');
        $('#Usuario').removeAttr('disabled');
        $('#Email').removeAttr('disabled');
        $('#BntSalvarSenha').removeClass('item-hide');
        $('#BntSalvarSenha').addClass('mt-0');
    } else {
        $('#BntSalvarSenha').addClass('item-hide');
        $('#Senha').attr('disabled', '');
        $('#Usuario').attr('disabled', '');
        $('#Email').attr('disabled', '');
    }
}
// habilita os campos de edição da senha (Configurações de Usuário - Tags)
function fnAbreEditarTags() {
    if ($('#BntSalvarTags').hasClass('item-hide')) {
        $('#Apresenta').removeAttr('disabled');
        $('#Criticas').removeAttr('disabled');
        $('#Descricao').removeAttr('disabled');
        $('#Elenco').removeAttr('disabled');
        $('#Capa').removeAttr('disabled');
        $('#Episodios').removeAttr('disabled');
        $('#Faixas').removeAttr('disabled');
        $('#FichaTecnica').removeAttr('disabled');
        $('#Informacoes').removeAttr('disabled');
        $('#Instalacao').removeAttr('disabled');
        $('#Requisitos').removeAttr('disabled');
        $('#RequisitosRecomendados').removeAttr('disabled');
        $('#Screens').removeAttr('disabled');
        $('#Sinopse').removeAttr('disabled');
        $('#Trailer').removeAttr('disabled');
        $('#Agradecimento').removeAttr('disabled');
        $('#RequisitosMinimos').removeAttr('disabled');
        $('#Apresenta').removeClass('item-hide');
        $('#Criticas').removeClass('item-hide');
        $('#Descricao').removeClass('item-hide');
        $('#Elenco').removeClass('item-hide');
        $('#Capa').removeClass('item-hide');
        $('#Episodios').removeClass('item-hide');
        $('#Faixas').removeClass('item-hide');
        $('#FichaTecnica').removeClass('item-hide');
        $('#Informacoes').removeClass('item-hide');
        $('#Instalacao').removeClass('item-hide');
        $('#Requisitos').removeClass('item-hide');
        $('#RequisitosRecomendados').removeClass('item-hide');
        $('#Screens').removeClass('item-hide');
        $('#Sinopse').removeClass('item-hide');
        $('#Trailer').removeClass('item-hide');
        $('#Agradecimento').removeClass('item-hide');
        $('#RequisitosMinimos').removeClass('item-hide');
        $('#BntSalvarTags').removeClass('item-hide');
        $('#BntExcluir').addClass('item-hide');
        $('#BntSalvarTags').addClass('mt-4');
    } else {
        $('#BntSalvarTags').addClass('item-hide');
        $('#Apresenta').addClass('item-hide');
        $('#Criticas').addClass('item-hide');
        $('#Descricao').addClass('item-hide');
        $('#Elenco').addClass('item-hide');
        $('#Capa').addClass('item-hide');
        $('#Episodios').addClass('item-hide');
        $('#Faixas').addClass('item-hide');
        $('#FichaTecnica').addClass('item-hide');
        $('#Informacoes').addClass('item-hide');
        $('#Instalacao').addClass('item-hide');
        $('#Requisitos').addClass('item-hide');
        $('#RequisitosRecomendados').addClass('item-hide');
        $('#Screens').addClass('item-hide');
        $('#Sinopse').addClass('item-hide');
        $('#Trailer').addClass('item-hide');
        $('#Agradecimento').addClass('item-hide');
        $('#RequisitosMinimos').addClass('item-hide');
        $('#BntExcluir').removeClass('item-hide');
        $('#Apresenta').attr('disabled', '');
        $('#Capa').attr('disabled', '');
        $('#Criticas').attr('disabled', '');
        $('#Descricao').attr('disabled', '');
        $('#Elenco').attr('disabled', '');
        $('#Episodios').attr('disabled', '');
        $('#Faixas').attr('disabled', '');
        $('#FichaTecnica').attr('disabled', '');
        $('#Informacoes').attr('disabled', '');
        $('#Instalacao').attr('disabled', '');
        $('#Requisitos').attr('disabled', '');
        $('#RequisitosRecomendados').attr('disabled', '');
        $('#Screens').attr('disabled', '');
        $('#Sinopse').attr('disabled', '');
        $('#Trailer').attr('disabled', '');
        $('#RequisitosMinimos').attr('disabled', '');
        $('#Agradecimento').attr('disabled', '');
        $('#FonteTitulo').attr('disabled', '');
        $('#FonteSubTitulo').attr('disabled', '');
    }
}

// função que confirma saída do sistema
function fnFazLogout() {
    Swal.fire({
        title: 'Deseja sair do sistema?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, sair!',
        cancelButtonText: 'Não, ficar',
    }).then((result) => {
        if (result.value) {
            window.location.href = '../Login/logout.php';
        }
    });
}

// função que confirma saída do sistema
function fnDeletaLancamento(aux) {
    Swal.fire({
        title: 'EXCLUIR DESCRIÇÃO?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Não, cancelar',
    }).then((result) => {
        if (result.value) {
            window.location.href = `Delete.php?PkDescricao=${aux}`;
        }
    });
}

// função que marca uma mensagem como lida
function fnMarcarMsgLida(aux) {
    window.location.href = `LerMensagem.php?PkMensagem=${aux}`;
}

// função que redireciona para o form que irá subtrair ou somar meses
function fnProcessaEdicaoConfigUsuario(type) {
    const aux = type;
    if (aux === 2) {
        document.FormConfigUsuario.action = 'ProcessaEdicaoSenha.php';
        document.FormConfigUsuario.submit();
    } else if (aux === 1) {
        document.FormConfigUsuario.action = 'ProcessaEdicaoTags.php';
        document.FormConfigUsuario.submit();
    }
}