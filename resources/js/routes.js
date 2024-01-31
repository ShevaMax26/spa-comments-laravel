import {createRouter, createWebHistory} from "vue-router";
import NotFound404 from "./Pages/Errors/404.vue";
import Home from "./Pages/Question/Index.vue";
import Register from "./Pages/Auth/Register.vue";
import Login from "./Pages/Auth/Login.vue";
import CreateQuestion from "@/Pages/Question/Create.vue";
import ShowQuestion from "@/Pages/Question/Show.vue";

const routes = [
    {path: '/', name: "home", component: Home},
    {path: '/register', name: "register", component: Register},
    {path: '/login', name: "login", component: Login},
    {path: '/create-question', name: "create-question", component: CreateQuestion},
    {path: '/questions/:id', name: "show-question", component: ShowQuestion},
    {path: '/:pathMatch(.*)*', name: '404', component: NotFound404},
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
