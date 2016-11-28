<template>
    <div v-if="is_admin" class="admin tools row">
        <div class="column" @click="beginEditing">Edit</div>
    </div>
</template>
<style>
    .admin.tools.row {
        padding: 0 0 1rem;
    }
    .admin.tools.row>.column {
        text-align: right;
        align-self: inherit;
        cursor: pointer;
    }
</style>
<script>
    export default{
        props: ['is_admin'],
        data() {
            return{
            }
        },
        methods: {
            beginEditing: function () {
                this.$emit('begin-editing');
                console.log('Attempted to emit.');
            },
        },
        components:{
        }
    }
</script>
