
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('navigation', require('./components/Navigation.vue'));
Vue.component('welcome', require('./components/Welcome.vue'));
Vue.component('log-in', function (resolve) {require(['./components/auth/LogIn.vue'], resolve);});
Vue.component('sign-up', function (resolve) {require(['./components/auth/SignUp.vue'], resolve);});

const app = new Vue({
    el: '#app'
});
