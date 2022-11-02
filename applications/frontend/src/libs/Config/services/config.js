import $env from "@/config/env.js";

export default {
  all() {
    return $env;
  },
  get(key) {
    const VUE_APP_CONFIG = this.all();

    if (VUE_APP_CONFIG[key]) {
      return VUE_APP_CONFIG[key];
    }

    return null;
  },
};
