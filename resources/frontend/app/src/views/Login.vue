<template>
    <div class="login">
        <div class="container">
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                <b-form-group
                    id="input-group-1"
                    label="Login:"
                    label-for="input-1"
                    label-cols-sm="4"
                    label-cols-lg="3"
                >
                    <b-form-input
                        id="input-1"
                        v-model="form.login"
                        type="text"
                        required
                        placeholder="Enter Login"
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-2"
                    label="Password:"
                    label-for="input-2"
                    label-cols-sm="4"
                    label-cols-lg="3"
                >
                    <b-form-input
                        id="input-2"
                        v-model="form.password"
                        type="password"
                        required
                        placeholder="Enter Password"
                    ></b-form-input>
                </b-form-group>

                <b-button type="submit" variant="primary">Login</b-button>
            </b-form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    login: '',
                    password: ''
                },
                show: true
            }
        },
        name: "Login",
        methods: {
            onSubmit(evt) {
                evt.preventDefault()
                alert(JSON.stringify(this.form))
            },
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.form.email = ''
                this.form.name = ''
                this.form.food = null
                this.form.checked = []
                // Trick to reset/clear native browser form validation state
                this.show = false
                this.$nextTick(() => {
                    this.show = true
                })
            }
        }
    }
</script>
