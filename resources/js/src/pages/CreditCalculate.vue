<template>
  <section class="calc-credit">
    <h2 class="calc-credit__title">Рассчет кредита</h2>
    <div class="calc-credit__info">
      <form class="calc-credit__info__form" action="/addCredit" method="post">
        <input name="_token" :value="csrf" type="text" hidden="hidden">
        <input type="text" id="credit-id" name="credit_id" :value="`${dataCredit.id}`" hidden="hidden">
        <input type="text" id="month_pay" name="month_pay" hidden="hidden">
        <input type="text" id="result_sum" name="result_sum" hidden="hidden">
        <input type="number" :max="`${dataCredit.limit}`" :value="`${dataCredit.limit}`" v-on:change="changeData" :placeholder="`Введите сумму (до ${dataCredit.limit})`" name="sum" id="sum" class="calc-credit__info__form__input">
        <input type="number" :max="`${dataCredit.term}`" :value="`${dataCredit.term}`" v-on:change="changeData" :placeholder="`Введите кол-во лет (до ${dataCredit.term})`" name="years" id="years" class="calc-credit__info__form__input">
        <input type="submit" style="margin-top: 45px;" value="Оформить" class="calc-credit__info__form__submit">
      </form>
      <div class="calc-credit__info__params">
        <p class="calc-credit__info__params__param">Процент: {{ dataCredit.rate }}%</p>
        <p class="calc-credit__info__params__param">Максимальный срок: {{dataCredit.term}} л/г</p>
        <p class="calc-credit__info__params__param">Максимальная сумма: {{dataCredit.limit}}р</p>
        <p class="calc-credit__info__params__param" id="result_m">Месячная плата: 0р</p>
        <p class="calc-credit__info__params__param" id="result_s">Общая сумма выплат: 0р</p>
      </div>
    </div>

  </section>
</template>

<script lang="ts">
import {defineComponent} from 'vue';
import axios from "axios";
import {createLogger} from "vite";

export default defineComponent({
  components: {},
  data() {
    return {
        dataCredit: {},
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    };
  },
  mounted() {
    axios
        .get(`http://localhost:4006/getCreditFromId/${this.$route.params.id}`)
        .then(response =>
        {
          this.dataCredit = response.data

          let resP = document.querySelector('#result_m')
          let resS = document.querySelector('#result_s')

          let months = this.dataCredit.term * 12

          let normalPay = this.dataCredit.limit / months

          let resultPay = normalPay + normalPay * (this.dataCredit.rate / 100 )
          let resultSum = resultPay * months

          document.querySelector('#month_pay').value = resultPay
          document.querySelector('#result_sum').value = resultSum

          resS.innerHTML = 'Общая сумма выплат: ' + resultSum.toFixed(2) + 'р'
          resP.innerHTML = 'Месячная плата: ' + resultPay.toFixed(2) + 'р'

        });
  },
  methods: {
    changeData()
    {
        let years = document.querySelector('#years').value
        let sum = document.querySelector('#sum').value

        if(years > this.dataCredit.term)
        {
          document.querySelector('#years').value = this.dataCredit.term
          years = this.dataCredit.term
        }
        else if(years < 1)
        {
          document.querySelector('#years').value = 1
          years = 1
        }

        if(sum > this.dataCredit.limit)
        {
          document.querySelector('#sum').value = this.dataCredit.term
          sum = this.dataCredit.term
        }
        else if(sum < 1)
        {
          document.querySelector('#sum').value = 1
          sum = 1
        }

        let resP = document.querySelector('#result_m')
        let resS = document.querySelector('#result_s')

        let months = years * 12

        let normalPay = sum / months

        let resultPay = normalPay + normalPay * (this.dataCredit.rate / 100 )
        let resultSum = resultPay * months

        document.querySelector('#month_pay').value = resultPay
        document.querySelector('#result_sum').value = resultSum

        resS.innerHTML = 'Общая сумма выплат: ' + resultSum.toFixed(2) + 'р'
        resP.innerHTML = 'Месячная плата: ' + resultPay.toFixed(2) + 'р'
    }
  }
});
</script>

<style scoped>
.calc-credit{
  width: 1320px;
  margin: 50px auto 0 auto;
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.calc-credit__title{
  font-size: 30px;
  color: #000000;
}

.calc-credit__info{
  display: flex;
  justify-content: space-between;
}

.calc-credit__info__form{
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.calc-credit__info__form__input{
  width: 300px;
  border-radius: 10px;
  padding: 10px;
  border: 1px solid #000000;
}

.calc-credit__info__form__submit{
  width: 300px;
  border-radius: 10px;
  background-color: #000000;
  color: #ffffff;
  border: none;
  padding: 10px;
}

.calc-credit__info__params{
  display: flex;
  flex-direction: column;
  gap: 15px;
  border: 1px solid #000000;
  border-radius: 10px;
  padding: 15px 10px;
}

.calc-credit__info__params p{
  margin: 0;
}
</style>