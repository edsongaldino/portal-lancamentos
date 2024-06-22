// Mostra a camada
function mostrar_camada(camadas) {
	var camada = camadas.split(",");
	for(i=0;i<camada.length;i++) {
		document.getElementById(camada[i]).style.display = ""; // nao pode ser block pq senao quebra linha, tem que ser vazio
	}
}

// Oculta a camada
function ocultar_camada(camadas) {
	var camada = camadas.split(",");

	for(i=0;i<camada.length;i++) {
		document.getElementById(camada[i]).style.display = "none";
	}
}