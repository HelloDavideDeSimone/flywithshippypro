import environmentVars from "@/config/env.js";

export default {
  get(val) {
    if (environmentVars[val]) {
      return environmentVars[val];
    }
    console.log(`${val} does not exist`);
    return null;
  },
};
