<template>
  <div :title="title">

    <div class="row">

        <input type="file" name="image" accept="image/*" style="font-size: 1.2em; padding: 10px 0;" @change="setImage" />

        <br/>

        <div v-if="imgSrc != ''" style="max-width: 500px; display: inline-block;">
            <vue-cropper
              ref='cropper'
              guides
              :view-mode="cropconfig.viewmode"
              :aspect-ratio="cropconfig.aspectRatio"
              :min-container-width="cropconfig.minContainerWidth"
              :min-container-height="cropconfig.minContainerHeight"
              :min-canvas-hidth="cropconfig.minCanvasWidth"
              :min-canvas-height="cropconfig.minCanvasHeight"
              :min-crop-box-width="cropconfig.minCropBoxWidth"
              :min-crop-box-height="cropconfig.minCropBoxHeight"
              :zoomable="cropconfig.zoomable"
              :zoom-on-touch="cropconfig.zoomOnTouch"
              :zoom-on-wheel="cropconfig.zoomOnWheel"
              :src=imgSrc
              alt="Source Image"
              :cropmove="cropImage">
            </vue-cropper>
        </div>

        <img v-if="cropImg != ''" :src="cropImg" style="width: 20%; height: 20%;" alt="Cropped Image" />

        <hr>

        <button v-if="cropImg != ''" class="btn btn-primary" v-on:click="submit">Guardar</button>

    </div>

    <div class="row">
        <div class="col-md-12">
          <b>Imagenes cargadas:</b> {{ historiy.memores.length }} | <b>Minimo 8 imagenes</b>
        </div>
        <div class="col-md-3" style="margin: 5px 0;" v-for="item in historiy.memores">
            <button
              type="button"
              class="btn btn-danger delete-test"
              title="eliminar imagen"
              v-on:click="removeImg(item)">×</button>

            <img :src="item.image_url" style="width: 100%;">
        </div>
    </div>


  </div>
</template>

<script>

import axios from 'axios'
import swal from 'sweetalert2'
import VueCropper from 'vue-cropperjs'

export default {
    scrollToTop: false,
    props: ['props_history'],
    components: {
        VueCropper,
    },

    data: () => ({
        title: 'Crear memoria',
        history_id: null,
        historiy: {
          memores: [],
        },
        imgSrc: '',
        cropImg: '',
        cropconfig: {
          aspectRatio: 1,
          viewMode: 1,
          minContainerWidth: 200,
          minContainerHeight: 200,
          minCanvasWidth: 200,
          minCanvasHeight: 200,
          minCropBoxWidth: 200,
          minCropBoxHeight: 200,
          zoomable: false,
          zoomOnTouch: false,
          zoomOnWheel: false,
          wheelZoomRatio: false,
        }
    }),

    methods: {
        main() {
            if (this.history_id) {
                this.getHistoriy(this.history_id)
            }
        },
        async getHistoriy(id) {
            const {
                data
            } = await axios.get(`/api/admin/histories/${id}`)
            this.historiy = data
        },
        async submit (){
          if (this.cropImg != '') {
            let _data = {
              image: this.cropImg,
              history_id: this.history_id,
            }
            const {
                data
            } = await axios.post(`/admin/histories/memories/${this.history_id}/store`, _data)
            this.cropImg = '';
            this.imgSrc = '';
            this.historiy = data.history;
          }
        },
        async removeImg (img) {
          console.log(img)
          const {
              data
          } = await axios.delete(`/admin/histories/memories/${img.id}/delete`)
          this.getHistoriy(this.history_id)
        },
        setImage(e) {
            const file = e.target.files[0];
            if (!file.type.includes('image/')) {
                return;
            }
            if (typeof FileReader === 'function') {
                const reader = new FileReader();
                reader.onload = (event) => {
                    this.imgSrc = event.target.result;
                    if (this.$refs.cropper) {
                      this.$refs.cropper.replace(event.target.result);
                    }
                };
                reader.readAsDataURL(file);
            } else {
                alert('Sorry, FileReader API not supported');
            }
        },
        cropImage() {
            this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
        },
        rotate() {
            this.$refs.cropper.rotate(90);
        },
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
