import Vue from 'vue';
import Router from 'vue-router';
import PlacePage from '@/pages/PlacePage';
import ProfilePage from '@/pages/ProfilePage';
import NewPlacePage from '@/pages/NewPlacePage';
import UserListsPage from '@/pages/UserListsPage';
import PlaceListPage from  '@/pages/PlaceListPage';
import CheckinsPage from '@/pages/CheckinsPage';
import SearchPlacePage from  '@/pages/SearchPlacePage';
import store from '../store/index';
import middlewares from './middlewares';
import ListPage from '@/pages/ListPage';
import UserListAddUpdatePage from '@/pages/UserListAddUpdatePage';
import SignUpPage from '@/pages/SignUpPage';
import LoginPage from '@/pages/LoginPage';
import ResetPasswordPage from '@/pages/ResetPasswordPage';
import RecoverPasswordPage from '@/pages/RecoverPasswordPage';
import MyTastesPage from '@/pages/MyTastesPage';
import SocialAuthPage from '@/pages/SocialAuthPage';
import OtherUserPage from '@/pages/OtherUserPage';
import NotificationsPage from '@/pages/NotificationsPage';

Vue.use(Router);

const middleware = handler => (
    routes => routes.map(route => Object.assign({}, route, {beforeEnter: handler}))
);

export default new Router({
    mode: 'history',
    base: '/',
    scrollBehavior: () => ({y: 0}),
    routes: [
        ...middleware(middlewares.auth(store))([
            {
                path: '/',
                name: 'home',
                redirect: '/search'
            },
            {
                path: '/users/:id',
                name: 'OtherUserPage',
                component: OtherUserPage
            },
            {
                path: '/my-places',
                name: 'PlacesList',
                component: PlaceListPage
            },
            {
                path: '/my-tastes',
                name: 'MyTastesPage',
                component: MyTastesPage
            },
            {
                path: '/places/add',
                name: 'NewPlacePage',
                component: NewPlacePage
            },
            {
                path: '/search',
                name: 'SearchPlacePage',
                component: SearchPlacePage
            },
            {
                path: '/places/:id',
                name: 'PlacePage',
                component: PlacePage
            },
            {
                path: '/my-lists/add',
                name: 'UserListAdd',
                component: UserListAddUpdatePage
            },
            {
                path: '/my-lists/:id/edit',
                name: 'UserListUpdate',
                component: UserListAddUpdatePage
            },
            {
                path: '/my-lists',
                name: 'UserListsPage',
                component: UserListsPage
            },
            {
                path: '/list/:id',
                name: 'ListPage',
                component: ListPage
            },
            {
                path: '/checkins',
                name: 'CheckinsPage',
                component: CheckinsPage
            },
            {
                path: '/settings',
                name: 'ProfilePage',
                component: ProfilePage
            },
            {
                path: '/notifications',
                name: 'NotificationsPage',
                component: NotificationsPage
            },
            {
                path: '*',
                redirect: '/'
            }
        ]),
        ...middleware(middlewares.guest(store))([
            {
                path: '/login',
                name: 'LoginPage',
                component: LoginPage
            },
            {
                path: '/signup',
                name: 'SignUpPage',
                component: SignUpPage
            },
            {
                path: '/reset',
                name: 'ResetPasswordPage',
                component: ResetPasswordPage
            },
            {
                path: '/recover',
                name: 'RecoverPasswordPage',
                component: RecoverPasswordPage
            },

            {
                path: '/auth/social/:provider',
                name: 'SocialAuthPage',
                component: SocialAuthPage
            },
        ])
    ]
});