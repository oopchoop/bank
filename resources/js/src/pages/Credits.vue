<template>
  <section class="credits">
    <h2 class="credits__title">Выберите кредит</h2>
    <form action="" method="get" class="credits__filter">
        <div class="credits__filter__block">
          <input type="checkbox" name="fix" class="credits__filter__block__input"> Физ. лица
        </div>
        <div class="credits__filter__block">
          <input type="checkbox" name="ur" class="credits__filter__block__input"> Юр. лица
        </div>
      <input v-on:click="filter" type="button" style="outline: none; cursor: default" value="Фильтрация" class="credits__filter__submit">
    </form>
    <div class="credits__list">
      <div class="credits__list__block" v-for="credit in credits">
        <h2 class="credits__list__block__title">{{credit.name}}</h2>
        <p class="credits__list__block__description">{{credit.description}}</p>
        <ul class="credits__list__block__characteristics">
          <li class="credits__list__block__characteristics__block">Годовая ставка: {{credit.rate}}%</li>
          <li class="credits__list__block__characteristics__block">Сумма до: {{credit.limit}} руб</li>
          <li class="credits__list__block__characteristics__block">Срок до: {{credit.term}}</li>
        </ul>
        <router-link style="text-decoration:none;" class="credits__list__block__submit" :to="`/calculateCredit/${credit.id}`" v-if="userInfo.auth">Перейти к рассчету</router-link>
        <router-link style="text-decoration:none;" to="/auth" class="credits__list__block__submit" v-else>Перейти к рассчету</router-link>
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
          credits: [],
          allCredits: [],
          userInfo: {}
        };
      },
      mounted() {
        axios
            .get('http://localhost:4006/getCredits')
            .then(response => {
              this.credits = response.data;
              this.allCredits = response.data;
            });
        axios
            .get('http://localhost:4006/getAuthStatus')
            .then(response =>
            {
              this.userInfo = response.data
            });
      },
      methods: {
        filter () {
          let newCredits = [];

          let fiz = document.getElementsByName('fix')[0].checked;
          let ur = document.getElementsByName('ur')[0].checked;

          this.allCredits.forEach(value => {
            if((value.type_id == 1 && fiz) || (value.type_id == 2 && ur))
            {
              newCredits.push(value)
            }

          this.credits = newCredits;
          });
        }
      }
    }
)
</script>

<style scoped>
.credits{
  width: 1320px;
  margin: 50px auto 0 auto;
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.credits__title{
  font-size: 30px;
  color: #000000;
}

.credits__filter{
  display: flex;
  gap: 20px;
  color: #000000;
}

.credits__filter__submit{
  width: 100px;
  padding: 5px;
  border: none;
  background-color: #000000;
  color: #ffffff;
  border-radius: 5px;
}

.credits__list{
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
}

.credits__list__block{
  display: flex;
  flex-direction: column;
  padding: 15px;
  width: 645px;
  border: 1px solid #000000;
  border-radius: 10px;
  color: #000000;
}

.credits__list__block__description{
  margin-top: 20px;
  font-size: 16px;
  font-weight: 300;
}

.credits__list__block__title{
  font-weight: 500;
}

.credits__list__block__characteristics{
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
</style>