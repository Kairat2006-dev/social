<script>
import axios from "axios";

export default {
  name: "Create",
    props:{
      posts: Object
    },
  methods: {
    update() {
     this.post.image_id = this.image ? this.image.id :null
    axios.patch(`/posts/${this.post.id}`,this.post)
        .then(res=>{
          console.log(res);
        })
    },
    selectFile() {
      this.fileInput = this.$refs.file
      this.fileInput.click()
    },
    storeImage(e) {
      const file = e.target.files[0]
      const dataFormat = new FormData()
      dataFormat.append('image', file)
      axios.post('/post_image', dataFormat)
          .then(res => {
            console.log(res);
            this.image = res.data.data
          })
    }
  },
  data() {
    return {
      post: {...this.posts.data},
      image: ''
    }
  }
}
</script>

<template>

  <div class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md">
    <h3 class="mb-2">Post</h3>
    <div class="mb-4">
      <input type="text" v-model="post.title" placeholder="title"
             class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>
    <div class="mb-4">
      <textarea placeholder="content" v-model="post.content"
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 h-32 resize-none"></textarea>
    </div>
    <div v-if="post.image">
      <img :src="image.url">
      <a href="#" @click.prevent="image = null">Cancel</a>
    </div>
    <div class="flex mb-2 justify-between">
      <div class="relative">
        <input @change="storeImage" ref="file" type="file" class="hidden">
        <a href="#" @click.prevent="selectFile()"
           class="inline-block px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition duration-300">Image</a>

      </div>

    </div>
    <div class="mb-4">
      <a @click="update" href="#"
         class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">Изменить</a>
    </div>

  </div>
</template>

<style scoped>

</style>
