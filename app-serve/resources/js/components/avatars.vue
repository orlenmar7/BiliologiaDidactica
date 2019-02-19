<template>
  <el-upload
    action=""
    accept=".jpg, .jpeg, .png, .svg"
    :show-file-list="false"
    :before-upload="upload">

    <img :src="image_url" alt="" class="avatar">
  </el-upload>
</template>

<script>

import axios from 'axios'
import swal from 'sweetalert2'
  let time_interval, indexAct = 0;

export default {
  props: ['props_img'],
  scrollToTop: false,
  data: () => ({
    uploadLoad: false,
    image_url: ''
  }),
  methods: {
    main (){
      console.log('main')
    },
    upload(file) {
        this.uploadLoad = true
        if (file) {
            var reader = new FileReader()
            reader.onload = (e) => {
                this.image_url = e.target.result;
                this.updateAvatar();
            }
            reader.readAsDataURL(file)
            reader.onerror = (error) => {
                console.error('Error: ', error)
            }
        }
        return false
    },
    async updateAvatar (){
      const { data } = await axios.post('/avatar', {image_url: this.image_url})
      if (data) {
        setTimeout(function () {
            window.location.reload();
        }, 500)
      }
    }
  },
  mounted() {
    this.image_url = this.props_img
    console.log(this.image_url)
    this.main();
  }

}
</script>

<style type="text/css">
  img.avatar {
      width: 120px!important;
      height: 120px!important;
      border: 5px solid #fff!important;
      border-radius: 50%!important;
  }
</style>
