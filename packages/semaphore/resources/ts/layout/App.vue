<template>
    <div class="app">
        <div class="container bg-cobalt flex items-center justify-between px-4 py-2 text-white">
            <a class="h-10" v-bind:href="appUrl">
                <img class="h-10" src="/vendor/semaphore/images/logo-knockout.svg" alt="Semaphore" />
            </a>
            <a class="text-sm hover:underline" href="#">Sign out</a>
        </div>

        <div class="container p-4">
            <router-view></router-view>
        </div>

        <div class="container p-2 text-center text-gray-400 text-xs">
            &copy; {{ new Date().getFullYear() }} Further Digital Solutions.
        </div>
    </div>
</template>

<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import store from "../store";

    @Component
    export default class App extends Vue {
        get appUrl() {
            return store.state.appUrl;
        }
    };
</script>