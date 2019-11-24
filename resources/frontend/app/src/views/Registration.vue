<template>
    <div class="reg">
        <div class="container">

            <p v-if="success">Congratulations!!!</p>
            <p v-if="error">Dumb!!!</p>

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
            <b-card class="mt-3" header="Form Data Result">
                <pre class="m-0">{{ form }}</pre>
            </b-card>
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
                error: false,
                errors: [],
            }
        },
        name: "Registration",
        methods: {
            onSubmit(evt) {
                evt.preventDefault();
                let data = this.form;

                axios.post(
                    "/api/registration",
                    {
                        email: data.email,
                        name: data.name,
                        password: data.password
                    }
                ).then(response => {
                    console.log(this.success);
                    console.log(this.error);
                    if (response.data.result) {
                        this.success = true;
                    } else {
                        this.error = true;
                    }
                }).catch(error => {
                    console.log(error);
                    this.error = true;
                });
            },
        }
    }
</script>
