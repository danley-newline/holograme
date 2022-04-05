import Vue from 'vue'
import VueRouter from 'vue-router'
import Accueil from './pages/Index.vue'
import LikePage from './pages/Likepage.vue'
import WishPage from './pages/Wishpage.vue'
import pluginOtp from './pages/pluginOtp.vue'
import OneLikePage from './pages/OneLikePage.vue'
import UserPage from './pages/User.vue'
import NasaCreate from './pages/NasaCreate'



Vue.use(VueRouter);

const routes = [
    {path: "/", name: "accueil", component: Accueil},
    {path:"/like", name:"likes-setting", component: LikePage},
    {path:"/wish", name:"wish-list", component: WishPage},
    {path:"/plugotp", name:"otpplug", component: pluginOtp},
    {path: "/only_one_like", name:"one-like", component: OneLikePage},
    {path:"/create-user", name: "user-page", component:UserPage},
    {path:"/nasa-create", name: "nasapage", component:NasaCreate}
    //{path: '*', redirect:'/diank'},
];

export const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes
});

export default router;