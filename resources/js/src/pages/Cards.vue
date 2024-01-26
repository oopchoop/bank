<template>
  <section class="cards">
    <h2 class="cards__title">Выберите карту</h2>
    <div class="cards__list">
      <div class="cards__list__block" v-for="card in cards">
        <img src="@/assets/images/card.jpeg" alt="Card" class="cards__list__block__photo">
        <h2 class="cards__list__block__name">{{ card.name }}</h2>
        <p class="cards__list__block__description">{{card.description}}</p>
        <ul class="cards__list__block__characteristics">
          <li class="cards__list__block__characteristics__element">Обслуживание: {{card.service}} {{!isNaN(Number(card.service)) ? 'р' : ''}}</li>
          <li class="cards__list__block__characteristics__element">Лимит до {{card.limit}} руб. в месяц</li>
        </ul>
        <input form="add-user" value="Оформить" type="submit" class="cards__list__block__execute" v-if="userInfo.auth">
        <router-link to="/auth" class="cards__list__block__execute" v-else>Оформить</router-link>
        <form :action="`/addCardToUser/${card.id}`" method="get" id="add-user"></form>
      </div>
    </div>
  </section>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import axios from "axios";

export default defineComponent(
    {
      data() {
        return {
          cards: [],
          userInfo: {}
        };
      },
      mounted() {
        axios
            .get('http://localhost:4006/getCards')
            .then(response => {
              this.cards = response.data
            });
        axios
            .get('http://localhost:4006/getAuthStatus')
            .then(response =>
            {
              this.userInfo = response.data
            });
      }
    }
)
</script>

<style scoped>
  .cards{
    width: 1320px;
    margin: 50px auto 0 auto;
    display: flex;
    flex-direction: column;
    gap: 30px;
  }

  .cards__title{
    font-size: 30px;
    color: #000000;
  }

  .cards__list{
    display: flex;
    gap: 30px;
    flex-wrap: wrap;
  }

  .cards__list__block{
    width: 500px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    color: #000000;
    border: 1px solid #000000;
    border-radius: 10px;
    padding: 0 5px 10px 5px;
  }

  .cards__list__block__photo{
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    width: 100%;
    height: 300px;
  }

  .cards__list__block__execute{
    width: 150px;
    padding: 5px;
    background-color: #000000;
    border-radius: 5px;
    color: #ffffff;
    border: none;
    text-decoration: none;
    text-align: center;
  }
</style>