import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";
import Login from "../views/Login.vue";
import Registration from "../views/Registration.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "home",
    component: Home,
    meta: {
        middleware: "auth"
    }
  },
  {
    path: "/login",
    name: "login",
    component: Login,
    meta: {
      middleware: "logged"
    }
  },
  {
    path: "/registration",
    name: "registration",
    component: Registration,
    meta: {
      middleware: "logged"
    }
  }
];

const router = new VueRouter({
  mode: "history",
  routes
});

router.beforeEach((to, from, next) => {
    switch (to.meta.middleware) {
        case "auth":
            if (!localStorage.token) {
                next("/login");
            } else {
                next();
            }
            break;
        case "logged":
            if (localStorage.token) {
                next("/");
            } else {
                next();
            }
            break;
        default:
            next();
            break;
    }

});
export default router;
