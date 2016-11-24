<template>
    <div class="ui container">
        <div class="ui large secondary pointing navigation menu">
            <a class="toc item">
                <i class="sidebar icon"></i>
            </a>
            <a class="active item">Home</a>
            <a class="right item">
                <a class="ui navigation button" @click="showLogin()">Log In</a>
                <a class="ui navigation button" @click="showSignUp()">Sign Up</a>
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
        data: function () {
            return {
            };
        },
        computed: {
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
