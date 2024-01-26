import Home from '@/pages/Home.vue';
import Cards from '@/pages/Cards.vue';
import Authorization from '@/pages/Authorization.vue';
import Contacts from '@/pages/Contacts.vue';
import Credits from '@/pages/Credits.vue';
import Registration from '@/pages/Registration.vue';
import CurrentNews from '@/pages/CurrentNews.vue';
import CreditCalculate from '@/pages/CreditCalculate.vue';
import Profile from "@/pages/Profile.vue";
import Admin from "@/pages/Admin.vue";
import CreditEdit from "@/pages/CreditEdit.vue";
import CardEdit from "@/pages/CardEdit.vue";

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/cards',
        component: Cards
    },
    {
        path: '/auth',
        component: Authorization
    },
    {
        path: '/contacts',
        component: Contacts
    },
    {
        path: '/credits',
        component: Credits
    },
    {
        path: '/reg',
        component: Registration
    },
    {
        path: '/post/:id',
        component: CurrentNews
    },
    {
        path: '/calculateCredit/:id',
        component: CreditCalculate
    },
    {
        path: '/profile',
        component: Profile
    },
    {
        path: '/admin',
        component: Admin
    },
    {
        path: '/creditEdit/:id',
        component: CreditEdit
    },
    {
        path: '/newCredit',
        component: CreditEdit
    },
    {
        path: '/cardEdit/:id',
        component: CardEdit
    },
    {
        path: '/newCard',
        component: CardEdit
    },
];

export default routes;
