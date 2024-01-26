<template>
  <section class="credit-edit">
    <form :action="`${this.$route.params.id ? '/updateCredit' : '/addNewCredit'}`" method="post" class="credit-edit__form">
      <input required name="_token" :value="csrf" type="text" hidden="hidden">
      <input required name="id" :value="`${this.$route.params.id}`" type="text" hidden="hidden">
      <h2 class="credit-edit__form__title">{{this.$route.params.id ? 'Редактирование кредита' : 'Новый кредит'}}</h2>
      <input required type="text" placeholder="Название" name="name" :value="`${this.creditData.name ? this.creditData.name : '' }`" class="credit-edit__form__number credit-edit__form__input">
      <input required type="text" placeholder="Описание" name="description" :value="`${this.creditData.description ? this.creditData.description : '' }`" class="credit-edit_form__number credit-edit__form__input">
      <input required type="number" placeholder="Процент" step="0.1" name="rate" :value="`${this.creditData.rate ? this.creditData.rate : '' }`" class="credit-edit_form__number credit-edit__form__input">
      <input required type="number" placeholder="Макс. сумма" name="limit" :value="`${this.creditData.limit ? this.creditData.limit : '' }`" class="credit-edit_form__number credit-edit__form__input">
      <input required type="number" max="40" placeholder="Макс. срок (в годах)" :value="`${this.creditData.term ? this.creditData.term : '' }`" name="term" class="credit-edit_form__number credit-edit__form__input">
      <select name="type_id" class="credit-edit__form__input" style="background-color: transparent">
        <option v-for="type in creditTypes" :value="`${type.id}`" :selected="`${(this.creditData && this.creditData.type_id == type.id) ? 'true' : 'false'}`">{{type.name}}</option>
      </select>
      <input type="submit" :value="`${this.$route.params.id ? 'Изменить' : 'Добавить'}`" class="credit-edit__form__auth credit-edit__form__input">
    </form>
  </section>
</template>

<script lang="ts">
import axios from "axios";

export default {
  data: () => ({
    csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    creditTypes: [],
    creditData: {}
  }),
  mounted() {
    axios
        .get('http://localhost:4006/getCreditTypes')
        .then(response =>
        {
            this.creditTypes = response.data;
        });
    if(this.$route.params.id)
    {
      axios
          .get(`http://localhost:4006/getCreditFromId/${this.$route.params.id}`)
          .then(response => {
            this.creditData = response.data;
          });
    }
  }
}
</script>

<style scoped>
.credit-edit{
  width: 1320px;
  margin: 50px auto 0 auto;
}

.credit-edit__form{
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 300px;
  align-items: center;
}

.credit-edit__form__title{
  color: #000000;
  font-size: 30px;
  text-align: center;
}

.credit-edit__form__input{
  width: 300px;
  padding: 10px;
  border: 1px solid #000000;
  border-radius: 10px;
  font-size: 15px;
  outline: none;
}

.credit-edit__form__auth{
  background-color: #000000;
  color: #ffffff;
}
</style>
