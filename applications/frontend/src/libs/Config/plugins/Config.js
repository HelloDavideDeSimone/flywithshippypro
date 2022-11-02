import $config from "../services/config.js";

export default {
  install(Vue) {
    Vue.appConfig = $config.all();

    Object.defineProperties(Vue.prototype, {
      $appConfig: {
        get: () => Vue.appConfig,
      },
    });
  },
  _getService: () => $config,
};
