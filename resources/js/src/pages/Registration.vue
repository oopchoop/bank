<template>
  <section class="authorization">
    <form action="/registration" method="post" class="authorization__form">
        <input name="_token" :value="csrf" type="text" hidden="hidden">
      <h2 class="authorization__form__title">Регистрация</h2>
      <input required type="text" placeholder="Номер телефона" name="number" class="authorization__form__number authorization__form__input">
      <input required type="password" placeholder="Пароль" name="password" class="authorization__form__password authorization__form__input">
      <input type="submit" value="Зарегистрироваться" class="authorization__form__auth authorization__form__input">
      <p class="authorization__form__reg">
        Есть аккаунт? <router-link to="/auth" class="authorization__form__reg__link">Авторизоваться</router-link>
      </p>

    </form>
  </section>
</template>

<script lang="ts">
export default {
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    }),
}
</script>

<style scoped>
.authorization{
  width: 1320px;
  margin: 50px auto 0 auto;
}

.authorization__form{
  margin: 0 auto;
  display: flex;
  flex-direction: column;
  gap: 15px;
  width: 300px;
  align-items: center;
}

.authorization__form__title{
  color: #000000;
  font-size: 30px;
}

.authorization__form__input{
  width: 300px;
  padding: 10px;
  border: 1px solid #000000;
  border-radius: 10px;
  font-size: 15px;
  outline: none;
}

.authorization__form__auth{
  background-color: #000000;
  color: #ffffff;
}

.authorization__form__reg{
  align-self: flex-start;
  color: black;
}
</style>
