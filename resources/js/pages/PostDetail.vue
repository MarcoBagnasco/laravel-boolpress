<template>
    <div class="container">
        <div v-if="post">
            <h1>{{post.title}}</h1>

            <div class="post-info">
                <Category v-if="post.category" :category="post.category.name"/>

                <Tags v-if="post.tags" :tags="post.tags"/>
            </div>
            <p>{{post.content}}</p>
        </div>
        <Loader v-else/>
        <router-link :to="{name: 'blog'}">Blog</router-link>
    </div>
</template>

<script>
import Loader from '../components/Loader.vue';
import Category from '../components/Category.vue';
import Tags from '../components/Tags.vue';

export default {
    name: 'PostDetail',
    components:{
        Loader,
        Category,
        Tags
    },
    data(){
        return {
            post: null,
        }
    },
    created(){
        this.getPostDetails();
    },
    methods: {
        getPostDetails(){
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
                .then(res => {
                    this.post = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
}
</script>

<style>

</style>