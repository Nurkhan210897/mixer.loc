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
      path: "/admin/filter/styles",
      component: require("./components/admin/filter/StyleComponent.vue")
        .default,
    },
    {
      path: "/admin/filter/colors",
      component: require("./components/admin/filter/ColorComponent.vue")
        .default,
    },
    {
      path: "/admin/filter/mixer-shapes",
      component: require("./components/admin/filter/MixerShapeComponent.vue")
        .default,
    },
    {
      path: "/admin/filter/controls",
      component: require("./components/admin/filter/ControlComponent.vue")
        .default,
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
