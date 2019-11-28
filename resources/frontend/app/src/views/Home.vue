<template>
  <div class="home">
      <div class="sidebar-container">
          <div class="sidebar-logo">
              {{username}}
          </div>
          <ul class="sidebar-navigation">
              <li class="header">Active Chats</li>
              <li v-for="chat in chats" :key="chat">
                  <a href="#">
                      <i class="fa fa-home" aria-hidden="true"></i> {{chat.name}}
                  </a>
              </li>
          </ul>
      </div>

      <div class="content-container">

          <div class="container">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">{{chats[0].name}}</li>
                  </ol>
              </nav>

              <div class="overflow-auto chat-box">
                  <message :message="message"  v-for="message in messages" v-bind:key="message" ></message>
              </div>
              <textarea class="form-control input-message" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>
      </div>
  </div>
</template>

<script>

import {post} from "../handlers/request";
import message from "../components/message";

export default {
    components: {message},
    data() {
        return {
            username: null,
            chats: {},
            messages: {},
            currentChat: null
        }
    },
  name: "home",
  methods: {
  },
  beforeCreate() {
    post('/api/info', {}).then(
      (response) => {
        this.username = response.data.name;
        this.chats = response.data.chats;
        this.messages = response.data.messages;
      }
    );
  },
  comments: {
    message
  }
};
</script>
<style>
    .sidebar-container {
        position: fixed;
        width: 220px;
        height: 100%;
        left: 0;
        overflow-x: hidden;
        overflow-y: auto;
        background: #1a1a1a;
        color: #fff;
    }

    .content-container {
        padding-top: 20px;
    }

    .sidebar-logo {
        padding: 10px 15px 10px 30px;
        font-size: 20px;
        background-color: #2574A9;
    }

    .sidebar-navigation {
        padding: 0;
        margin: 0;
        list-style-type: none;
        position: relative;
    }

    .sidebar-navigation li {
        background-color: transparent;
        position: relative;
        display: inline-block;
        width: 100%;
        line-height: 20px;
    }

    .sidebar-navigation li a {
        padding: 10px 15px 10px 30px;
        display: block;
        color: #fff;
    }

    .sidebar-navigation li .fa {
        margin-right: 10px;
    }

    .sidebar-navigation li a:active,
    .sidebar-navigation li a:hover,
    .sidebar-navigation li a:focus {
        text-decoration: none;
        outline: none;
    }

    .sidebar-navigation li::before {
        background-color: #2574A9;
        position: absolute;
        content: '';
        height: 100%;
        left: 0;
        top: 0;
        -webkit-transition: width 0.2s ease-in;
        transition: width 0.2s ease-in;
        width: 3px;
        z-index: -1;
    }

    .sidebar-navigation li:hover::before {
        width: 100%;
    }

    .sidebar-navigation .header {
        font-size: 12px;
        text-transform: uppercase;
        background-color: #151515;
        padding: 10px 15px 10px 30px;
    }

    .sidebar-navigation .header::before {
        background-color: transparent;
    }

    .content-container {
        padding-left: 220px;
    }

    .chat-box {
        height: 300px;
    }

    .input-message {
        width: 90%;
    }


</style>
