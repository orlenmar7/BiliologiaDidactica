<template>
    <div>
        <div class="contenedor">
        <section>
          <p id="respuesta" data-nivel='2'></p>
          <div id="mesa">
          </div>
        </section>
      </div>
    </div>
</template>

<script>

import { mapGetters } from 'vuex'
import axios from 'axios'
import swal from 'sweetalert2'
import carta from './../../img/default/carta.png'

export default {

  props: ['props_history'],
  scrollToTop: false,

  data: () => ({
  	title: 'Memoria',
  	historiy: {
      category: {
        name: ''
      }
    },
    words: [],
    history_id: null,
  }),

  methods: {
  	main (){
  		if (this.history_id) {
            this.getHistoriy(this.history_id)
        }
  	},
    loadWords (images) {
      var d = document;
      var maxCartas = 0;
      var paresCartasDescubiertas = 0;
      var paresCartasErroneas = 0;

      var respuestaJuego = d.querySelector('#respuesta');
      var mesaJuego = d.querySelector('#mesa');

      var arrayCartas = [];
      var arrayPersonaAleatoeios = [];
      var arrayPosicionAleatoria = [];
      var arrayCartasSeleccionadas = [];
      var arrayIdSeleccionadas = [];
      var cartasJuego = []

      var arrayPersona = [];

      images.forEach((item) => {
        arrayPersona.push(item.image_url);
      });

      var numerosUsados = [];

      function numerosAleatorios(min , max){
        while(repe != false){
          var numero=Math.floor(Math.random()*(max-min+1))+min;
          var repe = repetidos(numero);
          numerosUsados.push(numero);
        }
        return numero;
      }

      function repetidos(num){
        var repe = false;
        for (var i = 0; i < numerosUsados.length; i++) {
          if (num == numerosUsados[i]) {
            repe = true;
          };
        };
        return repe;
      }

      function cartasAleatorias() {
        /*Seleccionados  ocho HÃ©roes aleatorios sin que se repitan */
        var nunCartas = respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel;
          nunCartas = nunCartas / 2;
        for (var i = 0; i < nunCartas; i++) {
          arrayPersonaAleatoeios[i] = numerosAleatorios(0,arrayPersona.length - 1) ;
          //console.log(arrayPosicionAleatoria[i]);
        };
        /*Eliminamos todos los registros del array numerosUsados */
        numerosUsados.splice(0,numerosUsados.length);
      }

      function posicionAleatorias() {
        /*Seleccionados  ocho HÃ©roes aleatorios sin que se repitan */
        var nunCartas = respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel;
        for (var i = 0; i < nunCartas; i++) {
          arrayPosicionAleatoria[i] = numerosAleatorios(0,nunCartas-1) ;
          //console.log(arrayPosicionAleatoria[i]);
        };
        /*Eliminamos todos los registros del array numerosUsados */
        numerosUsados.splice(0,numerosUsados.length);
      }

      function cuentaRegresiba(num){
        var contador = num;
        function resta(){
          contador = contador - 1;
          window.segundosGamar = contador;
          if (contador<6) {
            respuestaJuego.style.color = "red";
          };
          respuestaJuego.innerHTML = contador;
          if (contador==0) {
            acabarCuantaAtras();
          };
        }
        function acabarCuantaAtras(){
          clearInterval(temporalizador);
          gameOver();
        }
        window.temporalizador=setInterval(resta,1000);
      }

      function generarTabla(num) {

        // Crea un elemento <table> y un elemento <tbody>
          var tabla   = d.createElement("table");
          var tblBody = d.createElement("tbody");

          // Crea las tdTablas
          for (var i = 0; i < num; i++) {
            // Crea las hileras de la tabla
            var trTabla = d.createElement("tr");

            for (var j = 0; j < num; j++) {
                // Crea un elemento <td> y un nodo de texto, haz que el nodo de
                // texto sea el contenido de <td>, ubica el elemento <td> al final
                // de la trTabla de la tabla
                var tdTabla = d.createElement("td");
                var imgCarta = d.createElement('img');
                imgCarta.setAttribute("src", carta);
                imgCarta.setAttribute("data-id", "");
                imgCarta.setAttribute("class", "carta-heroe");
                tdTabla.appendChild(imgCarta);
                trTabla.appendChild(tdTabla);
            }

              // agrega la trTabla al final de la tabla (al final del elemento tblbody)
              tblBody.appendChild(trTabla);
        }

        // posiciona el <tbody> debajo del elemento <table>
          tabla.appendChild(tblBody);
          // appends <table> into <body>
          mesaJuego.appendChild(tabla);
          // modifica el atributo "border" de la tabla y lo fija a "2";
          tabla.setAttribute("class", "tabla-cartas");
          tabla.setAttribute("cellspacing", "0");
      }

      function verCarta(evento) {
        var id = evento.target.dataset.id;
        cartasJuego[id].setAttribute("src", arrayCartas[id]);
        cartasJuego[id].removeEventListener('click', verCarta);
        arrayCartasSeleccionadas.push(arrayCartas[id]);
        arrayIdSeleccionadas.push(id);
        if (arrayCartasSeleccionadas.length>2) {
          if (arrayCartasSeleccionadas[0] == arrayCartasSeleccionadas[1]) {
            //console.log(paresCartasDescubiertas);
            cartasJuego[arrayIdSeleccionadas[0]].removeEventListener('click', verCarta);
            cartasJuego[arrayIdSeleccionadas[1]].removeEventListener('click', verCarta);
            //console.log("\n----------Son Iguales----------");
            arrayCartasSeleccionadas.splice(0,arrayCartasSeleccionadas.length-1);
            arrayIdSeleccionadas.splice(0,arrayIdSeleccionadas.length-1);

          } else{
            cartasJuego[arrayIdSeleccionadas[0]].addEventListener('click', verCarta);
            cartasJuego[arrayIdSeleccionadas[1]].addEventListener('click', verCarta);
            cartasJuego[arrayIdSeleccionadas[0]].setAttribute("src", carta);
            cartasJuego[arrayIdSeleccionadas[1]].setAttribute("src", carta);
            //console.log("\n----------Son Diferentes----------");
            arrayCartasSeleccionadas.splice(0,arrayCartasSeleccionadas.length-1);
            arrayIdSeleccionadas.splice(0,arrayIdSeleccionadas.length-1);
          };

        }
        if (arrayCartasSeleccionadas.length>1) {
          if (arrayCartasSeleccionadas[0] == arrayCartasSeleccionadas[1]) {
            paresCartasDescubiertas++;
            //console.log("paresCartasDescubiertas:  "+paresCartasDescubiertas);
            cartasJuego[arrayIdSeleccionadas[0]].setAttribute("class", "cartas-descubiertas");
            cartasJuego[arrayIdSeleccionadas[1]].setAttribute("class", "cartas-descubiertas");
          }else{
            paresCartasErroneas++;
          }

          if (paresCartasDescubiertas == respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel / 2 ) {
            clearInterval(temporalizador);
            respuesta.style.color = "#333";
            respuesta.innerHTML  = "<h2 class='bn'>Felicitaciones has Ganado faltando "+segundosGamar+" segundos :)</h2><table class='estadistica'><tr><th>CARTAS DESCUBIERTAS</th><th>CARTAS FALTANTES</th><th>INTENTOS FALLIDOS</th></tr><tr><td>"+paresCartasDescubiertas+"</td><td>"+(respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel  / 2 - paresCartasDescubiertas)+"</td><td>"+paresCartasErroneas+"</td></tr></table><br><a href='javascript: limpiarMesa();' class='btn btn-primary btn-sm'>Siguiente Nivel</a>";
            if (respuestaJuego.dataset.nivel==2) {
              respuestaJuego.dataset.nivel=4;
              console.log(respuesta.dataset.nivel);
            }else if (respuestaJuego.dataset.nivel==4) {
              if (arrayPersona.length >= 18) {
                respuestaJuego.dataset.nivel=6;
                console.log(respuesta.dataset.nivel);
              }
            };
          };
        }
      }

      window.limpiarMesa = function (){
        paresCartasDescubiertas=0;
        respuesta.style.color = "#333";
        arrayCartasSeleccionadas.splice(0,arrayCartasSeleccionadas.length);
        arrayIdSeleccionadas.splice(0,arrayIdSeleccionadas.length);
        mesaJuego.innerHTML = '';
        main();
      }

      function gameOver(){
        clearInterval(temporalizador);
        for (var i = cartasJuego.length - 1; i >= 0; i--) {
          cartasJuego[i].removeEventListener("click",verCarta);
        };
        respuesta.innerHTML  = "<h2 class='error'>Game Over :(</h2><table class='estadistica'><tr><th>CARTAS DESCUBIERTAS</th><th>CARTAS FALTANTES</th><th>INTENTOS FALLIDOS</th></tr><tr><td>"+paresCartasDescubiertas+"</td><td>"+(respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel  / 2 - paresCartasDescubiertas)+"</td><td>"+paresCartasErroneas+"</td></tr></table><br><a href='javascript: limpiarMesa();' class='btn btn-info btn-sm'>Jugar de Nuevo</a>";
      }

      function activarCartas() {
        cartasJuego = d.querySelectorAll('.carta-heroe');
        for (var i = cartasJuego.length - 1; i >= 0; i--) {
          cartasJuego[i].dataset.id = i;
          cartasJuego[i].addEventListener( 'click', empazarJuego);
          arrayCartas[i] = i;
          //console.log(arrayCartas[i]);
        };
      }

      function empazarJuego(evento) {
        var id = evento.target.dataset.id;
        for (var i = cartasJuego.length - 1; i >= 0; i--) {
          cartasJuego[i].removeEventListener("click",empazarJuego);
          cartasJuego[i].addEventListener( 'click', verCarta);
        };
        cuentaRegresiba(tiempo);
        cartasJuego[id].setAttribute("src", arrayCartas[id]);
        arrayCartasSeleccionadas.push(arrayCartas[id]);
        arrayIdSeleccionadas.push(id);
        cartasJuego[id].removeEventListener('click', verCarta);
      }

      function main() {
        /*Se muestra los segundos*/
        window.tiempo = respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel  / 2;
        respuestaJuego.textContent = tiempo;

        generarTabla(respuestaJuego.dataset.nivel);

        activarCartas();

        cartasAleatorias();

        posicionAleatorias();

        for (var i = 0; i < respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel; i++) {
          maxCartas++;
          var numC = respuestaJuego.dataset.nivel * respuestaJuego.dataset.nivel;
            numC = numC / 2;
          if (maxCartas>numC) {
            maxCartas = 1;
          };

          arrayCartas[arrayPosicionAleatoria[i]] = arrayPersona[arrayPersonaAleatoeios[maxCartas-1]];

        };

      }

      setTimeout(() => {
        main();
      }, 300)

    },
  	async getHistoriy(id) {
        const {
            data
        } = await axios.get(`/api/admin/histories/${id}`)
        this.historiy = data
        if (this.historiy.memores) {
          this.loadWords(this.historiy.memores)
        }
    },
  },

  mounted() {
	if (this.props_history) {
      var _history = JSON.parse(this.props_history);
      this.history_id = _history.id
    }
    this.main();
  }

}
</script>

