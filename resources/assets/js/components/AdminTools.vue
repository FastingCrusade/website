<template>
    <div v-if="is_admin" class="admin tools row">
        <div class="column">Edit</div>
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
        data(){
            return{
            }
        },
        components:{
        }
    }
</script>
