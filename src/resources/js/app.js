import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import { createApp } from 'vue';
import HomePage from './components/HomePage.vue';

const app = createApp({});
app.component('home-page', HomePage);
app.mount('#app');