<style type="text/css">

.contenedor header{
  width: 100%;
  margin: auto;
  background: #333;
  padding: 5px;
  color: #fff;
}

.contenedor header h1{
  text-align: center;
}

#btn-jugar{
  font-size: 20px;
  font-weight: bold;
  margin: 5px;
  background: #f1d332;
  color: #333;
  border-radius: 5px;
  cursor: pointer;
}

#respuesta{
  text-align: center;
  color: #333;
  margin: auto;
  width: 100%;
}

#mesa{
  margin: auto;
  text-align: center;
  width: 80%;
  border: solid 2px #333;
  padding: 10px;
  background: #fff;
}

#mesa .tabla-cartas{
  text-align: center;
  margin: auto;
}

#mesa .tabla-cartas tr, #mesa .tabla-cartas td{
  border: 0;
  padding: 0;
  margin: 0;
}

#mesa .tabla-cartas img{
  width: 90px;
  border: solid 1px #fff;
}

img.carta-heroe{
  cursor: pointer;
}

.cartas-descubiertas{
  opacity: 0.5;
  border: solid  1px #127dbd!important;
}

.estadistica{
  width: 100%;
  margin: auto;
}


.bn{
  background: #2cea62;
  color: #fff;
  font-weight: bold;
  width: 100%;
  margin: auto;
  text-align: center;
}
.error{
  background: #ea2c2c;
  color: #fff;
  font-weight: bold;
  width: 100%;
  margin: auto;
  text-align: center;
}

</style>
