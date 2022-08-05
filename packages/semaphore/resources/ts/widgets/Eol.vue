<template>
    <div class="panel pb-12 relative">
        <div class="panel--title" v-html="title"></div>
        <table v-if="eols">
            <tbody>
            <tr v-for="eol in eols">
                <td>{{ eol.name }}</td>
                <td>
                    <div class="highlight">
                        <span><span v-bind:class="[getStatusClass(eol), 'badge']"></span>{{ eol.version }}</span>
                    </div>
                </td>
                <td><span class="badge bg-gray-400"></span>Not latest</td>
            </tr>
            </tbody>
        </table>
        <div class="bottom-4 absolute text-xs text-gray-400">Current data</div>
    </div>
</template>

<script lang="ts">
import { Component, Prop, Vue } from 'vue-property-decorator';
import EolRepository from "../repositories/EolRepository";
import {EolType} from "../types/eol/EolType";
import {EolColor} from "../enums/EolColor";

@Component
export default class Eol extends Vue {
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

    // Data
    private eolRepository: EolRepository = EolRepository.getInstance();
    private eols: EolType[] = [];

    async getEol() {
        const start: number = Date.now();
        const end: number = Date.now();

        this.eols = await this.eolRepository.getEol(this.metric, start, end);
    }

    getStatusClass(eol: EolType) {
        switch (eol.color) {
            case EolColor.RED:
                return 'bg-red-500';
            case EolColor.YELLOW:
                return 'bg-yellow-500';
            case EolColor.GREEN:
                return 'bg-green-500';
            case EolColor.GREY:
                return 'bg-gray-500';
            default:
                return 'bg-gray-500';
        }
    }

    mounted() {
        this.getEol();
    }
};
</script>
