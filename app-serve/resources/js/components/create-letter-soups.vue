<template>
  <div :title="title">

	<div class="row">
        <div class="col-md-12 text-right">
            <button class="btn btn-primary btn-sm" type="button" v-on:click="addWord">Agregar palabra</button>
        </div>
        <div class="col-md-12">
          <form @submit.prevent="save" @keydown="form.onKeydown($event)">
            <div class="row">
              <div class="col-md-12">


                <div class="form-group" v-for="(item, index) in form.words">
                  <div class="col-md-12">

                    <button type="button"
                      v-if="form.words.length > 1"
                      class="close"
                      :title="'eliminar palabra ' + (index + 1) "
                      v-on:click="removeWord(item)"
                      aria-label="Close">x</button>

                    <label class="">Palabra #{{ index + 1 }}</label>
                    <input v-model="item.word" :class="{ 'is-invalid': form.errors.has('words.'+index+'.word') }" class="form-control" type="text" name="word">
                    <has-error :form="form" field="words.0.word"/>
                  </div>
                </div>

              </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
              <div class="col-md-9 ml-md-auto">
                <button :loading="form.busy" class="btn btn-primary" type="success">{{ title }}</button>
              </div>
            </div>

          </form>

        </div>
    </div>

  </div>
</template>

<script>

import Form from 'vform'
import axios from 'axios'
import swal from 'sweetalert2'

export default {

  scrollToTop: false,
  props: ['props_history'],

  data: () => ({
    history_id: null,
  	title: 'Crear sopa de letras',
  	historiy: {},
    edit: false,
    form: new Form({
        words: [
          {word: '', id: Date.now()}
        ],
    }),
  }),

  methods: {
  	main() {
        if (this.history_id) {
            this.getHistoriy(this.history_id)
        }
    },
    loadWords (words) {
      this.form.words = words;
      this.edit = true;
      this.title = 'Actualizar sopa de letras';
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
    async save() {
      this.form.history_id = this.history_id;
      if (this.edit) {
        await this.form.put(`/admin/histories/letter_soups/${this.historiy.letter_soup.id}/update`)
      }else{
        await this.form.post(`/admin/histories/letter_soups/${this.historiy.id}/store`)
      }
      this.getHistoriy(this.history_id)
    },
    addWord () {
      this.form.words.push({word: '', id: Date.now()})
    },
    removeWord (word) {
      swal({
          title: 'Confirmación!',
          text: '¿Seguro quiere eliminar la palabra?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, ¿Seguro!',
          cancelButtonText: 'No, cancelar'
      }).then((result) => {
          if (result.value) {
              this.form.words = this.form.words.filter(item => item.id !== word.id);
          }
      })
    }
  },

  mounted() {
	if (this.props_history) {
        console.log(this.props_history)
        var _history = JSON.parse(this.props_history);
        this.history_id = _history.id
    }
    this.main();
  }

}
</script>
