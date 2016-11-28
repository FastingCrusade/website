<template>
    <div class="ui cards">
        <fast-card v-for="card in cards" :card="card"></fast-card>
    </div>
</template>
<style>
</style>
<script>
    export default {
        props: ['cards_json'],
        data() {
            return {
                cards: JSON.parse(this.cards_json),
            }
        },
        components: {
            'fast-card': Vue.component('fast-card', function (resolve) {require(['./fragments/FastCard.vue'], resolve);}),
        }
    }
</script>
