<script setup>
import Navagation from '../components/Navagation.vue'
import Borang from '../components/BorangForm.vue'
import SideBar from '../components/SideBar.vue'
import Footer from '../components/Footer.vue'
</script>

<template>
  <header>
    <Navagation />
  </header>

  <body>
    <SideBar />
    <div class="container-sm">
      <center>
        <br>
        <br>
        <br>
        <div class="top--text">
          <h1>Borang Kebenaran Balik Bermalam</h1>
        </div>
        <Borang />
      </center>
    </div>

    <!--todo, tambah padding dekat atas footer ni supaya tak overlay atas borang -->
    <br>
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