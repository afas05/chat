<template>
    <div class="message" :class="message.style">
        <p v-if="message.style == 'mine'">
            <b>Me</b>
        </p>
        <p v-else>
            <b>{{message.author}}</b>
        </p>
        <p>{{message.text}}</p>
        <p>{{message.time}}</p>
    </div>
</template>

<script>
    export default {
        name: "message",
        props: {
            message: Object
        }
    }
</script>

<style>
    .message {
        border-radius: 10px;
        width: 20rem;
        color: white;
    }
    .mine {
        background-color: #0C9A9A;
        margin-left: 55%;
    }
    .notmine {
        background-color: #5c2699;

    }
</style>
