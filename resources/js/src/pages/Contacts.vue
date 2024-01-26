<template>
  <section class="contacts">
    <h2 class="contacts__title">Контакты</h2>
    <div class="contacts__content">
      <div class="contacts__content__info">
          <p class="contacts__content__info__address">Адрес: г. Москва, ул. Мира, д. 44</p>
          <p class="contacts__content__info__email">Эл. почта: info@tofbank.com</p>
          <p class="contacts__content__info__number">Номер: +7(951) 343-12-19</p>
      </div>
      <img src="@/assets/images/map.png" alt="Map" class="contacts__content__map">
    </div>
  </section>
</template>

<script lang="ts">

</script>

<style scoped>
.contacts{
  width: 1320px;
  margin: 50px auto 0 auto;
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.contacts__title{
  font-size: 30px;
  color: #000000;
}

.contacts__content{
  display: flex;
  justify-content: space-between;
}

.contacts__content__info{
  color: #000000;
  display: flex;
  flex-direction: column;
  gap: 15px;
  font-size: 20px;
}

.contacts__content__map{
  width: 800px;
  height: 500px;
}
</style>