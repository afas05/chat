<template>
    <div class="message" :class="style">
        <p v-if="message.author === currentUser">
            <b>Me</b>
        </p>
        <p v-else>
            <b>{{message.author}}</b>
        </p>
        <p v-if="message.in">in chat {{message.in}}</p>
        <p>{{message.text}}</p>
        <p class="time">{{message.time}}</p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                style: 'mine'
            }
        },
        name: "message",
        props: {
            message: Object,
            currentUser: String
        },
        created() {
            if (this.message.author !== this.currentUser) {
                this.style = 'notmine';
            }
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
    .time {
        font-size: 0.7rem;
    }
</style>
