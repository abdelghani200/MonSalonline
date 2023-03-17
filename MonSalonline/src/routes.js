import { createRouter, createWebHistory } from 'vue-router';
import Accueil from './components/Accueil.vue';
import Blog from './components/Blog.vue';
import Reserver from './components/Reserver.vue';
import Login from './components/Login.vue';
import Inscription from './components/Register.vue';
import Dashboard from  './components/Dashboard.vue';




const routes = [
    {
        path: '/Accueil',
        component: Accueil,
    },
    {
        path: '/Blog' , 
        component: Blog,
    },
    {
        path: '/Reserver' , 
        component: Reserver,
    },
    {
        path: '/Login' , 
        component: Login,
    },
    {
        path: '/Inscription' , 
        component: Inscription,
    },
    {
        path: '/Dashboard',
        component: Dashboard
    }
    
]

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router

