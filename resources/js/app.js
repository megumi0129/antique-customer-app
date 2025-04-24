import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import ImageUploader from './components/ImageUploader.vue';

const app = createApp({});
app.component('image-uploader', ImageUploader);
app.mount('#app');
createApp(ImageUploader).mount('#app');
