<template>
    <div class="container">
        <h1>Blog</h1>

        <div v-if="posts.length > 0">
            <article v-for="post in posts" :key="post.id">
                <h2>{{post.title}}</h2>
                <div>{{formatDate(post.created_at)}}</div>
                <router-link :to="{name: 'post-detail', params: {slug: post.slug}}">Read More</router-link>
            </article>
            <section class="navigation">
                <button @click="getPosts(pagination.current - 1)" :disabled ="!(pagination.current > 1)">Prev</button>
                <button :class="{'active-page' : pagination.current == i}" v-for="i in pagination.last" :key="`page-${i}`" @click="getPosts(i)">{{i}}</button>
            
                <button @click="getPosts(pagination.current + 1)" :disabled="!(pagination.current < pagination.last)">Next</button>
            </section>
        </div>

        <Loader v-else/>
    </div>
</template>

<script>
import Loader from '../components/Loader.vue';

export default {
    name: 'Blog',
    components:{
        Loader,
    },    
    data() {
        return {
            posts: [],
            pagination: {},
        }
    },
    created(){
        this.getPosts();
    },
    methods: {
        /**
         * Get Post from Api
         */
        getPosts(page = 1) {
            // Call Api
            axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
            .then(res => {
                this.posts = res.data.data;
                this.pagination = {
                    current: res.data.current_page,
                    last: res.data.last_page
                };
            })
            .catch(err => {
                console.log(err);
            });
        },

        /**
         * Format Date
         */
        formatDate(date) {
            const postDate = new Date(date);
            let day = postDate.getDate();
            let month = postDate.getMonth() + 1;
            let year = postDate.getFullYear();

            if(day < 10){
                day = '0' + day;
            }
            if(month < 10){
                month = '0' + month;
            }

            return `${day}/${month}/${year}`;
        }
    }  
}
</script>

<style>

</style>