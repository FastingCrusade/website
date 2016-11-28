<template>
    <div class="card">
        <div class="content">
            <div class="header">
                {{ header }}
            </div>
            <div class="meta">
                Category: Subtype <span class="right floated">Marshall Davis</span>
            </div>
            <div class="description">
                Full description…
            </div>
        </div>
        <div class="extra content">
            <div class="ui green progress" data-percent="73">
                <div class="bar"></div>
            </div>
        </div>
    </div>
</template>
<style>
</style>
<script>
    export default {
        props: ['card'],
        data() {
            return {
            }
        },
        computed: {
            header: function () {
                var header;
                if (this.card.description.length > 30) {
                    header = this.card.description.substring(0, 28) + "…"
                } else {
                    header = this.card.description;
                }

                return header;
            },
        },
        components: {
        }
    }

    var interval = setInterval(function () {
            var $progress_bars = $('.ui.progress');
            var attempts = 0;

            if (!$progress_bars.length < 1 && attempts < 19) {
                $progress_bars.progress();
                clearInterval(interval);
            } else {
                attempts = attempts + 1;
            }
        }, 500);
</script>
