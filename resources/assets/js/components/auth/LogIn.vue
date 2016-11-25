<template>
    <div class="ui centered modal" id="login-modal">
        <i class="close icon"></i>
        <div class="content">
            <form class="ui equal width centered login form" method="POST" action="/login">
                <input type="hidden" name="_token" :value="csrfToken">
                <div class="field">
                    <input type="email" placeholder="Your email..." name="email">
                </div>
                <div class="field">
                    <input type="password" placeholder="Your password.." name="email">
                </div>
                <div class="field">
                    <button class="ui button" type="submit">Log In</button>
                </div>
            </form>
            <div class="ui horizontal divider">
                OR
            </div>
            <div class="login buttons">
                <button class="ui facebook button"><i class="facebook icon"></i>Log in with Facebook</button>
                <button class="ui google plus button"><i class="google icon"></i>Log in with Google</button>
            </div>
        </div>
    </div>
</template>
<style>
    .login.buttons {
        text-align: center;
    }
    .login.form {
        text-align: center;
    }
</style>
<script>
    export default {
        props: ['csrfToken'],
        data: function () {
            return {};
        }
    }
</script>
