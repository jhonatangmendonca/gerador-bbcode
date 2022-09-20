<?php
header('Content-Type: application/json; charset=utf-8');

//KEYS API
$OMDB = "bde70b70";
$MOVIE_DB =  "a329e7039f6923b5946ce9cf9aa82b4e";

function get_name_cat_imdb($cat)
{
	$var = array();
	foreach ($cat as $value => $key) {
		switch (ltrim($key)) {

			default:

				break;

			case 'Sci-Fi':
				$var[] = " Sci-Fi";
				break;

			case 'Action':
				$var[] = " Ação";
				break;

			case 'Adventure':
				$var[] = " Aventura";
				break;

			case 'Animation':
				$var[] = " Animação";
				break;

			case 'Comedy':
				$var[] = " Comédia";
				break;

			case 'Crime':
				$var[] = " Crime";
				break;

			case 'Documentary':
				$var[] = " Documentário";
				break;

			case 'Drama':
				$var[] = " Drama";
				break;

			case 'Family':
				$var[] = " Família";
				break;

			case 'Fantasy':
				$var[] = " Fantasia";
				break;

			case 'History':
				$var[] = " História";
				break;

			case 'Horror':
				$var[] = " Terror";
				break;

			case 'Music':
				$var[] = " Música";
				break;

			case 'Mystery':
				$var[] = " Mistério";
				break;

			case 'Romance':
				$var[] = " Romance";
				break;

			case 'Science Fiction':
				$var[] = " Ficção científica";
				break;

			case 'TV Movie':
				$var[] = " Cinema TV";
				break;

			case 'Thriller':
				$var[] = " Thriller";
				break;

			case 'War':
				$var[] = " Guerra";
				break;

			case 'Western':
				$var[] = " Faroeste";
				break;
		}
	}
	return implode(",", $var);
}

#########################################################
#				RETORNA INFO DE TODAS API				#
#	       			 PAGINA DE DEBUG	                #
#########################################################if (!empty($_GET["imdb"])) {
	$code_IMDB = $_GET["imdb"];
} else {
	$code_IMDB = $_POST["imdb"];
}

//IMDB - OMDB
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.omdbapi.com/?i=" . urlencode($code_IMDB) . "&apikey=$OMDB&plot=full");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
$imdb = curl_exec($ch);
curl_close($ch);

$imdb = json_decode($imdb, true);

if ($imdb['Type'] == "episode") {

	//PEGA ALGUMAS INFOS DA SERIE	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/find/" . $imdb['seriesID'] . "?api_key=$MOVIE_DB&language=pt-BR&external_source=imdb_id");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$response = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($response, true);

	//PEGA INFOS GERAIS DA SÉREIS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/tv/" . $result['tv_results'][0]['id'] . "?api_key=$MOVIE_DB&language=pt-BR&external_source=imdb_id&append_to_response=credits");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$tv = curl_exec($ch);
	curl_close($ch);

	$tv_result = json_decode($tv, true);	//PEGA INFOS DO EPISODIO
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/tv/" . $result['tv_results'][0]['id'] . "/season/" . $imdb['Season'] . "/episode/" . $imdb['Episode'] . "?api_key=$MOVIE_DB&language=pt-BR");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$ep = curl_exec($ch);
	curl_close($ch);
	$ep_result = json_decode($ep, true);
}

if ($imdb['Type'] == "series") {

	//PEGA ALGUMAS INFOS DA SERIE	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/find/" . $code_IMDB . "?api_key=$MOVIE_DB&language=pt-BR&external_source=imdb_id");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$response = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($response, true);

	//PEGA INFOS GERAIS DA SÉREIS
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/tv/" . $result['tv_results'][0]['id'] . "?api_key=$MOVIE_DB&language=pt-BR&external_source=imdb_id&append_to_response=credits");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$tv = curl_exec($ch);
	curl_close($ch);

	$tv_result = json_decode($tv, true);
}

