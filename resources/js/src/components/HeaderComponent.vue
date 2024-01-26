<template>
  <header>
    <div class="header__main">
      <div class="header__top">
        <h1 class="header__main__logotype">Тофбанк</h1>
        <div class="header__main__right">
          <div class="header__main__right__text">
            <p class="header__main__right__text__number">+7(951) 343-12-19</p>
            |
            <p class="header__main__right__text__address">г. Москва,
              ул. Мира, д. 44</p>
          </div>
        </div>
      </div>
      <div class="header__nav">
        <router-link to="/" class="header__nav__link">Главная</router-link>
        <router-link to="/credits" class="header__nav__link">Кредиты</router-link>
        <router-link to="/cards" class="header__nav__link">Карты</router-link>
        <router-link to="/contacts" class="header__nav__link">Контакты</router-link>
        <router-link to="/auth" v-if="!userInfo.auth" class="header__nav__link">Авторизация</router-link>
        <input type="submit" value="Выйти" v-if="userInfo.auth" form="logout" style="background-color: transparent; border: none;" class="header__nav__link">
        <router-link to="/profile" v-if="userInfo.auth"  class="header__nav__link">Профиль</router-link>
        <router-link to="/admin" v-if="userInfo.admin"  class="header__nav__link">Панель администратора</router-link>
        <form action="/logout" hidden="hidden" id="logout"></form>
      </div>
    </div>
  </header>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import axios from "axios";

export default defineComponent({
  data() {
    return {
        userInfo: {}
    };
  },
  mounted() {
    axios
        .get('http://localhost:4006/getAuthStatus')
        .then(response =>
        {
          this.userInfo = response.data


          console.log(this.userInfo)
        });
  }
})
</script>

<style scoped>
header{
  background-color: black;
  width: 100%;
}

.header__main {
  width: 1322px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
  margin: 0 auto;
  padding: 15px 0 16px;
}

.header__top{
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 0 auto;
  padding: 15px 0 16px;
  width: 100%;
}

.header__main__logotype{
  color: #ffffff;
  font-weight: 600;
}

.header__main__right{
  display: flex;
  gap: 40px;
  align-items: center;
}

.header__main__right__text{
  display: flex;
  gap: 9px;
}

.header__main__right__text p{
  font-family: "Open Sans", sans-serif;
  font-weight: 400;
  font-size: 18px;
  color: #ffffff;
  margin: 0;
  text-wrap: normal;
}

.header__nav{
  height: 53px;
  margin: 0 auto;
  display: flex;
  justify-content: center;
  align-items: flex-end;
  gap: 60px;
}

.header__nav__link{
  color: #ffffff;
  font-family: "Open Sans", sans-serif;
  font-size: 18px;
  font-weight: 600;
  text-decoration: none;

}
</style>
