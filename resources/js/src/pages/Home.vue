<template>
<section class="news">
  <h2 class="news__title title">Последние новости</h2>
  <div class="news__list">
    <div class="news__list__block" v-for="currentNews in news">
      <p class="news__list__block__date">{{currentNews.date_str}}</p>
      <router-link :to="`/post/${currentNews.id}`" class="news__list__block__title">{{ currentNews.name }}</router-link>
    </div>
  </div>
</section>
  <section class="actual">
    <h2 class="actual__title title">Актуальное</h2>
    <div class="actual__list">
      <div class="actual__list__block">
        <router-link to="/credits" class="actual__list__block__title">Возьмите кредит с малым процентом</router-link>
        <p class="actual__list__block__description">Такой кредит подойдет всем, потому что процент на него маленький,
        такой, что все обзавидуются.</p>
      </div>
      <div class="actual__list__block" style="background-color: #67122d">
        <router-link to="/cards" class="actual__list__block__title">Закажите новую дебеотвую карту</router-link>
        <p class="actual__list__block__description">Лучшее решение для молодого и взрослого поколения.</p>
      </div>
    </div>
    <div class="actual__list__block" style="background-color: #056719">
      <router-link to="/cards" class="actual__list__block__title">Закажите кредитную карту</router-link>
      <p class="actual__list__block__description">Исполняйте свои мечты здесь и сейчас</p>
    </div>
  </section>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import axios from "axios";

export default defineComponent({
  data() {
    return {
        news: []
    };
  },
  mounted() {
    axios
        .get('http://localhost:4006/getNews')
        .then(response =>
        {
          this.news = response.data
        });
  }
})
</script>

<style scoped>
  section{
    width: 1320px;
    margin: 50px auto 0 auto;
    display: flex;
    flex-direction: column;
    gap: 30px;
  }

  .title{
    font-size: 30px;
    color: #000000;
  }

  .news__list{
    display: flex;
    gap: 60px;
    color: #000000;
  }

  .news__list__block{
    width: 400px;
  }

  .news__list__block__title{
    text-decoration: none;
    font-size: 20px;
    color: #000000;
  }

  .actual__list{
    display: flex;
    justify-content: space-between;
  }

  .actual__list__block{
    display: flex;
    flex-direction: column;
    gap: 15px;
    background-color: #1a0943;
    border-radius: 10px;
    color: #ffffff;
    padding: 15px;
    width: 645px;
  }

  .actual__list__block__title{
    color: #ffffff;
    text-decoration: none;
    font-size: 20px;
  }
</style>