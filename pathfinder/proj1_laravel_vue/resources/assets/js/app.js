
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
// Vue.component('posts', require('./components/posts/Posts.vue'));
// Vue.component('navbar', require('./components/Navbar.vue'));

import Post from './components/posts/Post';
import axios from 'axios';

const app = new Vue({
    el: '#app',
    components: {
        Post
    },
    data: {
        posts: []
    },
    created() {
        axios.get('/getposts').then(response => {
            this.posts = response.data;
        }).catch(e => {
            console.log(e)
        });
    }
});


/* meta-blog js code */
// $(document).ready(function(){

    /* show/hide comments */
    /*if( typeof(posts) !== 'undefined'){
        for( let i = 0; i < posts.length; i++ ){
            $('#post' + posts[i]).click( function() {
                var display = $('#comments' + posts[i]).css('display');
                if( display == "none" ){
                    $('#comments' + Number(posts[i])).css('display', 'inline-block');
                }
                else {
                    $('#comments' + Number(posts[i])).css('display', 'none');
                }
            });
        }
    }

}); */
