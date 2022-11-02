<template>
    <div>
        <div class="flights-results text-right" v-if="data">

            <div class="w-100 text-center title">
                <span>
                    {{data.showing.from.text}} 
                </span>
                <span>
                    <b-icon
                    icon="arrow-right"
                    aria-hidden="true"
                    class="mx-1"
                    scale="1.3"
                    ></b-icon>
                </span>
                <span>
                    {{data.showing.to.text}} 
                </span>
            </div>

            <table  class="w-100">
                <tr v-for="(flight, i) in data.flights" :key="i" class="airport-row">
                    <td v-if="data.flights.length > 1" style="width: 84px !important;">Flight no. {{i+1}}</td>
                    <td class="text-center">
                        <span style="font-weight: bold;">
                            ({{flight.departureAirport.value}})
                        </span>
                        <br/>
                        {{flight.departureAirport.text}} 
                    </td>
                    <td>
                        <b-icon
                        icon="arrow-right"
                        aria-hidden="true"
                        class="mx-1"
                        scale="1.3"
                        ></b-icon>
                    </td>
                    <td class="text-center">
                        <span style="font-weight: bold;">
                            ({{flight.arrivalAirport.value}})
                        </span>
                        <br/>
                        {{flight.arrivalAirport.text}} 
                    </td>
                    <td style="width: 70px !important;">{{flight.price}} €</td>
                </tr>
            </table>
            <div style="text-align: right;" class="mt-3">
                Total: {{data.totalPrice}} €
            </div>

        </div>
        <div class="flights-error" v-if="error">
            <h3 ><b-icon
                icon="exclamation-triangle"
                aria-hidden="true"
                class="mx-1"
                scale="0.8"
                ></b-icon>
                Error!
            </h3>
            <h5 class="danger-text">{{error}}</h5>
        </div>

        <b-button
            variant="primary"
            id="redo-button" type="button" @click="$emit('deleteData', true)">{{!error ? 'New search' :'Go back'}}</b-button>
    </div>
</template>


<script>
export default {
  name: "flight-form",
  props: {
    data: Object,
    error: String
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
#redo-button {
  color: aliceblue;
  position: absolute;
  right: 24px;
  bottom: 24px;
}

.flights-results{
}

.flight-name {
}

.airport-row {
    height: 20px;
}
tr {
    border:1px solid rgb(230, 230, 230);

}
td {
    text-align: right;
}
.title {
    font-size: 17px;
    padding-bottom: 5px;
}
</style>
