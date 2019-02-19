<template>
  <div style="padding: 5px;">

	<div class="row">

    <div class="col-md-12">
      <button class="btn btn-primary btn-sm pull-right" type="button" v-on:click="addTest">Agregar Pregunta</button>
    </div>

    <div class="col-md-12">

        <form @submit.prevent="save" @keydown="form.onKeydown($event)">

          <div v-for="(item, index) in form.tests" class="row">

                <button
                    type="button"
                    class="btn btn-danger delete-test"
                    v-if="form.tests.length > 5"
                    :title="'eliminar pregunta ' + (index + 1) "
                    v-on:click="removeTest(item)">×</button>


              <div class="col-md-12"  style="margin-top: 20px;">
                <div class="form-group">
                  <label class="">Pregunta {{ index + 1 }}</label>
                  <input v-model="item.question" :class="{ 'is-invalid': form.errors.has('tests.'+index+'.question') }" class="form-control" type="text" name="question">
                  <has-error :form="form" :field="'tests.'+index+'.question'"/>
                </div>
              </div>

              <div v-for="(opt, indexOp) in item.options" class="col-md-6">

                  <label class="">Opción #{{ indexOp + 1 }}</label>
                <div class="input-group mb-3" >
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <input type="radio" :name="'opt-'+index" v-model="opt.check" :value="check_value" aria-label="Checkbox for following text input">
                    </div>
                  </div>
                  <input v-model="opt.op" :class="{ 'is-invalid': form.errors.has('tests.'+index+'.options.'+indexOp+'.op') }" class="form-control" type="text" name="opt.op">
                  <has-error :form="form" :field="'tests.'+index+'.options.'+indexOp+'.op'"/>
                </div>


              </div>

              <div class="col-md-12">
                <hr>
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

import axios from 'axios'
import swal from 'sweetalert2'
import Form from 'vform'

export default {
  scrollToTop: false,
  props: ['props_history'],
  data: () => ({
  	title: 'Crear test',
  	historiy: {},
    is_update: false,
    check_value: true,
    form: new Form({
        tests: []
    }),
    edit: false,
    history_id: null,
  }),

  methods: {
  	main (){
        if (this.history_id) {
  		    this.getHistoriy(this.history_id)
        }
  	},
  	async getHistoriy(id) {
        const {
            data
        } = await axios.get(`/api/admin/histories/${id}`)
            this.historiy = data
        if (this.historiy.test == null) {
            this.addTest();
            this.addTest();
            this.addTest();
            this.addTest();
            this.addTest();
            this.is_update = false;
        }else{
            this.title = 'Editar test'
            this.is_update = true;
            this.form.tests = this.historiy.test.questions_obj;
        }

    },
    async save (){

        let _data = {
          history_id: this.history_id,
          tests: this.form.tests,
          update: (this.is_update)? 'update' :  '',
        }

        this.form.history_id = this.history_id;
        this.form.update = (this.is_update)? 'update' :  '';

        const {
            data
        } = await this.form.post(`/admin/histories/tests/${this.history_id}/store`, _data)

        this.getHistoriy(this.history_id)

    },
    addTest (){
      console.log('addTest')
      this.form.tests.push({
        id: '',
        _id: Date.now() + this.makeid(),
        question: '',
        options: [
          {
            op: '',
            check: false,
            _id: Date.now(),
          },
          {
            op: '',
            check: false,
            _id: Date.now(),
          },
          {
            op: '',
            check: false,
            _id: Date.now(),
          },
          {
            op: '',
            check: false,
            _id: Date.now(),
          }
        ]
      });
    },
    makeid() {
          var text = "";
          var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

          for (var i = 0; i < 5; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

          return text;
    },
    removeTest (test) {
      swal({
          title: 'Confirmación!',
          text: '¿Seguro quiere eliminar la pregunta?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, ¿Seguro!',
          cancelButtonText: 'No, cancelar'
      }).then((result) => {
          if (result.value) {
              this.form.tests = this.form.tests.filter(item => item._id !== test._id);
          }
      })
    }
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
