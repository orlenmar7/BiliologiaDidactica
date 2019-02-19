import axios from 'axios'

import toastr from 'toastr'
import swal from 'sweetalert2'

toastr.options.closeButton = true
toastr.options.preventDuplicates = true
toastr.options.escapeHtml = true
toastr.options.showMethod = 'slideDown'
toastr.options.hideMethod = 'slideUp'
toastr.options.closeMethod = 'slideUp'
toastr.options.closeDuration = 5000

axios.defaults.baseURL = window.location.origin

/**
 * Response
 */
axios.interceptors.response.use(
  (response) => {
    switch (response.status) {
      case 200:
        if (response.data.interceptor) {
          showMsj('success', response.data)
        }
        break
      case 201:
        if (response.data.interceptor) {
          showMsj('success', response.data)
        }
        break
      case 202:
        if (response.data.interceptor) {
          showMsj('warning', response.data)
        }
        break
      default:
        // console.clear()
    }
    return response
  },
  (error) => {
    const originalRequest = error.config

    // token expired
    if (error.response.status === 401 && error.response.data.error === 'token_expired') {
      originalRequest._retry = true
    }

    if (error.response) {
      switch (error.response.status) {
        case 401:
          // No autorizado
          if (error.response.data.interceptor) {
            showMsj('warning', error.response.data)
          }
          break
        case 403:
          if (error.response.data.interceptor) {
            showMsj('warning', error.response.data)
          }
          break
        case 404:
          console.log(error.response.data)
          break
        case 422:
          // console.clear()
          break
        case 423:
          if (error.response.data.interceptor) {
            showMsj('warning', error.response.data)
          }
          break
        case 500:
          if (error.response.data.interceptor) {
            showMsj('error', error.response.data)
          }
          break
        default:
      }
    }

    return Promise.reject(error)
  }
)

function showMsj (type, data) {
  switch (data.plugin) {
    case 'modal':
      var config = {
        title: `${data.title}`,
        html: `${data.message}`,
        showCancelButton: false,
        confirmButtonColor: '#00D3BC',
        confirmButtonText: (data.home) ? 'Ir al sitio web' : 'Cerrar'
      }
      if (type === 'error') {
        config.type = 'error'
      }
      if (type === 'warning') {
        config.type = 'warning'
      }
      if (type === 'success') {
        config.type = 'success'
      }
        
      swal(config).then(function(){

        if(data.home){
          document.location.href = document.location.origin;
        }
      

      },function(){

      }); 

      
      break
    case 'notification':
      if (type === 'error') {
        toastr.error(data.message, data.title)
      }
      if (type === 'warning') {
        toastr.warning(data.message, data.title)
      }
      if (type === 'success') {
        toastr.success(data.message, data.title)
      }
      break
    default:
      console.log(data.message, data.title)
      break
  }
}

export default axios
