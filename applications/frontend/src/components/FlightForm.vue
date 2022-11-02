<template>
    <b-form @submit="onSubmit">
        <p class="mb-3">
            Select two airports and get the lowest price available!
        </p>
        <b-form-group
            id="departureAirportCode-group"
            label="Departure airport"
            label-for="departureAirportCode"
            :state="error"
        >
            <b-form-select
                id="departureAirportCode"
                v-model="departureAirportCode"
                :options="airports"
                required
                plain
                oninput="setCustomValidity('')"
                @update="deleteErrors"
            >
            </b-form-select>
        </b-form-group>

        <b-form-group
            id="arrivalAirportCode-group"
            label="Arrival airport"
            label-for="arrivalAirportCode"
            :state="error"
        >
            <b-form-select
                id="arrivalAirportCode"
                v-model="arrivalAirportCode"
                :options="airports"
                plain
                required
                oninput="setCustomValidity('')"
                @update="deleteErrors"
            >
            </b-form-select>
        </b-form-group>

        <b-button variant="primary" id="submit-button" class="mt-2" type="submit" :disabled="!(departureAirportCode && arrivalAirportCode)">Go!</b-button>
    </b-form>
</template>


<script>
import { getAirports, getLowestPrice } from "@/services/APIcalls.js";

export default {
  name: "flight-form",
  data() {
    return {
      airports: [],
      departureAirportCode: "",
      arrivalAirportCode: "",
      errorMessage: "",
      error: null,
    };
  },
  methods: {
    onSubmit(event) {
      event.preventDefault();
      if (this.departureAirportCode && this.arrivalAirportCode) {
        this.$emit('loading', true);
        getLowestPrice(this.departureAirportCode, this.arrivalAirportCode)
        .then((res)=> {
            this.$emit('loading', false);
            this.$emit('dataHasBeenRetrived', res.data);
        })
        .catch((err)=> {
            this.$emit('loading', false);
            this.$emit('errorHasBeenReceived', err.response);
        })
      }
    },
    deleteErrors() {
      this.error = null;
    },
  },
  mounted() {
    this.$emit('loading', true);
    getAirports()
      .then((res) => {
        this.airports = res.data.airports;
      })
      .finally(() => {
        this.$emit('loading', false);
      });
  },
};
</script>

<style scoped>
.form-group {
  padding-bottom: 20px;
}
.btn {
  width: 150px;
}
#submit-button {
  color: aliceblue;
  position: absolute;
  right: 24px;
  bottom: 24px;
}
</style>
