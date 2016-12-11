<template>
    <div :class="itemClass" :data-value="item.id">
        <i v-if="item.icon" :class="item.icon"></i>
        {{ item.name }}
    </div>
</template>
<script>
    export default {
        props: ['item', 'is_active'],
        computed: {
            itemClass: function () {
                if (this.is_active) {
                    return 'item active';
                } else {
                    return 'item';
                }
            }
        },
        mounted() {
            this.$emit('item-added');
        }
    };
</script>
