import Vue from 'vue';
import VueRouter from 'vue-router';

import SaveContact from '../pages/contact/save-contact'; // 6/13 add
import IndexContact from '../pages/contact/index-contact'; // 6/13 add

Vue.use(VueRouter)

const routes = [
    // routes内をadd 6/13 7/30
    {
        path: '/',
        name: 'contact',
        component: IndexContact
    },
    {
        path: '/create/contact',
        name: 'create_contact',
        component: SaveContact
    },
    {
        path: '/edit/contact/:id',
        name: 'edit_contact',
        component: SaveContact
    }
]

const router = new VueRouter({
    mode: 'history',
    routes,
})

export default router