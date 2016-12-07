<template>
    <div>
        <div class="ui top attached tabular admin menu">
            <a class="item active" data-tab="users">Users</a>
            <a class="item" data-tab="fasts">Fasts</a>
        </div>
        <div class="ui bottom attached tab segment active" data-tab="users">
            <div class="ui vertically divided grid">
                <div class="row">
                    <div class="column">
                        <h1 class="ui header">Genders</h1>
                        <div class="ui equal width grid">
                            <div class="two column row">
                                <gender-display v-for="gender in genders" :gender="gender"></gender-display>
                            </div>
                            <div class="one column row">
                                <div class="column">
                                    <div class="ui form">
                                        <div class="inline fields">
                                            <label>Add a gender:</label>
                                            <div class="field">
                                                <input type="text" name="name" placeholder="Enter a name...">
                                            </div>
                                            <div class="field">
                                                <input type="text" name="icon" placeholder="Icon class...">
                                            </div>
                                            <div class="field">
                                                <i class="help circle icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui bottom attached tab segment" data-tab="fasts">
            <div class="ui vertically divided grid">
                <div class="row">
                    <div class="column">
                        <h1 class="ui header">Categories</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
</style>
<script>
    export default{
        props: ['genders_json'],
        data(){
            return{
                genders: JSON.parse(this.genders_json),
            }
        },
        components:{
            'gender-display': Vue.component('gender-display', function (resolve) {require(['./GenderDisplay.vue'], resolve);}),
        }
    }

    $(function () {
        $('.tabular.admin.menu .item').tab();
    });
</script>
