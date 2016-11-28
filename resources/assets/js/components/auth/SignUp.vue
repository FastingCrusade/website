<template>
    <div class="ui centered modal" id="signup-modal">
        <i class="close icon"></i>
        <div class="content">
            <form class="ui equal width centered login form" action="register" method="POST">
                <input type="hidden" name="_token" :value="csrfToken">
                <div class="field">
                    <input type="email" placeholder="Your email..." name="email">
                </div>
                <div class="field">
                    <input type="password" placeholder="Your password.." name="password">
                </div>
                <div class="field">
                    <button class="ui button" type="submit">Create Account</button>
                </div>
            </form>
            <div class="ui horizontal divider">
                OR
            </div>
            <div class="login buttons">
                <button class="ui facebook button"><i class="facebook icon"></i>Sign up with Facebook</button>
                <button class="ui google plus button"><i class="google icon"></i>Sign up with Google</button>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        computed: {
            csrfToken: function () {
                return $('meta[name="csrf_token"]').attr('content');
            }
        }
    }
</script>
