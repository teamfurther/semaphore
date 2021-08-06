import { Component, Vue } from 'vue-property-decorator'
import { __ } from './helpers';

@Component
export default class AppMixins extends Vue {
    __(key: string) {
        return __(key);
    };
}