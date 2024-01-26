<template>
<section class="post">
  <h2 class="post__title">{{dataPost.name}}</h2>
  <p class="post__text">{{dataPost.text}}</p>
</section>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import axios from "axios";

export default defineComponent({
    components: {},
    data() {
      return {
        dataPost: {}
      };
    },
    mounted() {
      axios
          .get(`http://localhost:4006/getPost/${this.$route.params.id}`)
          .then(response =>
          {
            this.dataPost = response.data
          });
    }
});
</script>

<style scoped>
.post{
  width: 1320px;
  margin: 50px auto 0 auto;
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.post__title{
  font-size: 30px;
  color: #000000;
}
</style>