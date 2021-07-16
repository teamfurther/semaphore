<template>
    <div class="panel pb-12 relative">
        <div class="panel--title" v-html="title"></div>
        <div class="highlight highlight-raspberry">
            <span><span class="badge bg-raspberry"></span>2021-04-12</span>
        </div>
        <div class="bottom-4 absolute text-xs text-gray-400">Current data</div>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';

@Component
export default class Value extends Vue {
    // Props
    @Prop({
        required: true,
        type: String,
    }) id!: string;

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