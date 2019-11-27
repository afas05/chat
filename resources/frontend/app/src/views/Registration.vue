<template>
    <div class="reg">
        <div class="container">


            <b-alert show variant="danger" v-if="hasErrors">
                <ul>
                    <li  v-for="error in errors" v-bind:key="error">{{error}}</li>
                </ul>
            </b-alert>
            <b-alert show variant="success" v-if="success">Congratulations!!!</b-alert>

            <b-form @submit="onSubmit" v-if="show">
                <b-form-group
                    id="input-group-1"
                    label="Email address:"
                    label-for="input-1"
                    description="We'll never share your email with anyone else."
                    label-cols-sm="4"
                    label-cols-lg="3"
                >
                    <b-form-input
                        id="input-1"
                        v-model="form.email"
                        type="email"
                        required
                        placeholder="Enter email"
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-2"
                    label="Your Name:"
                    label-for="input-2"
                    label-cols-sm="4"
                    label-cols-lg="3"
                    description="We'll share your name with everyone."
                >
                    <b-form-input
                        id="input-2"
                        v-model="form.name"
                        required
                        placeholder="Enter name"
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-3"
                    label="Password:"
                    label-for="input-3"
                    label-cols-sm="4"
                    label-cols-lg="3"
                    description="We'll know your password if we want."
                >
                    <b-form-input
                        id="input-3"
                        type="password"
                        v-model="form.password"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-button type="submit" variant="primary">Register</b-button>
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
                    email: '',
                    name: '',
                    password: ''
                },
                show: true,
                success: false,
                errors: [],
                hasErrors: false
            }
        },
        name: "Registration",
        methods: {
            onSubmit(evt) {
                evt.preventDefault();
                this.hasErrors = false;
                this.success = false;
                let data = this.form;

                axios.post(
                    "/api/registration",
                    {
                        email: data.email,
                        name: data.name,
                        password: data.password
                    }
                ).then(response => {

                    if (response.data.result) {
                        this.success = true;
                    } else {
                        this.hasErrors = true;
                        this.errors = response.data.errors;
                    }
                }).catch(error => {
                    console.log(error);
                    this.error = true;
                });
            },
        }
    }
</script>
