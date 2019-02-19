<template>
  <div :title="title">
    <form @submit.prevent="save" @keydown="form.onKeydown($event)" accept="config">
      <alert-success :form="form" :message="message"/>

      <div class="row">
        <div class="col-md-12">

            <div class="form-group">
                <div class="col-md-12">
                  <label class="">Estado</label>
                  <select v-model="form.status" :class="{ 'is-invalid': form.errors.has('status') }" class="form-control" type="text" name="status">
                    <option :value="item.value" v-for="item in list_status">
                      {{ item.name }}
                    </option>
                  </select>
                  <has-error :form="form" field="status"/>
                </div>
            </div>

          <div class="form-group">
            <div class="col-md-12">
              <label class="">Titulo</label>
              <input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control" type="text" name="title" autofocus>
              <has-error :form="form" field="title"/>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <label class="">Sub Titulo</label>
              <input v-model="form.sub_title" :class="{ 'is-invalid': form.errors.has('sub_title') }" class="form-control" type="text" name="sub_title">
              <has-error :form="form" field="sub_title"/>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <label class="">Categoria</label>
              <select v-model="form.category_id" :class="{ 'is-invalid': form.errors.has('category_id') }" class="form-control" type="text" name="category_id">
                <option :value="category.id" v-for="category in categories">
                  {{ category.name }}
                </option>
              </select>
              <has-error :form="form" field="category_id"/>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <label class="">Resumen</label>
              <input v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" class="form-control" type="text" name="description">
              <has-error :form="form" field="description"/>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12">
              <label class="">Contenido</label>
              <editor v-model="form.content" id="content" name="content" :init="initeditor"></editor>
              <has-error :form="form" field="content"/>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Seleccione una imagen</label>
                <el-upload
                  action=""
                  accept=".jpg, .jpeg, .png, .svg"
                  :show-file-list="false"
                  :before-upload="upload">
                   <img :src="form.image_url" alt="imagen" class="img-responsive" style="width: 70%;" />
                </el-upload>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Seleccione un video</label>
                <el-upload
                  action=""
                  accept=".mp4"
                  :show-file-list="false"
                  :before-upload="uploadVideo">
                  <video v-if="video_preview" :src="form.video_preview" controls="" style="width: 70%;"></video>
                  <img :src="form.video_url" v-if="!showVideo" alt="imagen" class="img-responsive" style="width: 70%;" />
                </el-upload>
              </div>
            </div>
          </div>


        </div>
      </div>


      <!-- Submit Button -->
      <div class="form-group">
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
import Editor from '@tinymce/tinymce-vue'
import imagedefault from './../../../img/default/img.png';
import videofault from './../../../img/default/vdo.png';

export default {
    scrollToTop: false,
    props: ['props_history'],
    components: {
        'editor': Editor
    },
    data: () => ({
        title: 'Registrar historia biblica',
        message: 'historia biblica registrada con éxito',
        showVideo: false,
        video_preview: false,
        form: new Form({
            id: null,
            title: '',
            sub_title: '',
            category_id: '',
            description: '',
            content: '',
            image_url: imagedefault,
            video_url: videofault,
        }),
        files: [],
        initeditor: {
            selector: 'textarea',
            language: 'es',
            height: 500,
            theme: 'modern',
            plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template code codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount code imagetools contextmenu colorpicker textpattern help',
            toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',

            image_advtab: true,
            templates: [{
                    title: 'Test template 1',
                    content: 'Test 1'
                },
                {
                    title: 'Test template 2',
                    content: 'Test 2'
                }
            ],
            /*content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]*/
        },
        config: { headers: { 'Content-Type': 'multipart/form-data' } },
        categories: [],
        edit: false,
        list_status: [
            { name: 'Publico', value: 'active' },
            { name: 'Oculto', value: 'deactivated' }
        ]
    }),

    methods: {
        main() {
            if (this.edit) {
                this.title = 'Editar historia biblica'
                this.message = 'historia biblica editada con éxito'
            }
            this.getCategories();
        },
        async getCategories() {
            const { data } = await axios.get('/api/admin/categories')
            let categories = data.map(category => ({id: category.id, name: category.name}))
            this.categories = categories
        },
        async save() {
            if ((this.edit)) {
                await this.form.submit('post', `/admin/histories/update/${this.form.id}`,  {
                  transformRequest: [function (data, headers) {
                    var _data = new FormData();
                    _data.append('title', data.title);
                    _data.append('sub_title', data.sub_title);
                    _data.append('status', data.status);
                    _data.append('category_id', data.category_id);
                    _data.append('description', data.description);
                    _data.append('content', data.content);
                    _data.append('image_url', data.image_url);
                    _data.append('video_url[]', data.video_url);
                    _data.append('image_new', (data.image_new)? data.image_new: '');
                    _data.append('video_new[]', (data.video_new)? data.video_new: '');
                    return _data
                  }],
                })
            } else {
                await this.form.submit('post', '/admin/histories',  {
                  transformRequest: [function (data, headers) {
                    var _data = new FormData();
                    _data.append('title', data.title);
                    _data.append('sub_title', data.sub_title);
                    _data.append('status', data.status);
                    _data.append('category_id', data.category_id);
                    _data.append('description', data.description);
                    _data.append('content', data.content);
                    _data.append('image_url', data.image_url);
                    _data.append('video_url[]', data.video_url);
                    _data.append('image_new', data.image_new);
                    _data.append('video_new[]', data.video_new);
                    console.log(data)
                    return _data
                  }],
                })
                this.form.reset()
            }

        },
        upload(file) {
            this.uploadLoad = true
            if (file) {
                var reader = new FileReader()
                reader.onload = (e) => {
                    if (this.edit) {
                      this.form.image_url = e.target.result;
                      this.form.image_new = e.target.result;
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
        uploadVideo (file) {
          this.uploadLoad = true
          if (file) {

            var reader = new FileReader()
                reader.onload = (e) => {
                    if (this.edit) {
                      this.form.video_url = file;
                      this.form.video_new = file;
                      this.form.video_preview = e.target.result;
                    }else{
                       this.form.video_preview = e.target.result;
                    }
                    this.showVideo = true;
                    this.video_preview = true;
                }
                reader.readAsDataURL(file)
                reader.onerror = (error) => {
                    console.error('Error: ', error)
                }


          }
          return false
        }
    },
    mounted() {
        if (this.props_history) {
          var _history = JSON.parse(this.props_history);
          console.log(_history);
          this.form = new Form({
              id: _history.id,
              title: _history.title,
              status: _history.status,
              sub_title: _history.sub_title,
              category_id: _history.category_id,
              description: _history.description,
              content: _history.content,
              image_url: (_history.image_url.length) ? _history.image_url : imagedefault,
              video_url: (_history.video_url.length) ? _history.video_url : videofault,
              video_preview: (_history.video_url.length) ? _history.video_url : videofault,
          })
          if (_history.video_url.length) {
            this.showVideo = true;
            this.video_preview = true;
          }
          this.edit = true;
        }
        this.main();
    }
}

</script>
