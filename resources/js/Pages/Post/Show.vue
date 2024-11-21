<script>
import axios from "axios";
import {Link} from "@inertiajs/vue3";
export default {
    name: "Create",
    methods: {
        toogleFollowing(user){
            axios.get(`/users/${user.id}/toogleFollowing`)
                .then(res=>{
                    userData.following = res.data.following
                })
        },
        toggleLiked(post){
            axios.get(`/posts/${post.id}/toggle_liked`).then(
                res=>{
                    postData.liked = res.data.liked
                    postData.liked ? ++postData.liked_col : --postData.liked_col
                }
            )
        }
    },
    components:{
      Link
    },
    props: {
        post: Array,
        user: Object
    },
    data() {
        return {
            userData: this.user,
            postData: this.post.data
        }
    },

}
</script>

<template>
    <div class="max-w-4xl mx-auto p-6 bg-gray-50 rounded-lg shadow-md">
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Количество лайков: {{ postData.liked_col }}</h1>
            <a :href="route('posts.index')" class="text-blue-500 hover:underline mt-2 block">ГЛАВНАЯ</a>
        </div>

        <div class="flex justify-between items-center mb-4">
            <button
                @click.prevent="toogleFollowing(postData.user)"
                class="px-4 py-2 rounded bg-red-600 text-white transition-colors duration-200 hover:bg-red-700 focus:outline-none"
            >
                {{ userData.following ? "Отписаться" : "Подписаться" }}
            </button>
        </div>
        <button @click.prevent="toggleLiked(postData)" class="focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
                 :class="[postData.liked ? 'fill-sky-500' : 'fill-red-500', 'cursor-pointer w-6 h-6 transition-colors duration-200']">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </button>
        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <div class="mb-4">
                <h2 class="text-xl font-bold text-gray-800">Автор:</h2>
                <Link :href="route('personal.show', postData.users)" class="text-blue-500 hover:underline">{{ postData.user_name }}</Link>
            </div>

            <div class="mb-4">
                <h3 class="text-2xl font-semibold text-gray-800">{{ postData.title }}</h3>
            </div>

            <div class="mb-4">
                <p class="text-gray-700">{{ postData.content }}</p>
            </div>

            <div v-if="postData.image_url" class="mb-4">
                <img :src="postData.image_url" alt="preview" class="w-full h-auto rounded-md shadow-sm transition-transform transform hover:scale-105">
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Additional styles can be added here if necessary */
</style>


