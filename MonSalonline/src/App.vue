<script>
// import HelloWorld from './components/HelloWorld.vue'
// import TheWelcome from './components/TheWelcome.vue'



</script>

<template>
  <div class="m-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a href="#" class="navbar-brand"><img width="50px" height="50px" style="border-radius: 50%;" src="../public/ModernCoupe.png"></a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
          <div class="navbar-nav">
            <a href="#" class="nav-item nav-link active">Accueil</a>
            <a href="#" class="nav-item nav-link">Services</a>
          </div>
          <form class="d-flex">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search">
              <button type="button" class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
          </form>
          <div class="navbar-nav">
            <a href="#" class="nav-item nav-link">Login</a>
          </div>
        </div>
      </div>
    </nav>
  </div>

</template>

<style>
/* .card{
  padding: 20px;
  background: #eee;
} */
</style>
