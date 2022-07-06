<script setup>
import Navagation from '../components/Navagation.vue'
import SideBar from '../components/SideBar.vue'
import Carousel from '../components/Carousel.vue'
import Footer from '../components/Footer.vue'
</script>

<template>
  <header>
    <Navagation />
  </header>

  <body>
    <SideBar />
    <br>
      <center>
        <Carousel />
      </center>
    <br>
    <div class="container">
      <center>
        <img src="../../src/assets/images/carousel1.svg" class="w-100" alt="jadual1">
        <p>Carta</p>

        <img src="../../src/assets/images/carousel1.svg" class="w-100" alt="jadual1">
        <p>Carta</p>
      </center>
    </div>
  
    <!-- <div class="container">
      <center>
        <h1>Dashboard</h1>
        <Carousel />
        <br>
        <img src="../../src/assets/images/carousel1.svg" class="w-100" alt="jadual1">
        <p>Carta</p>
      </center>
    </div> -->


    <br><br><br>
    <Footer />
  </body>
</template>

<style>
@import '../css/base.css';
@import '../css/main.css';
/* @import './bootstrap/css/bootstrap.css'; */
</style>