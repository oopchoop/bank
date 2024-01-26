<template>
  <section class="card-edit">
    <form :action="`${this.$route.params.id ? '/updateCard' : '/addNewCard'}`" method="post" class="card-edit__form">
      <input required name="_token" :value="csrf" type="text" hidden="hidden">
      <input required name="id" :value="`${this.$route.params.id}`" type="text" hidden="hidden">
      <h2 class="card-edit__form__title">{{this.$route.params.id ? 'Редактирование карты' : 'Новая карта'}}</h2>
      <input required type="text" placeholder="Название" name="name" :value="`${cardData.name ? cardData.name : '' }`" class="card-edit__form__number card-edit__form__input">
      <input required type="text" placeholder="Описание" name="description" :value="`${cardData.description ? cardData.description : '' }`" class="card-edit_form__number card-edit__form__input">
      <input required type="number" placeholder="Обслуживание" step="0.1" name="service" :value="`${cardData.service ? cardData.service : '' }`" class="card-edit_form__number card-edit__form__input">
      <input required type="number" placeholder="Макс. сумма переводов в месяц" name="limit" :value="`${cardData.limit ? cardData.limit : '' }`" class="card-edit_form__number card-edit__form__input">
      <select name="type_id" class="card-edit__form__input" style="background-color: transparent">
        <option v-for="type in cardsType" :value="`${type.id}`" :selected="`${(cardData && cardData.type_id == type.id) ? 'true' : 'false'}`">{{type.name}}</option>
      </select>
      <input type="submit" :value="`${this.$route.params.id ? 'Изменить' : 'Добавить'}`" class="card-edit__form__auth card-edit__form__input">
    </form>
  </section>
</template>

<script lang="ts">
import axios from "axios";

export default {
  data: () => ({
    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    cardsType: [],
    cardData: {}
  }),
  mounted() {
    axios
        .get('http://localhost:4006/getCardsType')
        .then(response =>
        {
          this.cardsType = response.data;
        });
    if(this.$route.params.id)
    {
      axios
          .get(`http://localhost:4006/getCardsFromId/${this.$route.params.id}`)
          .then(response => {
            this.cardData = response.data;
          });
    }
  }
}
</script>

<style scoped>
.card-edit{
  width: 1320px;
  margin: 50px auto 0 auto;
}

.card-edit__form{
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 300px;
  align-items: center;
}

.card-edit__form__title{
  color: #000000;
  font-size: 30px;
  text-align: center;
}

.card-edit__form__input{
  width: 300px;
  padding: 10px;
  border: 1px solid #000000;
  border-radius: 10px;
  font-size: 15px;
  outline: none;
}

.card-edit__form__auth{
  background-color: #000000;
  color: #ffffff;
}
</style>
