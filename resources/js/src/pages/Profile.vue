<template>
  <section class="usr-cards">
    <h2 class="usr-cards__title title">Карты</h2>
    <div class="usr-cards__cards__list">
      <div class="usr-cards__cards__list__block" v-for="card in dataCard">
        <h2 class="usr-cards__cards__list__block__name">{{ card.name }}</h2>
        <p class="usr-cards__cards__list__block__number">{{card.card_number}}</p>
        <p class="usr-cards__cards__list__block__description">{{card.description}}</p>
        <ul class="usr-cards__cards__list__block__characteristics">
          <li class="usr-cards__cards__list__block__characteristics__element">Обслуживание: {{card.service}} {{!isNaN(Number(card.service)) ? 'р' : ''}}</li>
          <li class="usr-cards__cards__list__block__characteristics__element">Лимит до {{card.limit}} руб. в месяц</li>
        </ul>
      </div>
    </div>
  </section>
  <section class="usr-credits">
    <h2 class="usr-credits title">Кредиты</h2>
    <div class="usr-credits__credits__list">
      <div class="usr-credits__credits__list__block" v-for="credit in dataCredit">
        <h2 class="usr-credits__credits__list__block__title">{{ credit.name }}</h2>
        <p class="usr-credits__credits__list__block__date" style="margin: 0">{{ credit.date }}</p>
        <p class="usr-credits__credits__list__block__description">{{credit.description}}</p>
        <ul class="usr-credits__credits__list__block__characteristics">
          <li class="usr-credits__credits__list__block__characteristics__block">Годовая ставка: {{credit.rate}}%</li>
          <li class="usr-credits__credits__list__block__characteristics__block">Сумма: {{credit.result_sum.toFixed(2)}} руб</li>
          <li class="usr-credits__credits__list__block__characteristics__block">Месячный платеж: {{credit.month_pay.toFixed(2)}} руб</li>
          <li class="usr-credits__credits__list__block__characteristics__block">Срок: {{credit.years}} г/л</li>
        </ul>
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
        dataCard: {},
        dataCredit: {}
    };
  },
  mounted() {
      axios
          .get('http://localhost:4006/getUserCards')
          .then(response =>
          {
              this.dataCard = response.data
          });

    axios
        .get('http://localhost:4006/getUserCredits')
        .then(response =>
        {
          this.dataCredit = response.data
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

.usr-cards__cards__list{
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

.usr-cards__cards__list__block{
  width: 400px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  color: #000000;
  border: 1px solid #000000;
  border-radius: 10px;
  padding: 0 5px 10px 5px;
}

.usr-cards__cards__list__block__number{
  margin: 0;
}

.usr-credits__credits__list{
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
}

.usr-credits__credits__list__block{
  display: flex;
  flex-direction: column;
  padding: 15px;
  width: 645px;
  border: 1px solid #000000;
  border-radius: 10px;
  color: #000000;
}

.usr-credits__credits__list__block__description{
  margin-top: 20px;
  font-size: 16px;
  font-weight: 300;
}

.usr-credits__credits__list__block__title{
  font-weight: 500;
}

.usr-credits__credits__list__block__characteristics{
  display: flex;
  flex-direction: column;
  gap: 10px;
  margin-top: 20px;
  font-size: 20px;
  color: rgba(56,80,255,1);
  font-weight: 500;
}
</style>