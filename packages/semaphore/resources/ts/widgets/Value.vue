<template>
    <div class="panel pb-12 relative">
        <div class="panel--title" v-html="title"></div>
        <div class="highlight highlight-raspberry">
            <span><span class="badge bg-raspberry"></span>{{ value ? value.value : '' }}</span>
        </div>
        <div class="bottom-4 absolute text-xs text-gray-400">{{ metric }}</div>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';
import ValueRepository from "../repositories/ValueRepository";
import {ValueType} from "../types/value/ValueType";

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

    @Prop({
        required: true,
        type: String,
    }) instance!: string;

    private valueRepository: ValueRepository = ValueRepository.getInstance();
    private value: ValueType | null = null;

    async mounted() {
        try {
            this.value = await this.valueRepository.getValue(this.metric, this.instance);
        } catch (e) {
            this.value = {value: 'No data'};
        }
    }
};
</script>