if ($imdb['Type'] == "movie") {

	//INFOS COMPLETAS DO FILME
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.themoviedb.org/3/movie/" . urlencode($code_IMDB) . "?api_key=$MOVIE_DB&language=pt-BR&append_to_response=credits");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$response = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($response, true);	//IMDB
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.omdbapi.com/?i=" . urlencode($code_IMDB) . "&apikey=$OMDB&plot=full");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, FALSE);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
	$imdb = curl_exec($ch);
	curl_close($ch);

	$imdb = json_decode($imdb, true);
}
if ($imdb['Type'] == "episode" or $imdb['Type'] == "series") {
	$API = array();

	$API['Type'] = $imdb["Type"];

	if ($imdb['Type'] == 'episode') {

		//Adiciona um 0 Ao lado da Temporada Caso Seja Menor ou Igual a 9
		if ($imdb['Season'] <= '9') {
			$temp = '0' . $imdb['Season'] . '';
		} else {
			$temp = $imdb['Season'];
		}

		//Adiciona um 0 Ao lado do Episodio Caso Seja Menor ou Igual a 9
		if ($imdb['Episode'] <= '9') {
			$ep = '0' . $imdb['Episode'] . '';
		} else {
			$ep = $imdb['Episode'];
		}

		if ($tv_result["name"] == $imdb["Title"]) {
			$API['Title'] = "$imdb[Title]";
		} else {
			$API['Title'] = '' . $tv_result["name"] . ' (' . $tv_result["original_name"] . ') - S' . $temp . 'E' . $ep . '';
		}
	}

	##RETORNA O NOME DO EPISODIO COM CAPA DO EP E DA SERIE CONTENDO A SINOPSE DO EPISODIO
	if ($imdb['Type'] == 'episode') {

		if ($ep_result["overview"] != "") {
			$API['overview'] = $ep_result["overview"];
		} else {
			$API['overview'] = 'Sinopose não encontrada';
		}

		$API['poster_path'] = 'https://image.tmdb.org/t/p/w500' . $tv_result["poster_path"] . '';
		$API['still_path'] = 'https://image.tmdb.org/t/p/w500' . $ep_result["still_path"] . '';
	}	//RETORNA O NOME DA SERIE E A CAPA E SINPSE
	if ($imdb['Type'] == 'series') {

		if ($tv_result["name"] == $imdb["Title"]) {
			$API['Title'] = "$imdb[Title]";
		} else {
			$API['Title'] = '' . $tv_result["name"] . ' (' . $tv_result["original_name"] . ')';
		}

		if ($result['tv_results'][0]['overview'] != "") {
			$API['overview'] = $result['tv_results'][0]['overview'];
		} else {
			$API['overview'] = 'Sinopose não encontrada';
		}

		$API['poster_path'] = 'https://image.tmdb.org/t/p/w500' . $result['tv_results'][0]['poster_path'] . '';
	}

	$API['Year'] = '' . date_format(date_create($tv_result["first_air_date"]), "Y") . '';
	$API['Rated'] = '' . $imdb["Rated"] . '';
	$genres =  explode(',', "$imdb[Genre]");
	$API['Genre'] = get_name_cat_imdb($genres);
	$API['Released'] = '' . $imdb["Released"] . '';
	$API['Runtime'] = '' . $imdb["Runtime"] . '';
	$API['Director'] = '' . $imdb["Director"] . '';
	$API['Writer'] = '' . $imdb["Writer"] . '';
	$API['Actors'] = '' . $imdb["Actors"] . '';
	$API['Language'] = '' . $imdb["Language"] . '';
	$API['Country'] = '' . $imdb["Country"] . '';
	$API['Poster'] = '' . $imdb["Poster"] . '';
	$API['Awards'] = '' . $imdb["Awards"] . '';
	$API['Metascore'] = '' . $imdb["Metascore"] . '';
	$API['imdbRating'] = '' . $imdb["imdbRating"] . '';
	$API['imdbVotes'] = '' . $imdb["imdbVotes"] . '';
	$API['imdbID'] = '' . $imdb["imdbID"] . '';
	$API['Website'] = '' . $tv_result["homepage"] . '';
	foreach ($imdb["Ratings"] as $value[]) {
		$API['Ratings'] =  $value;
	}

	if ($tv_result['credits']['cast']) {
		foreach (array_slice($tv_result['credits']['cast'], 0, 5) as $cast[]) {
			$API['cast'] =  $cast;
		}
	}

	$form = array(
		"ASC" => $API,
		"TMDB_EP" => $ep_result,
		"TMDB_FIND" => $result,
		"TMDB_TV" => $tv_result,
	);
	echo json_encode($form, JSON_UNESCAPED_UNICODE);
} //IF VALIDA DADOS IMDB	
#########################################################
#	    CÓDIGO SEPARADO PARA UMA MELHOR ORGANIZAÇÃO		#
#	        		PEGA INFO DOS FILMES                #
#########################################################
if ($imdb['Type'] == 'movie') {

	$API = array();

	if ($result["title"] == $imdb["Title"]) {
		$API['Title'] = "$imdb[Title]";
	} else {
		$API['Title'] = '' . $result["title"] . ' (' . $imdb["Title"] . ')';
	}

	$API['Type'] = '' . $imdb["Type"] . '';
	$API['Year'] = '' . $imdb["Year"] . '';
	$API['Rated'] = '' . $imdb["Rated"] . '';
	$API['id'] = '' . $result["id"] . '';
	$genres =  explode(',', "$imdb[Genre]");
	$API['Genre'] = get_name_cat_imdb($genres);
	$API['Released'] = '' . $result["release_date"] . '';
	$API['Runtime'] = '' . $imdb["Runtime"] . '';
	$API['Director'] = '' . $imdb["Director"] . '';
	$API['Writer'] = '' . $imdb["Writer"] . '';
	$API['Actors'] = '' . $imdb["Actors"] . '';
	$API['Language'] = '' . $imdb["Language"] . '';
	$API['Country'] = '' . $imdb["Country"] . '';
	$API['Poster'] = '' . $imdb["Poster"] . '';
	$API['Awards'] = '' . $imdb["Awards"] . '';
	$API['Metascore'] = '' . $imdb["Metascore"] . '';
	$API['imdbRating'] = '' . $imdb["imdbRating"] . '';
	$API['imdbVotes'] = '' . $imdb["imdbVotes"] . '';
	$API['imdbID'] = '' . $imdb["imdbID"] . '';
	$API['DVD'] = '' . $imdb["DVD"] . '';
	$API['BoxOffice'] = '' . $imdb["BoxOffice"] . '';
	$API['Production'] = '' . $imdb["Production"] . '';
	$API['Website'] = '' . $imdb["Website"] . '';
	$API['Website'] = '' . $imdb["Website"] . '';
	foreach ($imdb["Ratings"] as $value[]) {
		$API['Ratings'] =  $value;
	}

	if ($result["overview"] != "") {
		$API['overview'] = $result["overview"];
	} else {
		$API['overview'] = 'Sinopose não encontrada';
	}

	$API['poster_path'] = 'https://image.tmdb.org/t/p/w500/' . $result["poster_path"] . '';

	foreach (array_slice($result['credits']['cast'], 0, 5) as $cast[]) {
		$API['cast'] =  $cast;
	}

	$form = array(
		"ASC" => $API,
		"TMDB" => $result
	);

	echo  json_encode($form, \JSON_UNESCAPED_UNICODE);
}

///////////////////////////////// TERMINA GERADOR DE INFO PARA SÉRIES //////////////////////////////////////////////
