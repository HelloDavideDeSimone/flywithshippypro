export default {
  apiBaseUrl: `${process.env.VUE_APP_API_BASE_URL || "/api/v1"}`,
  env: `${process.env.NODE_ENV} || 'dev'`,
};
