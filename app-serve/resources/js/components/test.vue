<template>
  <div :title="title">
       <div class="intro_title">
            <h2>Test {{ historiy.title }} <i class="icon-paper-plane"></i></h2>
            <span style="background: #1478f8; color: #fff;padding: 5px 13px;border-radius: 10px;"> Categoría: {{ historiy.category.name }} </span>
            <ul v-if="status == 'play'">
                <!-- <li>
                    Pregunta # {{index_q}}
                </li> -->
                <li>
                    <span style="font-size: 18px;" class="label label-success" v-bind:class="{'label-success': (time > 10), 'label-warning': (time <= 10), 'label-danger': (time <= 5)}">Segundos: {{ time }}</span>

                    <!-- <span class="badge badge-pill badge-success">01:02:10</span> --><!-- primary danger dark light warning info success -->
                </li>
            </ul>
        </div>
        <div id="accordion_questions" class="add_bottom_45">
            <div class="box_general padding_bottom">
                <div class="row">

                    <div class="col-md-12">

                  <div v-if="!complet">
                    <div v-if="status == 'stop'" class="col-sm-12 col-sm-height text-center p-t-20 slide-left animated fadeIn">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <button v-on:click.stop.prevent="playQuestion" class="btn btn-primary btn-lg btn-block btn-cons m-t-10">
                                    Iniciar test
                                </button>
                            </div>
                        </div>
                    </div>

                    <form v-if="status == 'play'"  @submit.prevent="save" @keydown="form.onKeydown($event)">


                      <div class="tab-content play panel p-l-0 p-r-0" style="background: transparent;">

                        <div class="tab-pane p-t-30" v-for="(item, index) in historiy.test.questions_obj" :class="{active: item.active}">

                          <h3>{{ item.question }}</h3>

                          <hr>

                          <div class="row">

                            <div class="col-md-6" v-for="(opt, index_op) in item.options">

                              <button
                                type="button"
                                v-on:click.stop.prevent="selectPunto(opt, index, index_op, $event)"
                                class="btn btn-info btn-lg bb"
                                style="width: 100%; margin-bottom: 10px; margin-top: 10px;">
                                  {{ opt.op }}
                              </button>

                            </div>

                          </div>

                        </div>

                      </div>

                    </form>
                  </div>


                  <div v-if="complet">
                      <div class="alert alert-success" v-bind:class="{'alert-success': (poit >= '80'), 'alert-danger': (poit < '80')}" role="alert">
                        <strong>Test {{ historiy.title }} <i class="icon-paper-plane"></i></strong> Completado. {{ num_btn }} / {{ historiy.test.questions_obj.length }} preguntas

                        <span class="text-right">
                            <span>
                               | Puntos: <b>{{poit}}</b>
                            </span>
                        </span>
                      </div>
                        <button v-on:click.stop.prevent="replayQuestion" class="btn btn-primary btn-lg btn-block btn-cons m-t-10">
                            Reiniciar test
                        </button>
                  </div>

                    </div>

                </div>
            </div>
        </div>
  </div>
</template>

<script>

import axios from 'axios'
import swal from 'sweetalert2'
  let time_interval, indexAct = 0;

export default {
props: ['props_history'],
  middleware: ['auth'],
  scrollToTop: false,


  data: () => ({
  	title: 'Test',
    status: 'stop',
    complet: false,
    time: 0,
    history_id: null,
    historiy: {
      category: {
        name: ''
      },
      test: {
        questions_obj: []
      }
    },
    responses_questions: [],
    words: [],
    num_btn: 0,
    poit: 0,
    index_q: 1,
  }),

  methods: {
  	main (){
  		if (this.history_id) {
            this.getHistoriy(this.history_id)
        }
  	},
    playQuestion: function () {
        this.changeStatus('play');
        this.playTime(25);
    },
    replayQuestion(){
        this.complet = false
        this.historiy.test.questions_obj.map((item) => {
                item.active = false;
                item.punto = 0;
            });
            this.historiy.test.questions_obj[0].active = true;
        clearInterval(time_interval);
        this.playQuestion()
    },
    playTime: function (second) {
        let self = this;
        self.time = second;
        time_interval = setInterval(function () {
            console.log('corriento tiempo...');
            self.time = self.time - 1;
            if (self.time <= 0) {
                clearInterval(time_interval);
                if (self.getQuestionActive().length > 0) {
                    self.nextQuestion(indexAct);
                }
            }
        }, 1000);
    },
    getQuestionActive: function () {
        let question = this.historiy.test.questions_obj.filter(function(item) {
            return (item.active == true);
        });
        return question;
    },
    changeStatus: function (status) {
        this.status = status;
    },
    nextQuestion(index){
        indexAct = parseInt(index, 10) + 1;

        if (indexAct <= (this.historiy.test.questions_obj.length - 1)) {
            this.historiy.test.questions_obj.map((item) => {
                if (item._id === this.historiy.test.questions_obj[indexAct]._id) {
                    item.active = true;
                }else{
                    item.active = false;
                };
            });
            clearInterval(time_interval);
            this.playTime(25);
        }else{
            this.complet = true;
        }

    },
    async sentPoint (){
        if (this.status === 'play') {
            this.changeStatus('stop');
            const { data } = await axios.post('/points', {
                point: this.poit,
                test_id: this.historiy.test.id
            })
        }
    },
  	async getHistoriy(id) {
        const {
            data
        } = await axios.get(`/api/admin/histories/${id}`)
        this.historiy = data

        if (this.historiy.test) {
            this.historiy.test.questions_obj.map((item) => {
                item.active = false;
                item.punto = 0;
            });
            this.historiy.test.questions_obj[0].active = true;
        }



    },
    selectPunto: function (opt, index, index_op, enevt) {


        this.index_q = index + 1;
        this.responses_questions[index] = opt.check;
        $('.btn.btn-lg.bb').removeClass('active btn-success').addClass('btn-default');
        $(enevt.target).addClass('active btn-success').removeClass('btn-default');
        this.poit = this.num_btn * 20;

        $('.tab-content').hide(300);
        $('.tab-content').show(200);

        console.log(this.poit)
        this.nextQuestion(index);

        this.num_btn = 0;
        this.poit = 0;

        this.responses_questions.forEach((item) => {
            if (item) {
                this.num_btn = this.num_btn + 1;
                console.log(item)
            }

        })

        this.poit = this.num_btn * 20;
        if (this.complet) {
            console.log(this.poit, this.complet)
            this.sentPoint();
            clearInterval(time_interval);
        }




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

<style type="text/css">

  .question_test {
    border: 1px solid #1478f8;
    padding: 5px 10px;
    margin-bottom: 10px;
    border-radius: 5px;
  }

  .label {
      padding: 3px 9px;
      font-size: 11px;
      text-shadow: none;
      background-color: #e6e6e6;
      font-weight: 600;
      color: #fff;
  }
  .label-success {
      background-color: #2ab27b;
  }

  .label-warning {
      background-color: #f8d053;
      color: #fff;
  }

  .label-important, .label-danger {
      background-color: #f55753;
      color: #fff;
  }

</style>
