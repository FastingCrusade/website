<template>
    <div class="ui grid">
        <admin-tools v-on:begin-editing="beginEditing" :is_admin="admin"></admin-tools>
        <div class="row">
            <div class="column">
                <h1 class="ui header">Account Settings</h1>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <h2 class="ui header">Personal Information</h2>
            </div>
        </div>
        <div class="row">
            <div class="column">Name:</div>
            <div class="three wide column">
                <div v-if="editing" class="ui fluid input">
                    <input type="text" name="first_name" v-model.trim="user.first_name">
                </div>
                <div v-else>
                    {{ user.first_name }}
                </div>
            </div>
            <div class="three wide column">
                <div v-if="editing" class="ui fluid input">
                    <input type="text" name="last_name" v-model.trim="user.last_name">
                </div>
                <div v-else>
                    {{ user.last_name }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                Gender:
            </div>
            <div class="three wide column">
                <gender-dropdown v-if="editing" :genders_json="genders_json" :active_id="user.gender.id"></gender-dropdown>
                <div v-else>
                    <i :class="user.gender.icon"></i>{{ user.gender.name }}
                </div>
            </div>
        </div>
        <div v-if="editing" class="row">
            <button class="ui green button" @click="updatePersonal">Update</button>
        </div>
        <div v-if="admin">
            <div class="row">
                <div class="column">
                    <h2 class="ui header">Administrators Only</h2>
                </div>
            </div>
            <div class="row">
                <div v-if="editing" class="column">
                    <div class="ui toggle admin checkbox">
                        <input type="checkbox" v-model="admin_toggle" name="is_admin">
                        <label>Is Administrator.</label>
                    </div>
                    <div class="ui warning icon message">
                        <i class="warning sign icon"></i>
                        <div class="content">
                            <div class="header">
                                Are you absolutely sure?
                            </div>
                            <p>
                                Making a user an administrator will give them <strong>full</strong> privileges for the
                                <strong>entire</strong> site. They will be able do anything you can do.
                            </p>
                        </div>
                    </div>
                </div>
                <div v-else class="column">
                    <div class="ui disabled toggle admin checkbox">
                        <input type="checkbox" v-model="admin_toggle" name="is_admin">
                        <label>Is Administrator.</label>
                    </div>
                </div>
            </div>
            <div v-if="editing" class="row">
                <button class="ui yellow button" @click="updateAdmin">Update</button>
            </div>
        </div>
    </div>
</template>
<style>
    .ui.warning.message {
        margin-bottom: 1rem;
    }
</style>
<script>
    export default {
        props: ['user_json', 'editable', 'admin', 'genders_json'],
        data: function () {
            return {
                user: JSON.parse(this.user_json),
                admin_toggle: this.admin,
                is_editing: false,
            };
        },
        computed: {
            editing: function () {
                if (this.is_editing || this.editable) {
                    return true;
                } else {
                    return false;
                }
            },
        },
        methods: {
            beginEditing: function () {
                console.log('Caught event to begin editing');
                this.is_editing = true;
            },
            updatePersonal: function () {
                // TODO React to response
                $.ajax({
                    url: '/user/' + this.user.id,
                    method: 'PATCH',
                    data: {
                        first_name: this.user.first_name,
                        last_name: this.user.last_name,
                        gender: $('.gender.dropdown').find('input').val(),
                        '_token': $('meta[name="csrf_token"]').attr('content'),
                    },
                });
            },
            updateAdmin: function () {
                // TODO React to response.
                $.ajax({
                    url: '/user/' + this.user.id,
                    method: 'PATCH',
                    data: {
                        admin_toggle: $('.admin.toggle.checkbox').checkbox('is checked'),
                        '_token': $('meta[name="csrf_token"]').attr('content'),
                    }
                });
            },
        },
        components: {
            'gender-dropdown': Vue.component('gender-dropdown', function (resolve) {require(['./collections/dropdowns/GenderDropdown.vue'], resolve);}),
        }
    };

    $(function () {
        $('.ui.checkbox').checkbox();
        var $gender_dropdown = $('.gender.dropdown');
        var attempts = 0;

        var interval = setInterval(function () {
            if (!$gender_dropdown.find('.item').length < 1 && attempts < 19) {
                var selected_gender = $gender_dropdown.find('.item.active').data('value');
                console.log('Selected gender:', selected_gender);
                $gender_dropdown.dropdown('set selected', selected_gender);
                clearInterval(interval);
            } else {
                attempts = attempts + 1;
            }
        }, 500);
    });
</script>
<style>
</style>
