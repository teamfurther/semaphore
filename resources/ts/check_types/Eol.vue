<template>
    <div class="panel">
        <div class="panel--title" v-html="title"></div>
        <table>
            <tbody>
                <tr>
                    <td>Ubuntu</td>
                    <td>
                        <div class="highlight">
                            <span><span class="badge bg-pearl"></span>18.04</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>nginx</td>
                    <td>
                        <div class="highlight highlight-raspberry">
                            <span><span class="badge bg-raspberry"></span>1.14.0</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>PHP</td>
                    <td>
                        <div class="highlight highlight-tangerine">
                            <span><span class="badge bg-tangerine"></span>7.3.28</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>Laravel</td>
                    <td>
                        <div class="highlight highlight-raspberry">
                            <span><span class="badge bg-raspberry"></span>5.8.38</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>Composer</td>
                    <td>
                        <div class="highlight">
                            <span><span class="badge bg-gray-400"></span>1.6.2</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>Node</td>
                    <td>
                        <div class="highlight highlight-raspberry">
                            <span><span class="badge bg-raspberry"></span>9.11.2</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>Vue</td>
                    <td>
                        <div class="highlight">
                            <span><span class="badge bg-pearl"></span>2.6.8</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>NPM</td>
                    <td>
                        <div class="highlight">
                            <span><span class="badge bg-gray-400"></span>5.6.0</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>MariaDB</td>
                    <td>
                        <div class="highlight highlight-raspberry">
                            <span><span class="badge bg-raspberry"></span>10.1.48</span>
                        </div>
                    </td>
                    <td><span class="badge bg-gray-400"></span>Not latest</td>
                </tr>
                <tr>
                    <td>Redis</td>
                    <td>
                        <div class="highlight">
                            <span><span class="badge bg-pearl"></span>6.2.4</span>
                        </div>
                    </td>
                    <td><span class="badge bg-pearl"></span>Latest</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
    import { Prop, Vue } from 'vue-property-decorator'

    export default class Eol extends Vue {
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