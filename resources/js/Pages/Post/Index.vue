<script>
import axios from "axios";
import {Link} from "@inertiajs/vue3";
export default {
    name: "Create",
    methods: {
        toggleLiked(post){
            axios.get(`/posts/${post.id}/toggle_liked`)
                .then(res=>{
                    console.log(res);
                    post.liked = res.data.liked
                    post.liked ? ++post.liked_col : --post.liked_col
                    console.log(post.liked_col);
                })
        }
    },
    components:{
      Link
    },
    props: {
        posts: Array
    },
    data() {
        return {
            postData: this.posts.data
        }
    }
}
</script>

<template>
    <div class="max-w-2xl mx-auto p-6 bg-gray-100 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Посты</h1>
        <div v-for="post in postData" :key="post.id" class="mb-8 bg-white rounded-lg shadow-md overflow-hidden">
            <Link :href="route('posts.show', post.id)" class="block transition-transform transform hover:scale-102">
                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ post.title }}</h3>

                    <div v-if="post.image_url" class="mb-4">
                        <img :src="post.image_url" alt="preview" class="w-full h-auto rounded-md shadow-sm">
                    </div>

                    <p class="text-gray-700 mb-4">{{ post.content }}</p>
                </div>
            </Link>
            <div class="px-4 py-2 bg-gray-50 flex items-center justify-between">
                <div>
                    <a :href="route('personal.show', post.user)" class="text-blue-500 hover:underline">{{ post.user_name }}</a>
                </div>
                <a :href="route('posts.edit', post.id)" class="text-blue-500 hover:underline">Изменить</a>

                <div class="flex items-center space-x-2">
                    <span class="text-gray-600">{{ post.liked_col }}</span>
                    <button @click.prevent="toggleLiked(post)" class="focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                             :class="[post.liked ? 'fill-sky-500' : 'fill-red-500', 'cursor-pointer w-6 h-6 transition-colors duration-200']">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </template>

<style scoped>
/* Additional styles can be added here if necessary */
</style>
