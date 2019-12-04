<template>
  <div id="app">
    <div id="nav">
      <span v-if="!isLogged">
        <router-link to="/login">Login</router-link> |
        <router-link to="/registration">Registration</router-link>
      </span>
      <span v-else><a href="" @click="logout">Logout</a></span>

    </div>
      <transition name="slide-fade">
          <router-view></router-view>
      </transition>
  </div>

</template>

<script>
    import {post} from "./handlers/request";

    export default {
        data() {
            return {
                isLogged: false
            }
        },
        methods: {
            logout(evt) {
                evt.preventDefault();
                post('/api/auth/logout', {});
                localStorage.removeItem('token');
                localStorage.removeItem('tokenExpired');
                this.$router.push('/login');
            }
        },
        watch: {
            $route (){
                this.isLogged = localStorage.token !== undefined;
            }
        },
        created() {
            this.isLogged = localStorage.token !== undefined;
        }
    };
</script>

<style>
#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;


}

#nav a {
  font-weight: bold;
  color: #2c3e50;

}

#nav span {
    position: absolute;
    right: 150px;
}

#nav a.router-link-exact-active {
  color: #42b983;
}

.slide-fade-enter-active {
    transition: all .3s ease;
}
.slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active до версии 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
}
</style>
