import {createWebHashHistory, createRouter } from 'vue-router';
import Welcome from './components/Welcome.vue'
import UserList from './components/UserList.vue'
import UpdateUser from './components/UpdateUser.vue'
import store from './auth/state.js'


// let home_route = {
//     name: 'home',
//     path: '/',
//     component: (!store.getters.getToken ? Welcome : UserList)
// };

const routes = [
    {
        name: 'home',
        path: '/',
        // component: store.getters.getHome
        component: (store.getters.getToken) ? UserList : Welcome
    },
    // {
    //     name: 'users',
    //     path: '/users',
    //     component: UserList
    // },

    {
        name: 'userEdit',
        path: '/users/:id/edit',
        component: UpdateUser,
        meta:{
            requireAuth: true
        }
    },
    // {
    //     name: 'userCreate',
    //     path: '/users/add',
    //     component: CreateUser,
    //     meta:{
    //         requireAuth: true
    //     }
    // },


];
const router = createRouter({
    history: createWebHashHistory(),
    routes,
});
router.beforeEach((to, from) => {
    // alert(router.currentRoute.value.name);
    if(to.meta.requireAuth && !store.getters.getToken) {
        alert("You need to log in to do this request.");
        router.push('/');
    }


});
export default router;
