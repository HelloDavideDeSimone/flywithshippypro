<template>
  <div style="height: 100%; overflow: hidden" class="landing">
    <div class="text-center py-2 loader" v-show="isLoading">
      <b-spinner></b-spinner>
    </div>

    <div :class="isLoading ? 'blur-content main-container' : 'main-container'">
      <b-card class="card shadow">
        <div style="text-align: center">
          <img src="@/assets/img/logo.png" alt="logo" class="logo mb-5 mt-2" />
        </div>
        <FlightForm @errorHasBeenReceived="showErrorForm" @dataHasBeenRetrived="switchForm" @loading="setIsLoading" v-if="(data === null && error === null)" />
        <ShowResults @deleteData="data = null; error = null;" :data="data" :error="error" v-else />
      </b-card>
    </div>
  </div>
</template>

<script>
import FlightForm from "@/components/FlightForm.vue";
import ShowResults from "@/components/ShowResults.vue";

export default {
  name: "landing-page",
  components: {
    FlightForm,
    ShowResults
  },
  data() {
    return {
      error: null,
      data: null,
      showFlightForm: true,
      isLoading: false,
    };
  },
  methods: {
    switchForm(data) {
      this.data = data;
    },
    showErrorForm(err) {
      this.error = err.data.msg;
    },
    setIsLoading(loading) {
      this.isLoading = loading;
    }
  },
};
</script>

<style scoped>
.card {
  width: 600px;
  height: 492px;
  border-style: none;
  padding: 0 10px;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  margin: auto;
}

.logo {
  width: 120px;
  height: 120px;
}

.blur-content {
  height: 100vh;
}
.loader {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -100%);
  z-index: 1000;
  font-size: 1.3em;
}
</style>
