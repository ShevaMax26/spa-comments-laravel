import './bootstrap';
import '../css/app.css';
import {createApp} from 'vue'
import app from "./Layouts/MainLayout.vue";
import router from "./routes";
import store from './store';

createApp(app)
    .use(router)
    .use(store)
    .mount("#app");
