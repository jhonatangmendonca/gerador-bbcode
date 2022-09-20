$(document).ready(function () {
  $('#encontrar').click(function () {
    var imdb = $('#imdb').val();
    var layout_ID = $('#layout').val();
    var BBCode = '';
    $.ajax({
      type: 'POST',
      url: 'Search.php',
      dataType: 'json',
      data: { imdb: imdb, layout: layout_ID },
      success: function (data) {
        if (data.ASC.Type == 'movie') {
          $('#imdbtitle').html('');

          BBCode += '[center] \n';

          if (data.ASC.BARRINHA_CUSTOM_T_1) {
            BBCode +=
              '\n ' +
              formatImageBBCodeWithUrl(data.ASC.BARRINHA_CUSTOM_T_1) +
              '\n ';
          }

          if (data.ASC.BARRINHA_CUSTOM_T_2) {
            BBCode +=
              '\n ' +
              formatImageBBCodeWithUrl(data.ASC.BARRINHA_CUSTOM_T_2) +
              '\n ';
          }

          if (data.ASC.BARRINHA_CUSTOM_T_3) {
            BBCode +=
              '\n ' +
              formatImageBBCodeWithUrl(data.ASC.BARRINHA_CUSTOM_T_3) +
              '\n ';
          }

          if (data.ASC.BARRINHA_APRESENTA) {
            BBCode +=
              '\n ' +
              formatImageBBCodeWithUrl(data.ASC.BARRINHA_APRESENTA) +
              '\n ';
          }

          BBCode += '\n[size=3]' + data.ASC.Title + '[/size]';

          if (data.ASC.poster_path) {
            if (data.ASC.BARRINHA_CAPA) {
              BBCode +=
                '\n ' +
                formatImageBBCodeWithUrl(data.ASC.BARRINHA_CAPA) +
                '\n ';
            }
            BBCode +=
              '\n' + formatImageBBCodeWithUrl(data.ASC.poster_path) + '\n ';
          }

          if (data.ASC.overview) {
            if (data.ASC.BARRINHA_SINOPSE) {
              BBCode +=
                '\n ' +
                formatImageBBCodeWithUrl(data.ASC.BARRINHA_SINOPSE) +
                '\n ';
            }

            BBCode += '\n ' + data.ASC.overview + '\n ';
          }

          if (data.ASC.BARRINHA_FICHA_TECNICA) {
            BBCode +=
              '\n ' +
              formatImageBBCodeWithUrl(data.ASC.BARRINHA_FICHA_TECNICA) +
              '\n ';
          }

          BBCode += '\n Tempo: ' + data.ASC.Runtime + '';
          BBCode += '\n Produtora: ' + data.ASC.Production + '';
          BBCode += '\n País de Origem: ' + data.ASC.Country + '';
          BBCode += '\n Gêneros: ' + data.ASC.Genre + '';
          BBCode +=
            '\n Data de Lançamento: ' + formatDate(data.ASC.Released) + '';

          if (data.ASC.Website != 'N/A')
            BBCode +=
              '\n Site: [url=' + data.ASC.Website + '] Clique aqui [/url]';

          //Lista os Atores
          if (data.ASC.cast) {
            if (data.ASC.BARRINHA_ELENCO) {
              BBCode +=
                '\n ' +
                formatImageBBCodeWithUrl(data.ASC.BARRINHA_ELENCO) +
                '\n ';
            }

            data.ASC.cast.forEach((element) => {
              if (element.profile_path == null) {
                var profile = '[img]https://i.imgur.com/eCCCtFA.png[/img]';
              } else {
                var profile =
                  '[img]https://image.tmdb.org/t/p/w45' +
                  element.profile_path.trim('') +
                  '[/img]';
              }
              BBCode +=
                '\n[url=https://www.themoviedb.org/person/' +
                element.id +
                '?language=pt-BR]' +
                profile +
                '[/url]';
              BBCode +=
                '\n[size=2][b](' +
                element.name.trim('') +
                ') como ' +
                element.character.trim() +
                '[/b][/size]\n';
            });
          }

          if (data.ASC.Ratings) {
            if (data.ASC.BARRINHA_INFORMACOES) {
              BBCode +=
                '\n ' +
                formatImageBBCodeWithUrl(data.ASC.BARRINHA_INFORMACOES) +
                '\n ';
            }

            data.ASC.Ratings.forEach((element) => {
              switch (element.Source) {
                case 'Internet Movie Database':
                  BBCode +=
                    '\n[img]https://i.postimg.cc/Pr8Gv4RQ/IMDB.png[/img]';
                  BBCode +=
                    '\n[url=https://www.imdb.com/title/' +
                    data.ASC.imdbID +
                    '][b]' +
                    element.Value.trim() +
                    '[/b][/url]';
                  break;

                case 'Rotten Tomatoes':
                  BBCode +=
                    '\n[img]https://i.postimg.cc/rppL76qC/rotten.png[/img]';
                  BBCode += '\n[b]' + element.Value.trim() + '[/b]';
                  break;

                case 'Metacritic':
                  BBCode +=
                    '\n[img]https://i.postimg.cc/SKkH5pNg/Metacritic45x45.png[/img]';
                  BBCode += '\n[b]' + element.Value.trim() + '[/b]';
                  break;

                default:
                  break;
              }
            });
          }

          if (data.ASC.BARRINHA_CUSTOM_B_1) {
            BBCode +=
              '\n ' +
              formatImageBBCodeWithUrl(data.ASC.BARRINHA_CUSTOM_B_1) +
              '\n ';
          }

          if (data.ASC.BARRINHA_CUSTOM_B_2) {
            BBCode +=
              '\n ' +
              formatImageBBCodeWithUrl(data.ASC.BARRINHA_CUSTOM_B_2) +
              '\n ';
          }

          if (data.ASC.BARRINHA_CUSTOM_B_3) {
            BBCode +=
              '\n ' +
              formatImageBBCodeWithUrl(data.ASC.BARRINHA_CUSTOM_B_3) +
              '\n ';
          }

          BBCode += '\n[/center]'; //TERMINA ALINHAMENTO

          $('.sc').val(BBCode);
          sceditor.instance(textarea).val(BBCode);

          if (data.ASC.Title) {
            $('#name').val(data.ASC.Title);
          }
          if (data.ASC.Genre) {
            $('#genre').val(data.ASC.Genre);
          }
          if (data.ASC.Year) {
            $('#ano')
              .find('option:contains("' + data.ASC.Year + '")')
              .prop('selected', true);
          }
          if (data.ASC.poster_path) {
            $('#capa').val(data.ASC.poster_path);
            $('#capa');
          }
        } else if (data.ASC.Type == 'series' || data.ASC.Type == 'episode')
          $('#imdbtitle').html(
            '<div class="alert alert-info"><label>Você informou um seriado Ou episodio!</label></div>'
          );
        else
          $('#imdbtitle').html(
            '<label>Erro ao acessar serviço! Tente novamente em 60s.</label>'
          );
      },
      error: function (data) {
        $('#error').html(
          '<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Erro!</strong> Nenhuma informação encontrada com este código<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>'
        );
      },
    });
  });
});

function formatDate(date) {
  var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return [month, month, year].join('/');
}

var formatImageBBCodeWithUrl = function (url) {
  return '[img]' + url + '[/img]';
};
