<template>
  <div class="home">
      <div class="sidebar-container">
          <div class="sidebar-logo">
              {{username}}
          </div>
          <ul class="sidebar-navigation">
              <li class="header">Active Chats</li>
              <li><b-input v-model="searchText" placeholder="search" @keyup.enter="searchMessage"></b-input></li>
              <li v-for="chat in chats" :key="chat">
                  <a href="#" v-on:click="getChatData(chat.id)">
                      <i class="fa fa-home" aria-hidden="true"></i>
                      <span v-if="currentChat === chat.id"><b>{{chat.name}}</b></span>
                      <span v-else>{{chat.name}}</span>
                  </a>
              </li>
          </ul>
      </div>

      <div class="content-container">

          <div class="container">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">{{chats[currentChat].name}}</li>
                  </ol>
              </nav>

              <div class="overflow-auto chat-box" ref="chatBox">
                  <message :message="message" :current-user="username"  v-for="message in messages" v-bind:key="message" ></message>
              </div>
              <textarea v-model="message" class="form-control input-message" id="message-box" rows="3" @keyup.enter="sendMessage"></textarea>
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
            chat: {},
            messages: {},
            currentChat: null,
            message: null,
            searchText: null
        }
    },
  name: "home",
  methods: {
    sendMessage(evt) {
      evt.preventDefault();
      let text = this.message;
      this.message = null;

      let data = {
          chatId: this.currentChat,
          message: text
      };



      post('/api/send', data);
    },
    getChatData(id) {
      if (this.currentChat === id) {
        return;
      }

      this.$delete(this.chats, 'search');

      post('/api/chatData', {id: id}).then(
        (response) => {
          this.messages = response.data.messages;
          this.currentChat = response.data.id;
        }
      );
    },
    searchMessage(evt) {
      evt.preventDefault();

      let search = this.searchText;
      this.searchText = null;

      post('/api/search', {searchFor: search}).then((response) => {
        this.$set(this.chats, 'search', {name: 'Search Results', id: 'search'});
        this.currentChat = 'search';
        this.messages = response.data;
      });
    }
  },
  mounted() {
  },
  beforeCreate() {
    post('/api/info', {}).then(
      (response) => {
        this.username = response.data.name;
        this.chats = response.data.chats;
        this.messages = response.data.messages;
        this.currentChat = response.data.chats[Object.keys(response.data.chats)[0]].id;

        for(const chat in this.chats) {
          this.$echo.private('chatId-' + this.chats[chat].id).listen('SendMessage', (payload) => {
            this.messages.push(payload);
          });
        }
      }
    );
  },
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
