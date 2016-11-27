<template>
    <div class="item" :data-value="item.id">
        <i v-if="item.icon" :class="item.icon"></i>
        {{ item.name }}
    </div>
</template>
<script>
    export default {
        props: ['item']
    };
</script>
