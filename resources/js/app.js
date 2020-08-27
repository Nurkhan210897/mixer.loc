require("./bootstrap");
window.Vue = require("vue");

import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
import "@mdi/font/css/materialdesignicons.css";
import VueRouter from "vue-router";

Vue.use(Vuetify);
Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  routes: [
    {
      path: "/admin/categories",
      component: require("./components/admin/CategoryComponent.vue").default,
    },
    {
      path: "/admin/subCategories",
      component: require("./components/admin/SubCategoryComponent.vue").default,
    },
    {
      path: "/admin/products",
      component: require("./components/admin/ProductComponent.vue").default,
    },
    {
      path: "/admin/directory/:tableRussName/:directoryTypeId",
      component: require("./components/admin/DirectoryComponent.vue").default,
      props: true,
    },
    {
      path: "/admin/:table/:tableRussName",
      component: require("./components/admin/SimpleComponent.vue").default,
      props: true,
    },
  ],
});

Vue.component(
  "layout-component",
  require("./components/admin/LayoutComponent.vue").default
);

const app = new Vue({
  el: "#adminPanel",
  vuetify: new Vuetify(),
  router,
});
