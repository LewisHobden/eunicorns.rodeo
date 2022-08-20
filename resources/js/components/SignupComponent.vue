<template>
    <div>
        <div v-if="isLoading" class="spinner-grow" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div v-if="!isLoading">
            <button v-if="!isRegistered" v-on:click="onClicked" class="btn btn-outline-primary">Sign me up</button>
            <button v-if="isRegistered" v-on:click="onClicked" class="btn btn-outline-success">Signed up ✔</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "SignupComponent",
    props: {
        'occurrence': Object,
        'registered': Boolean
    },
    data: function () {
        return {
            isLoading: false,
            isRegistered: this.registered
        }
    },
    methods: {
        onClicked: async function () {
            this.isLoading = true;
            let response = await axios.post('/events/occurrences/' + this.occurrence.id + '/register');

            this.isLoading = false;
            this.isRegistered = response.data['is_signed_up'];
        },
    }
}
</script>

<style scoped>

</style>
