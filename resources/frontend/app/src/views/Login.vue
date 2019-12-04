<template>
    <div class="login">
        <div class="container">
            <b-alert show variant="danger" v-if="hasErrors">
                Wrong credentials
            </b-alert>
            <b-form @submit="onSubmit" v-if="show">
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
    import axios from "axios";

    export default {
        data() {
            return {
                form: {
                    login: '',
                    password: ''
                },
                show: true,
                hasErrors: false
            }
        },
        name: "Login",
        methods: {
            onSubmit(evt) {
                evt.preventDefault();
                this.hasErrors = false;

                axios.post(
                    "/api/auth/login",
                    {
                        email: this.form.login,
                        password: this.form.password
                    }
                ).then(response => {
                    let token = response.data.access_token;
                    localStorage.token = token;
                    localStorage.tokenExpired = Date.now() + 3600 * 1000;
                    this.$router.push('/');
                }).catch(() => {
                    this.hasErrors = true;
                });
            },
        }
    }
</script>
