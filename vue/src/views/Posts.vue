<template>

    <Button text="Add Post" backgroundColor="#ccc" @btn-click="addPostBtnClick"/>
    <ul class="posts">
        <li v-for="post in posts" v-bind:key="post.id">
              <div class="post">
              <h3>{{post.id}}</h3>
              <p> {{post.body}} </p>
              <i @click="onDelete(post.id)">Delete</i>
            </div>
        </li>
    </ul>
</template>
<script>
import axios from 'axios';
export default {
     components: {

    },
    data() {
        return {
            posts: [],
            isAddPost: true,
        }
    },
    created() {
    },
     mounted() {
      debugger;
        fetch('https://jsonplaceholder.typicode.com/posts', {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            this.posts = data;
            console.log(data);
        })
        .catch(err => console.log(err.message));
    },
    methods: {
        deletePost(id) {
           this.posts = this.posts.filter((post) => post.id !== id);
        },
        addPostBtnClick() {
          this.isAddPost = true;
        },
        addPost(post) {
          this.isAddPost = false;
          console.log(post);
          const fd = new FormData();
          fd.append('image', this.post.feature_image, this.post.feature_image.name);

          axios.post('http://localhost/test', fd)
          .then(res=> {
              console.log(res)
          })
        }
    }
}
</script>

<style>
#app {
 text-align: left;
}
</style>