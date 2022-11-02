module.exports = {
  css: {
    loaderOptions: {
      sass: {
        prependData: '@import "@/assets/scss/_lib.scss";',
      },
    },
  },
  devServer: {
    public:
      (process.env.VUE_APP_HOST || process.env.VUE_APP_IP || "localhost") +
      ":" +
      (process.env.VUE_APP_PORT || "3000"),
    host: "0.0.0.0",
    port: parseInt(process.env.VUE_APP_PORT || 3000),
    disableHostCheck: true,
  },
  configureWebpack: {
    plugins: [],
    optimization: {},
  },
};
