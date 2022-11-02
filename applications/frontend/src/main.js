import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import { BootstrapVue, IconsPlugin } from "bootstrap-vue";
import ConfigVue from "./libs/Config/plugins/Config";
import { Icon } from "leaflet";
import "leaflet/dist/leaflet.css";

// this part resolve an issue where the markers would not appear
delete Icon.Default.prototype._getIconUrl;

Icon.Default.mergeOptions({
  iconRetinaUrl: require("leaflet/dist/images/marker-icon-2x.png"),
  iconUrl: require("leaflet/dist/images/marker-icon.png"),
  shadowUrl: require("leaflet/dist/images/marker-shadow.png"),
});

Vue.config.productionTip = false;

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.use(ConfigVue);

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");

(() =>
  import(
    /* webpackChunkName: "css-bootstrap" */ "./assets/scss/bootstrap.scss"
  ))();
import "./assets/scss/style.scss";
(() =>
  import(
    /* webpackChunkName: "css-font-face" */ "./assets/scss/font-face.scss"
  ))();
