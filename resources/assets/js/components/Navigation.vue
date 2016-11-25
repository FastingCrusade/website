<template>
    <div class="ui container">
        <div class="ui large secondary pointing navigation menu">
            <a class="toc item">
                <i class="sidebar icon"></i>
            </a>
            <a class="active item">Home</a>
            <a v-if="!user" class="right item">
                <a class="ui navigation button" @click="showLogin()">Log In</a>
                <a class="ui navigation button" @click="showSignUp()">Sign Up</a>
            </a>
            <a v-if="user" class="right item">
                <i :class="userIcon"></i>
                {{ user }}
            </a>
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
        props: ['user', 'admin'],
        data: function () {
            return {
            };
        },
        computed: {
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
