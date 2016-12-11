<template>
    <div class="ui fluid gender selection dropdown">
        <input type="hidden" name="gender">
        <i class="dropdown icon"></i>
        <div class="default text">Gender</div>
        <div class="menu">
            <dropdown-item v-on:item-added="setActive" v-for="gender in genders" :item="gender" :is_active="gender.id === active_id"></dropdown-item>
        </div>
    </div>
</template>
<style>

</style>
<script>
    export default {
        props: ['genders_json', 'active_id'],
        data() {
            return {
                genders: JSON.parse(this.genders_json),
            }
        },
        components: {
            'dropdown-item': Vue.component('dropdown-item', function (resolve) {require(['./items/DropdownItem.vue'], resolve);}),
        },
        methods: {
            setActive: function () {
                var $dropdown = $('.gender.selection.dropdown');
                var value = $dropdown.find('.active').data('value');

                $dropdown.dropdown('set selected', value);
            }
        },
    }
</script>
