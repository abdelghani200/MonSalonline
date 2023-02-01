import { createRouter, createWebHistory } from 'vue-router';
import Acceuil from './components/Acceuil.vue';
// import Footer from './components/Footer.vue';

const routes = [
    {
        path: '/Acceuil',
        component: Acceuil,
    },
    // {
    //     path: '/add-countrie', component: addCountrie,
    // }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router