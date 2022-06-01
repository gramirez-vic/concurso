$( document ).ready( function() {
	confetti.stop();
});
var maxParticleCount = 200;
var particleSpeed = 3;

var refreshIntervalId = '';

var audio = document.getElementById("audio");
var audio2 = document.getElementById("audio2");

var landing = 
{
	iniciaSorteo:function(sorteo)
	{
		confetti.stop();
		$.ajax({
			url:  "ajax.php",
			data: "sorteo="+sorteo,
			type: "POST",
			dataType: "json",
			beforeSend:function()
			{
				audio.play();
				$("#mensaje").html("");
				$("#mensaje").hide();
				$("#status").html("&nbsp;")
				refreshIntervalId = setInterval(function(){
					landing.aleatorioNombres()
				},20);
				$("#matricula").html("matrícula");
				$("#ganador").html("nombre del ganador");
				$("#direccion").html("direccion");
				$("#status").html("&nbsp;")
			},
			success:function(json)
			{
				clearInterval(refreshIntervalId);
				audio.pause();
      			audio.currentTime = 0;
				if(json.continuar == 1)
				{
					$("#matricula").html(json.datos.matricula);
					$("#ganador").html(json.datos.nombre);
					$("#direccion").html("direccion");
					if(json.esGanador == 1)
					{
						confetti.start();
						$("#status").html("<span style='color:green;font-weight:bold'>GANADOR!!</span>");
						audio2.play();
						audio2.currentTime = 0;
					}
					else
					{
						$("#status").html("<span style='color:red;font-weight:bold'>Gracias por su Pago Oportuno,<br> Sigue intentando</span>");
					}
				}
				else
				{
					$("#mensaje").show();
					$("#matricula").html("matrícula");
					$("#ganador").html("nombre del ganador");
					$("#direccion").html("direccion");
					$("#status").html("&nbsp;")
					$("#mensaje").html("<strong>Atención!</strong> "+json.mensaje)
				}
			},
			error:function(e) {
				
			}
		});

		
	},
	aleatorioNombres:function()
	{
		var nombreAleatorio = [{"nombre":"BELTRAN BERNAL LUZ MARINA","matricula":"105542"},{"nombre":"SANTACRUZ PEDRAZA LUISA FERNANDA","matricula":"101077"},{"nombre":"TRONCOSO BEATRIZ","matricula":"101121"},{"nombre":"LAVERDE POLANCO","matricula":"102486"},{"nombre":"GONZALEZ RAFAEL","matricula":"103829"},{"nombre":"REDONDO ORMINZO","matricula":"104543"},{"nombre":"JUNTA DE ACCION COMUNAL FRANCISCO N","matricula":"100297"},{"nombre":"ZAMBRANO LUIS HERNANDO","matricula":"100373"},{"nombre":"LOZADA BERNAL CONSUELO","matricula":"103864"},{"nombre":"RESIDENCIAS MAGDALENA","matricula":"105195"},{"nombre":"DIAZ PLUTARCO","matricula":"105472"},{"nombre":"LUIS ALBERTO TRUJILLO .","matricula":"105822"},{"nombre":"PEREZ JAIRO","matricula":"106813"},{"nombre":"MARIA ELISA MURCIA GODOY","matricula":"108476"},{"nombre":"BRI?EZ ORDO?EZ MAURICIO","matricula":"100003"},{"nombre":"CASTA?EDA GAITAN CARLOS ARMANDO","matricula":"100034"},{"nombre":"DUARTE DIAZ NIDIA Y MAURICIO","matricula":"100526"},{"nombre":"MONDRAGON CORTAZAR JOSE ALBERTO","matricula":"102412"},{"nombre":"ORGANIZACION MONTECARLO .","matricula":"102903"},{"nombre":"VILLAMIZAR GABINO","matricula":"103310"},{"nombre":"PEREZ VERA CARLOS AUGUSTO Y OTRO","matricula":"103517"},{"nombre":"REYES ROBAYO MERCEDES","matricula":"105084"},{"nombre":"LOPEZ MENDEZ FABIO","matricula":"105592"},{"nombre":"RAVAGLI CORTES RICARDO LEON","matricula":"105640"},{"nombre":"SANDOVAL RENGIFO MARLENY DE","matricula":"105689"},{"nombre":"RUEDA JORGE","matricula":"105856"},{"nombre":"ESTEFANIA BELTRAN TAFUR","matricula":"107132"},{"nombre":"CRUZ AGUIRRE JOSE MANUEL","matricula":"107195"},{"nombre":"CARDOZO JERONIMO","matricula":"107782"},{"nombre":"GODOY LIBIA JOSEFA","matricula":"107820"},{"nombre":"MORENO MARCOS","matricula":"100124"},{"nombre":"UNDA HERNANDEZ DARIO","matricula":"100299"},{"nombre":"TRUJILLO CRUZ JOSE FRANCISCO","matricula":"100752"},{"nombre":"AVENDA?O LUGO LUCILA VDA DE","matricula":"101009"},{"nombre":"DIAZ HERNANDEZ GERARDO","matricula":"101155"},{"nombre":"ARCINIEGAS JAIME","matricula":"101209"},{"nombre":"ARIAS JESUS","matricula":"101267"},{"nombre":"ORTIZ RODRIGUEZ YANETH","matricula":"101279"},{"nombre":"LEON VARGAS MERCEDES","matricula":"101605"},{"nombre":"RENGIFO TORRES RUBY","matricula":"102363"},{"nombre":"SERNA MEJIA FERNANDO","matricula":"103351"},{"nombre":"PEREZ DEYSY","matricula":"103525"},{"nombre":"JOSE MORENO LABRADOR .","matricula":"103614"},{"nombre":"MARISOL CAMPOS CORREA .","matricula":"103701"},{"nombre":"SMITH PATRICIA","matricula":"103971"},{"nombre":"TOVAR ALBA","matricula":"103990"},{"nombre":"CAMACHO SANTOS A","matricula":"104256"},{"nombre":"HERNANDEZ SANTOFIMIO GRACIELA","matricula":"104317"},{"nombre":"OLAYA ELOISA DE","matricula":"104679"},{"nombre":"ARCILA JOSE ROGELIO","matricula":"106028"},{"nombre":"MARTINEZ ALFONSO MARIA","matricula":"106254"},{"nombre":"CELI PEREZ JOSE DE JESUS","matricula":"106495"},{"nombre":"FORERO BOCANEGRA LUZ MERY","matricula":"106531"},{"nombre":"DIAZ MANRIQUE EDILMA","matricula":"106838"},{"nombre":"MEDINA CLARA ASTRID","matricula":"107146"},{"nombre":"LOZADA ALVARO","matricula":"107354"},{"nombre":"MARISOL LENIS MELO","matricula":"108235"},{"nombre":"CONSTRUCTORA COL CONSEL\/ EMPERATRIZ AMAYA","matricula":"108336"},{"nombre":"CINDY JHOANA QUESADA BARRERO","matricula":"108457"},{"nombre":"CINDY JHOANA QUESADA BARRERO","matricula":"108458"},{"nombre":"GALEANO GREGORIO","matricula":"100168"},{"nombre":"JOSE MENDEZ GAITAN","matricula":"100169"},{"nombre":"SANCHEZ LIGIA DE","matricula":"100559"},{"nombre":"CASTRO BAEZ HENRY GUSTAVO","matricula":"100577"},{"nombre":"PULIDO MIRTA","matricula":"100706"},{"nombre":"BOADA OBDULIO","matricula":"100791"},{"nombre":"CASTA?EDA ELICEO","matricula":"100909"},{"nombre":"?UNGO NELSON","matricula":"101393"},{"nombre":"CRUZ AGUIRRE JOSE MANUEL","matricula":"101394"},{"nombre":"BOLIVAR VELEZ JOSUE JIMMY","matricula":"101402"},{"nombre":"DURAN EFRAIN","matricula":"101839"},{"nombre":"QUINTANILLA NUBIA","matricula":"102215"},{"nombre":"ZABALA MARTIN","matricula":"102746"},{"nombre":"MIRANDA MAIRA EMILCE","matricula":"102788"},{"nombre":"URBANIZACION MONTECARLOS .","matricula":"102951"},{"nombre":"URBANIZACION MONTECARLOS .","matricula":"102952"},{"nombre":"GUZMAN HIPOLITO","matricula":"103052"},{"nombre":"RAMIREZ MARIA RAMONA","matricula":"103153"},{"nombre":"SUAREZ ANTONIO","matricula":"103397"},{"nombre":"MONTEALEGRE ROMERO LEX LEILA","matricula":"103526"},{"nombre":"RAMIREZ CIRO MARLENY","matricula":"103595"},{"nombre":"BONILLA BEHAINE LILIANA","matricula":"103861"},{"nombre":"SANCHEZ FERNANDO","matricula":"103863"},{"nombre":"CAVIEDES BERNAL LIGIA","matricula":"103885"},{"nombre":"CONTRERAS DE MENDEZ MARIA DEL CARME","matricula":"103966"},{"nombre":"VELANDIA LUIS EDUARDO","matricula":"104133"},{"nombre":"JIMMY BOLIVAR VELEZ","matricula":"104408"},{"nombre":"CHAVEZ GUTIERREZ HIPOLITO","matricula":"104415"},{"nombre":"VILLA ROBERTO","matricula":"104515"},{"nombre":"BOLIVAR VELEZ JOSUE JIMMY","matricula":"104611"},{"nombre":"BOLIVAR VELEZ JOSUE JIMMY","matricula":"104612"},{"nombre":"CALDAS ALFONSO Y OTROS","matricula":"104707"},{"nombre":"BERNARDO NAVARRO BAQUERO","matricula":"104759"},{"nombre":"RAVAGLI TRIANA SUSANA PATRICIA","matricula":"104782"},{"nombre":"NAVARRO BAQUERO BERNANDO","matricula":"104882"},{"nombre":"REINA BASTO JAQUELINE","matricula":"105055"},{"nombre":"BANCO CENTRAL HIPOTECARIO","matricula":"105306"},{"nombre":"PALMA GREGORIO","matricula":"105488"},{"nombre":"AVIALA OVALLE ELSA","matricula":"105831"},{"nombre":"PARRA V. EDILBERTO","matricula":"106173"}]
		//genero un número aleatorio
		var aleatorio = landing.NumerosAleatorios(0,(nombreAleatorio.length - 1));
		//console.log(nombreAleatorio[aleatorio].nombre);
		$("#ganador").html(nombreAleatorio[aleatorio].nombre);
		$("#matricula").html(nombreAleatorio[aleatorio].matricula);
		
	},
	NumerosAleatorios:function(min, max) {
		return Math.round(Math.random() * (max - min) + min);
	},
	backButton:function()
	{
		window.history.back();
	}
}