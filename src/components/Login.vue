<template>
  <div style="list-style: none; margin-left:2rem; padding-top: 5rem;">
    <form class="form--login">
      <h1>Ekokedi -KVKS</h1>
      <!--^ input nama pengguna -->
      <div class="mb-3">
        <input placeholder="Id Pengguna" type="text" class="form-control pb-2" id="exampleInputEmail1" aria-describedby="nomidpelajar">
      </div>
      <!--^ input password pengguna -->
      <div class="mb-3">
        <input placeholder="Password Pengguna" type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <!--^ input button for -->
      <RouterLink to="/dashboard"><button type="submit" class="btn btn-primary">Log Masuk</button></RouterLink>
    </form>
  </div>
</template>

<style>

</style>
