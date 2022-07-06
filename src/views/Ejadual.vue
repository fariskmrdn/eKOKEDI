<script setup>
import Navagation from '../components/Navagation.vue'
import SideBar from '../components/SideBar.vue'
// import Carousel from '../components/Carousel.vue'
import Footer from '../components/Footer.vue'
</script>

<template>
  <header>
    <Navagation />
  </header>

  <body>
    <SideBar />
      <br><br><br>
    <div class="container">
      <center>
        <h1>Ejadual</h1>
        <br>

        <!-- Jaduals -->
      
        <img src="../../src/assets/images/carousel1.svg" class="w-100" alt="jadual1">
        <p>Jadual</p>
        <img src="../../src/assets/images/carousel2.svg" class="w-100" alt="jadual2">
        <p>Jadual</p>
        <img src="../../src/assets/images/carousel3.svg" class="w-100" alt="jadual3">
        <p>Jadual</p>
        
      </center>
    </div>
    <br>
    <br>
    <br>
    <Footer />
  </body>
</template>

<style>
@import '../css/base.css';
@import '../css/main.css';
/* @import './bootstrap/css/bootstrap.css'; */
</style>