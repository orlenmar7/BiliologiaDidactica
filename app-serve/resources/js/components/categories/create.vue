<template>
  <div :title="title">
    <form v-if="frm_cargado" @submit.prevent="save" @keydown="form.onKeydown($event)">
      <alert-success :form="form" :message="message"/>

      <!-- Password -->
      <div class="form-group row">
        <label class="col-md-12 col-form-label">Nombre categoria</label>
        <div class="col-md-12">
          <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name" autofocus>
          <has-error :form="form" field="name"/>
        </div>
      </div>

      <!-- Password Confirmation -->
      <div class="form-group row">
        <label class="col-md-12 col-form-label">Descripción</label>
        <div class="col-md-12">
          <textarea v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" class="form-control" name="description" rows="6"></textarea>
          <has-error :form="form" field="description"/>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
            <label>Intervalos de edades para la categoria</label>
            <br><br>
            <vue-slider
              ref="slider"
              v-model="form.config"
              formatter="{value} Años"
              mergeFormatter="{value1} Años - {value2} Años"
              :min="4"
              :max="50"
              :realTime="true"
              :enableCross="false"
              :useKeyboard="true"
              :show="true"
              :disabled="false"
              :dotSize="16"
              :height="8"
              width="100%"
              :bgStyle="ranges.bgStyle"
              :tooltipStyle="ranges.tooltipStyle"
              :processStyle="ranges.processStyle"
              :sliderStyle="ranges.sliderStyle"
              :tooltipDir="ranges.tooltipDir"></vue-slider>


        </div>
      </div>

      <!-- <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <label>Seleccione una imagen</label>
            <el-upload
              action=""
              accept=".jpg, .jpeg, .png, .svg"
              :show-file-list="false"
              :before-upload="uploadImage">
               <img :src="form.image_url" alt="imagen" class="img-responsive" style="width: 70%;" />
            </el-upload>
          </div>
        </div>
      </div> -->

      <!-- Submit Button -->
      <div class="form-group row">
        <div class="col-md-9 ml-md-auto">
          <button :loading="form.busy" type="submit" class="btn btn-primary">{{ title }}</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import vueSlider from 'vue-slider-component'
import imagedefault from './../../../img/default/img.png';

export default {
  scrollToTop: false,
  props: ['props_category'],
  components: {
    vueSlider
  },
  data: () => ({
    title: 'Registrar categoria',
    message: 'Categoria registrada con éxito',
    edit: false,
    frm_cargado:false,
    ranges: {
        tooltipDir: ["top", "top"],
        bgStyle: {
          "backgroundColor": "#c9c9c9",
          "boxShadow": "#c9c9c9"
        },
        tooltipStyle: {
          "backgroundColor": "#b163c1",
          "borderColor": "#b163c1"
        },
        processStyle: {
          "backgroundColor": "#dca8e6"
        },
        sliderStyle: [
          {"backgroundColor": "#b163c1"},
          {"backgroundColor": "#b163c1"}
        ]
    },
  }),

  methods: {
  	main (){
  		if (this.edit) {
  			this.title = 'Editar categoria'
  			this.message = 'Categoria editada con éxito'
  		}
        this.frm_cargado = true
  	},
    async save () {

      if ((this.edit)) {
          await this.form.submit('post', `/admin/categories/update/${this.form.id}`,  {
            transformRequest: [function (data, headers) {

                var interval = [];
                for (var i = Number(data.config[0]); i <= Number(data.config[1]); i++) {
                    interval.push(i)
                }

                var _data = new FormData();
                _data.append('name', data.name);
                _data.append('description', data.description);
                _data.append('image_url', data.image_url);
                _data.append('config', interval.join(','));
                _data.append('image_new', (data.image_new)? data.image_new: '');
                return _data
            }],
          })
      } else {
          await this.form.submit('post', '/admin/categories',  {
            transformRequest: [function (data, headers) {

                var interval = [];
                for (var i = Number(data.config[0]); i <= Number(data.config[1]); i++) {
                    interval.push(i)
                }

                var _data = new FormData();
                _data.append('name', data.name);
                _data.append('description', data.description);
                _data.append('image_url', data.image_url);
                _data.append('config', interval.join(','));
                _data.append('image_new', (data.image_new)? data.image_new: '');

                return _data
            }],
          })
          this.form.reset()
      }

    },
    uploadImage(file) {
        this.uploadLoad = true
        if (file) {
            var reader = new FileReader()
            reader.onload = (e) => {
                if (this.edit) {
                  this.form.image_new = e.target.result;
                  this.form.image_url = e.target.result;
                }else{
                  this.form.image_url = e.target.result;
                }
            }
            reader.readAsDataURL(file)
            reader.onerror = (error) => {
                console.error('Error: ', error)
            }
        }
        return false
    },
  },
  mounted() {
    if (this.props_category) {
        var _category = JSON.parse(this.props_category);
        var aray_config = _category.config.split(',');
        this.form = new Form({
            id: _category.id,
            name: _category.name,
            config: [aray_config[0], aray_config[aray_config.length - 1]],
            description: _category.description,
            image_url: (_category.image_url) ? _category.image_url : imagedefault,
        })
        this.edit = true;
    }else{
        this.form = new Form({
          name: '',
          description: '',
          config: [2, 11],
          image_url: imagedefault,
        })
    }
	this.main();
  }
}
</script>
