<template>
  <div class="m-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <div class="navbar-brand">
          <img style="border-radius:50%; width:60px; height:60px;" src="../public/ModernCoupe.png">
        </div>
        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
          <div class="navbar-nav">
            <RouterLink to="/Accueil" class="nav-item nav-link active" style="font-size: 20px;">Accueil</RouterLink>
            <RouterLink to="/Reserver" class="nav-item nav-link active" style="font-size: 20px;">Reserver</RouterLink>
            
            <RouterLink v-if="userType == admin && isAuthenticated == true" to="/Dashboard" class="nav-item nav-link active" style="font-size: 20px;">Dashboard</RouterLink>
          </div>

          <div class="navbar-nav">
            <!-- Si l'utilisateur est connecté, afficher le message de déconnexion -->
            <button v-if="isAuthenticated == true" class="nav-item nav-link active" style="font-size: 20px;"
              @click="handleLogout()">Logout</button>
            <!-- Sinon, afficher le bouton de connexion -->
            <RouterLink v-else to="/Login" class="nav-item nav-link active" style="font-size: 20px;">Login
            </RouterLink>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <RouterView />
  <Footer />
</template>

<script>
import { RouterLink } from 'vue-router';
import Footer from '@/components/Footer.vue';

export default {
  name: "app",
  components: {
    Footer
  },
  data(){
    return {
      isAuthenticated: localStorage.getItem("isLoggedIn") === "true"
    }
  },
  methods: {
    handleLogout() {
      // delete de la valeur de isLoggedIn dans le stockage local
      localStorage.removeItem("isLoggedIn");
      localStorage.removeItem("user_id");
      // mise à jour de la variable isAuthenticated
      this.isAuthenticated = false;
      // redirection vers la page d'accueil
      this.$router.push('/Accueil');
    }
  }
};


</script>

<style>

.navbar {
    background-color: #f8f9fa;
    border-bottom: 1px solid #d3d3d3;
    padding: 10px;
    margin-bottom: 20px;
  }

  .navbar-brand img {
    margin-right: 10px;
  }

  .navbar-nav {
    display: flex;
    align-items: center;
  }

  .nav-item {
    margin-right: 20px;
  }

  .nav-item:last-child {
    margin-right: 0;
  }

  .nav-link {
    color: #000;
    font-weight: bold;
    text-transform: uppercase;
  }

  .nav-link:hover {
    color: #007bff;
  }

  .active {
    color: #007bff;
  }

  button {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #0069d9;
  }

</style>
