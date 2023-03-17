<template>
  <div class="container-fluid p-0 cont" style="background-image: url('../../public/hala9.jpg'); background-size: cover;">
    <div class="row h-100">
      <div class="col-md-6 mx-auto my-auto">
        <div class="form_login">
          <div v-if="errorMessage && errorMessage.trim()" class="alert alert-danger" role="alert">
            {{ errorMessage }}
          </div>

          <form @submit.prevent="handleSubmit">
            <input v-model="email" type="email" id="email" placeholder="email" required />
            <input v-model="password" type="password" id="password" placeholder="password" required />
            <div class="d-flex">
              <button type="submit" class="btn btn-primary">Login</button>
              <RouterLink to="/Inscription" class="btn btn-success ms-3">Inscription</RouterLink>
            </div>
            <div class="mt-3">
              <input type="radio" id="admin" name="userType" value="admin" v-model="userType">
              <label for="admin" class="text-center" style="background-color: aqua;">Admin</label>
              <input type="radio" id="client" name="userType" value="client" v-model="userType">
              <label for="client" class="text-center" style="background-color: brown;">Client</label>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import axios from 'axios';

export default {
  name: "Login",
  data() {
    return {
      email: '',
      password: '',
      errorMessage: '',
      userType: 'admin',
      isAuthenticated: false // initialisation de la variable à false
    }
  },
  methods: {
    async loginAdmin() {
      try {
        const response = await axios.post('http://localhost/MonSalonline/Rest_Api/api/admin/exemple.php', {
          email: this.email,
          password: this.password
        });
        console.log(response.data);
        console.log(response);
        if (response.status === 200) {
          this.$router.push('/Dashboard');
          // enregistrement de la valeur de isLoggedIn dans le stockage local
          localStorage.setItem("isLoggedIn", true);
          localStorage.setItem("userType", 'admin');
          // mise à jour de la variable isAuthenticated
          this.isAuthenticated = true;
          
        }
      } catch (error) {
        this.errorMessage = error.response.data.message;
      }
    },
    async loginClient() {
      try {
        const response = await axios.post('http://localhost/MonSalonline/Rest_Api/api/client/loginClient.php', {
          email: this.email,
          password: this.password
        });
        if (response.status === 200) {
          this.$router.push('/Reserver');
          // enregistrement de la valeur de isLoggedIn dans le stockage local
          localStorage.setItem("isLoggedIn", true);
          // mise à jour de la variable isAuthenticated
          this.isAuthenticated = true;
          // enregistrement de l'id du client connecté dans le stockage local
          console.log(response);
          localStorage.setItem("user_id", response.data.user_id);
        }
      } catch (error) {
        this.errorMessage = error.response.data.message;
      }
    },
    handleSubmit() {
      if (this.userType === 'admin') {
        this.loginAdmin();
      } else if (this.userType === 'client') {
        this.loginClient();
      }
    }
  }
};
</script>

<style>
.cont {
  height: 100vh;
}

.form_login {
  width: 300px;
  margin: 0 auto;
}
</style>
