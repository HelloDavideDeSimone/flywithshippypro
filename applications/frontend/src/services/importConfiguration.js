import configuration from "./configuration.json";

export const importConfiguration = () =>
  new Promise((resolve) => {
    resolve(configuration);
  });

export default { importConfiguration };
