<template>
    <div id="jue">
        <h2>Sopa de letras {{ historiy.title }} <i class="icon-pencil"></i></h2>
              <span style="background: #1478f8; color: #fff;padding: 5px 13px;border-radius: 10px;"> Categoría: {{ historiy.category.name }} </span>

                    <hr>

              <div id='game'></div>
              <div id='words'></div>
    </div>
</template>

<script>

import axios from 'axios'
import swal from 'sweetalert2'

export default {

  scrollToTop: false,
  props: ['props_history'],

  data: () => ({
    history_id: null,
  	title: 'Sopa de letras',
  	historiy: {
      category: {
        name: ''
      }
    },
    words: [],
  }),

  methods: {
  	main (){
  		if (this.history_id) {
            this.getHistoriy(this.history_id)
        }
  	},
    loadWords (_words) {
      let words = [];
      _words.forEach((item) => {
        words.push(item.word);
      })
      var gamePuzzle = wordfindgame.create(words, '#game', '#words');
      var puzzle = wordfind.newPuzzle(words,{height: 25, width:25, fillBlanks: false});
      wordfind.print(puzzle);
    },
  	async getHistoriy(id) {
        const {
            data
        } = await axios.get(`/api/admin/histories/${id}`)
        this.historiy = data
        if (this.historiy.letter_soup) {
          this.loadWords(JSON.parse(this.historiy.letter_soup.words))
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

/**
* Wordfind.js 0.0.1
* (c) 2012 Bill, BunKat LLC.
* Wordfind is freely distributable under the MIT license.
* For all details and documentation:
*     http://github.com/bunkat/wordfind
*/


/**
* Styles for the puzzle
*/
#juego {
  border: 1px solid black;
  padding: 20px;
  float: left;
  margin: 30px 20px;
}

#juego div {
  width: 100%;
  margin: 0 auto;
}

/* style for each square in the puzzle */
#juego .puzzleSquare {
  height: 30px;
  width: 30px;
  text-transform: uppercase;
  background-color: white;
  border: 0;
  font: 1em sans-serif;
}

button::-moz-focus-inner {
  border: 0;
}

/* indicates when a square has been selected */
#juego .selected {
  background-color: orange;
}

/* indicates that the square is part of a word that has been found */
#juego .found {
  background-color: blue;
  color: white;
}

#juego .solved {
  background-color: purple;
  color: white;
}

/* indicates that all words have been found */
#juego .complete {
  background-color: green;
}

/**
* Styles for the word list
*/
#Palabras {
  padding-top: 20px;
  -moz-column-count: 2;
  -moz-column-gap: 20px;
  -webkit-column-count: 2;
  -webkit-column-gap: 20px;
  column-count: 2;
  column-gap: 20px;
  width: 300px;
}

#Palabras ul {
  list-style-type: none;
}

#Palabras li {
  padding: 3px 0;
  font: 1em sans-serif;
}

/* indicates that the word has been found */
#Palabras .wordFound {
  text-decoration: line-through;
  color: gray;
}

/**
* Styles for the button
*/
#solve {
  margin: 0 30px;
}


li.wordFound {
  text-decoration: line-through;
}

div .puzzleSquare {
    height: 30px;
    width: 30px;
    text-transform: uppercase;
    background-color: white;
    border: 0;
    font: 1em sans-serif;
}

#game {
    border: 1px solid black;
    padding: 20px;
    float: left;
    margin: 30px 20px;
}

#game .selected {
    background-color: orange;
}

#game .found {
    background-color: blue;
    color: white;
}

#words li {
      list-style: none;
      margin-left: 15px;
}

</style>
