<template>
    <div class="panel">
        <div class="panel--title" v-html="title"></div>
        <div class="highlight highlight-raspberry">
            <span><span class="badge bg-raspberry"></span>2021-04-12</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            metric: {
                required: true,
                type: String
            },
            title: {
                required: true,
                type: String
            }
        }
    }
</script>