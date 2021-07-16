<template>
    <div class="panel">
        <div class="panel--title" v-html="title"></div>
        <div class="highlight highlight-raspberry">
            <span><span class="badge bg-raspberry"></span>2021-04-12</span>
        </div>
    </div>
</template>

<script lang="ts">
import { Prop, Vue } from 'vue-property-decorator'

export default class Value extends Vue {
    // Props
    @Prop({
        required: true,
        type: String,
    }) metric!: string;

    @Prop({
        required: true,
        type: String,
    }) title!: string;
};
</script>