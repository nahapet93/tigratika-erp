import { createApp } from 'vue/dist/vue.esm-bundler';
import ProductList from './components/ProductList.vue';

const app = createApp({
    components: {
        'product-list' : ProductList,
    }
});

app.mount('#app');
