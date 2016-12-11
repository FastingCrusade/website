<template>
    <div class="column" data-gender-id="gender.id">
        <button class="ui icon red mini button" @click="showModal">
            <i class="close icon"></i>
        </button>
        <i :class="gender.icon"></i> {{ gender.name}}
        <div :class="modalClass">
            <div class="content">
                <div class="ui form">
                    <div class="inline fields">
                        <label>Modify existing users to:</label>
                        <gender-dropdown :genders_json="genders_json"></gender-dropdown>
                        <input type="hidden" name="gender-id" :value="gender.id">
                    </div>
                </div>
            </div>
            <div class="actions">
                <div class="ui green approve button" data-action="modify" @click="handleModal">Modify Users</div>
                <div class="ui button" data-action="skip" @click="handleModal">Leave Users</div>
                <div class="ui red cancel button">Cancel</div>
            </div>
        </div>
    </div>
</template>
<style>
</style>
<script>
    export default {
        props: ['gender', 'genders_json'],
        data() {
            return {
            }
        },
        methods: {
            showModal: function (event) {
                var selector = this.modalClass.split(' ').map(function (part) {
                    return '.' + part;
                }).join('');
                $(selector).modal('show');
            },
            handleModal: function (event) {
                var $button = $(event.currentTarget);
                var $modal = $button.closest('.modal');
                var $form = $modal.find('.form');
                var gender = $form.find('input[name="gender-id"]').val();
                var url = ['/gender/', gender].join('');
                var method = 'DELETE';

                if ($button.data('action') === 'modify') {
                    url = [url, '/replace'].join('');
                    method = 'PATCH';
                } else {
                    $modal.modal('hide');
                }

                // TODO Handle the result.
                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        '_token': $('meta[name="csrf_token"]').attr('content'),
                        'with': $modal.find('.gender.selection.dropdown input[name="gender"]').val(),
                    },
                });
            }
        },
        computed: {
            modalClass: function () {
                return ['ui', this.gender.name, 'modal'].join(' ');
            }
        },
        components: {
            'gender-dropdown': Vue.component('gender-dropdown', function (resolve) {require(['./collections/dropdowns/GenderDropdown.vue'], resolve);}),
        }
    }
</script>
