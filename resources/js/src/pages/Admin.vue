<template>
  <section class="admin-cards">
    <div class="admin-cards__top">
      <h2 class="admin-cards__title title">Карты</h2>
      <router-link style="text-decoration:none; margin: 0; width: 200px;" to="/newCard" class="credits__list__block__submit">Новая</router-link>
    </div>
    <div class="admin-cards__cards__list">
      <div class="admin-cards__cards__list__block" v-for="card in cards">
        <h2 class="admin-cards__cards__list__block__name">{{ card.name }}</h2>
        <p class="admin-cards__cards__list__block__description">{{card.description}}</p>
        <ul class="admin-cards__cards__list__block__characteristics">
          <li class="admin-cards__cards__list__block__characteristics__element">Обслуживание: {{card.service}} {{!isNaN(Number(card.service)) ? 'р' : ''}}</li>
          <li class="admin-cards__cards__list__block__characteristics__element">Лимит до {{card.limit}} руб. в месяц</li>
        </ul>
        <div class="admin-cards__credits__list__block__buttons">
          <input type="submit" value="Удалить" :form="`delete-card${card.id}`" style="text-decoration:none;" class="credits__list__block__submit delete">
          <form :action="`/deleteCard/${card.id}`" :id="`delete-card${card.id}`"></form>
          <router-link style="text-decoration:none;" :to="`/cardEdit/${card.id}`" class="credits__list__block__submit">Редактировать</router-link>
        </div>
      </div>
    </div>
  </section>
  <section class="admin-credits">
    <div class="admin-credits__top">
      <h2 class="admin-credits__title title">Кредиты</h2>
      <router-link style="text-decoration:none; margin: 0; width: 200px;" to="/newCredit" class="credits__list__block__submit">Новый</router-link>
    </div>
    <div class="admin-credits__credits__list">
      <div class="admin-credits__credits__list__block" v-for="credit in credits">
        <h2 class="admin-credits__credits__list__block__title">{{credit.name}}</h2>
        <p class="admin-credits__credits__list__block__description">{{credit.description}}</p>
        <ul class="admin-credits__credits__list__block__characteristics">
          <li class="admin-credits__credits__list__block__characteristics__block">Годовая ставка: {{credit.rate}}%</li>
          <li class="admin-credits__credits__list__block__characteristics__block">Сумма до: {{credit.limit}} руб</li>
          <li class="admin-credits__credits__list__block__characteristics__block">Срок до: {{credit.term}} г/л</li>
        </ul>
        <div class="admin-cards__credits__list__block__buttons">
          <input type="submit" value="Удалить" :form="`delete${credit.id}`" style="text-decoration:none;" class="credits__list__block__submit delete">
          <form :action="`/deleteCredit/${credit.id}`" :id="`delete${credit.id}`"></form>
          <router-link style="text-decoration:none;" :to="`/creditEdit/${credit.id}`" class="credits__list__block__submit">Редактировать</router-link>
        </div>
      </div>
    </div>
  </section>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import axios from "axios";

export default defineComponent({
  data() {
    return {
      credits: {},
      cards: {}
    };
  },
  mounted() {
    axios
        .get('http://localhost:4006/getCredits')
        .then(response => {
          this.credits = response.data;
        });
    axios
        .get('http://localhost:4006/getCards')
        .then(response => {
          this.cards = response.data;
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

.admin-cards__cards__list{
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

.admin-cards__cards__list__block{
  width: 400px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  color: #000000;
  border: 1px solid #000000;
  border-radius: 10px;
  padding: 15px;
}

.admin-credits__credits__list{
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
}

.admin-credits__credits__list__block{
  display: flex;
  flex-direction: column;
  padding: 15px;
  width: 645px;
  border: 1px solid #000000;
  border-radius: 10px;
  color: #000000;
}

.admin-credits__credits__list__block__description{
  margin-top: 20px;
  font-size: 16px;
  font-weight: 300;
}

.admin-credits__credits__list__block__title{
  font-weight: 500;
}

.admin-credits__credits__list__block__characteristics{
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-top: 20px;
  font-size: 20px;
  color: rgba(56,80,255,1);
  font-weight: 500;
}

.credits__list__block__submit{
  margin-top: 30px;
  width: 300px;
  padding: 10px;
  font-size: 15px;
  border-radius: 10px;
  border: none;
  background-color: #000000;
  color: #ffffff;
  text-decoration: none;
  text-align: center;
}

.delete{
  background-color: #8f0000;
}

.admin-cards__credits__list__block__buttons{
  display: flex;
  gap: 30px;
}

.admin-credits__top, .admin-cards__top{
  display: flex;
  gap: 50px;
  align-items: center;
}
</style>