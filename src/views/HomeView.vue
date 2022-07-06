<script setup>
import SideBar from '../components/SideBar.vue'
import Carousel from '../components/Carousel.vue'
import Login from '../components/Login.vue'
import Footer from '../components/Footer.vue'
</script>

<template>
  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light cusSticky">
      <div class="container-sm">
        <img src="../assets/images/LOGO-2021-KV-KUALA-SELANGOR-t.png" alt="logo--kv" class="navbar-brand2">
      </div>  
    </nav>
  </header>

  <body>
    <section>
      <br>
      <div class=" container-sm pt-5 d-flex">
        <SideBar />
        <div class="d-none d-lg-block d-xl">
          <Carousel />
        </div>
        <Login />
      </div>
    </section>
    <Footer />
  </body>
</template>

<style>
@import '../css/base.css';
@import '../css/main.css';
/* @import './bootstrap/css/bootstrap.css'; */
</style>