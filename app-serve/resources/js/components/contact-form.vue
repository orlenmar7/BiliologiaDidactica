<template>
    <form id="contactform" @submit.prevent="contact" @keydown="form.onKeydown($event)" autocomplete="off">
        <div class="row">
            <div class="col-md-6">
                <span class="input" :class="{ 'is-invalid': form.errors.has('name') }">
                    <input class="input_field" type="text" id="name" name="name" v-model="form.name">
                    <label class="input_label">
                        <span class="input__label-content">Nombre</span>
                    </label>
                    <has-error :form="form" field="name"/>
                </span>
            </div>
            <div class="col-md-6">
                <span class="input" :class="{ 'is-invalid': form.errors.has('email') }">
                    <input class="input_field" type="email" id="email" name="email" v-model="form.email">
                    <label class="input_label">
                        <span class="input__label-content">Email</span>
                    </label>
                    <has-error :form="form" field="email"/>
                </span>
            </div>
        </div>
        <!-- /row -->
        <div class="row">
            <div class="col-md-12">
                <span class="input" :class="{ 'is-invalid': form.errors.has('subject') }">
                    <input class="input_field" type="text" id="subject" name="subject" v-model="form.subject">
                    <label class="input_label">
                        <span class="input__label-content">Asunto</span>
                    </label>
                    <has-error :form="form" field="subject"/>
                </span>
            </div>
        </div>

        <span class="input" :class="{ 'is-invalid': form.errors.has('message') }">
            <textarea class="input_field" id="message" name="message" style="height:150px;" v-model="form.message"></textarea>
            <label class="input_label">
                <span class="input__label-content">Mensaje</span>
            </label>
            <has-error :form="form" field="message"/>
        </span>

        <p class="add_top_30">
            <button id="submit" name="submit" class="btn_1 rounded" :loading="form.busy">
                Enviar
            </button>
        </p>
    </form>
</template>

<script>
    import Form from 'vform'
    import swal from 'sweetalert2'
    export default {
        layout: 'basic',

        metaInfo() {
            return {
                title: this.$t('home')
            }
        },

        data: () => ({
            form: new Form({
                name: '',
                email: '',
                subject: '',
                message: '',
            }),
        }),

        methods: {
            main() {

            },
            async contact() {
                // Submit the form.
                const {
                    data
                } = await this.form.post('/contact')

                this.form.reset();

            },
            limitTo(text, num) {
                return text.split('', num).join("").concat((text.length > num) ? '...' : '');
            }
        },

        mounted() {
            this.main();
        }
    }
</script>

<style scoped>

    .is-invalid .invalid-feedback {
        display: initial;
    }

    .is-invalid .input_field:hover, .is-invalid .input_field:focus {
        /* background-color: #e3342f!important; */
    }

</style>
