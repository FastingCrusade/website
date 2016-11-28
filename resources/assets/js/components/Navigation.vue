<template>
    <div class="ui container">
        <div class="ui large secondary pointing navigation menu">
            <a class="toc item">
                <i class="sidebar icon"></i>
            </a>
            <a class="active item">Home</a>
            <a v-if="!user.full_name" class="right item">
                <a class="ui navigation button" @click="showLogin()">Log In</a>
                <a class="ui navigation button" @click="showSignUp()">Sign Up</a>
            </a>
            <div v-else class="ui right dropdown item">
                <i :class="userIcon"></i>
                {{ user }}
                <div class="menu">
                    <a :href="settingsUrl" class="item">Account Management</a>
                    <a href="/logout" class="item">Log Out<span class="description"><i class="sign out icon"></i></span></a>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
    .navigation.menu {
        margin-bottom: 20px !important;
    }
    .navigation.button {
        margin: -.5em 0 -.5em .5em !important;
    }
</style>
<script>
    export default {
        props: ['user_json', 'admin'],
        data: function () {
            return {
            };
        },
        computed: {
            settingsUrl: function () {
                settingsUrl: ['/users', this.user.id].join('/')
            },
            user: function () {
                return JSON.parse(this.user_json);
            }
            userIcon: function () {
                var icon = 'user icon';

                if (this.admin) {
                    icon = 'spy icon';
                }

                return icon;
            }
        },
        methods: {
            showLogin: function () {
                $('#login-modal').modal('show');
            },
            showSignUp: function () {
                $('#signup-modal').modal('show');
            }
        }
    }
</script>
