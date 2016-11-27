<template>
    <div class="ui grid">
        <div v-if="admin" class="admin tools row">
            <div class="column">Edit</div>
        </div>
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
                    <input type="text" name="first_name" :value="user.first_name">
                </div>
                <div v-else>
                    {{ user.first_name }}
                </div>
            </div>
            <div class="three wide column">
                <div v-if="editing" class="ui fluid input">
                    <input type="text" name="last_name" :value="user.last_name">
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
                <div v-if="editing" class="ui fluid selection dropdown">
                    <input type="hidden" name="gender">
                    <i class="dropdown icon"></i>
                    <div class="default text">Gender</div>
                    <div class="menu">
                        <dropdown-item v-for="gender in genders" :item="gender"></dropdown-item>
                    </div>
                </div>
                <div v-else>
                    <i :class="genderIcon"></i>{{ genderName }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <h2 class="ui header">Administrators Only</h2>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div class="ui toggle checkbox">
                    <input type="checkbox" name="is_admin">
                    <label>Make administrator.</label>
                </div>
                <div class="ui warning icon message">
                    <i class="warning sign icon"></i>
                    <div class="content">
                        <div class="header">
                            Are you absolutely sre?
                        </div>
                        <p>
                            Making a user an administrator will give them <strong>full</strong> privileges for the
                            <strong>entire</strong> site. They will be able do anything you can do.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: ['user_json', 'editable', 'admin', 'genders_json'],
        data: function () {
            return {
                user: JSON.parse(this.user_json),
                genders: JSON.parse(this.genders_json),
            };
        },
        computed: {
            editing: function () {
                if (this.isEditing || this.editable) {
                    return true;
                } else {
                    return false;
                }
            }
        },
        components: {
            'dropdown-item': Vue.component('dropdown-item', function (resolve) {require(['./DropdownItem.vue'], resolve);}),
        }
    };

    $(function () {
        $('.ui.dropdown').dropdown();
    });
</script>
<style>
    .admin.tools.row {
        padding: 0 0 1rem;
    }
    .admin.tools.row>.column {
        text-align: right;
        align-self: inherit;
    }
</style>
