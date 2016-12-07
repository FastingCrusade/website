<template>
    <div class="column">
        <i :class="gender.icon"></i> {{ gender.name}}
    </div>
</template>
<style>
</style>
<script>
    export default {
        props: ['gender'],
        data(){
            return{
            }
        },
        components:{
        }
    }
</script>
