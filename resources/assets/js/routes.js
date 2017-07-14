const router = new VueRouter();

router.map({
    '/': {
        name: 'list-api',
        component: require('./components/api/List.vue')
    },
    '/response/add': {
        name: 'add-response',
        component: require('./components/Response.vue')
    },
    '/api/add': {
        name: 'add-api',
        component: require('./components/api/New.vue')
    },
    // '/api/add/:resource_id': {
    //     name: 'show-form-api',
    //     component: require('./components/api/New.vue')
    // },
    '/get/customer': {
        name: 'get-resource_cus',
        component: require('./components/api/Customer.vue')
    },
    '/get/contributor': {
        name: 'get-resource_con',
        component: require('./components/api/Contributor.vue')
    },
});

var App = Vue.extend({});

router.start(App, '#app');
