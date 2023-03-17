<template>
    <div class="container-fluid p-0 cont"
        style="background-image: url('../../public/hala9.jpg'); background-size: cover;">
        <div class="row h-100">
            <div class="col-md-6 mx-auto my-auto">
                <div class="form_login">
                    <form @submit.prevent="Enregistrer">
                        <input v-model="nom" type="text" name="nom" placeholder="nom">
                        <input v-model="prenom" type="text" name="prenom" placeholder="prenom">
                        <input v-model="numtele" type="text" name="numtele" placeholder="numtele">
                        <input v-model="email" type="text" placeholder="email">
                        <input v-model="password" type="password" placeholder="Password">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>




<script >

import axios from 'axios';


export default {
  name: "Register",
  data() {
    return {
      nom: '',
      prenom: '',
      numtele: '',
      email: '',
      password: ''
    }
  },
  methods: {
    Enregistrer() {
      // Validation des données du formulaire
      if (!this.nom || !this.prenom || !this.numtele || !this.email || !this.password) {
        console.error('Tous les champs sont requis !')
        return
      }

      // Exemple d'appel à une API pour enregistrer les données de l'utilisateur
      axios.post('http://localhost/MonSalonline/Rest_Api/api/client/create.php', {
        nom: this.nom,
        prenom: this.prenom,
        numtele: this.numtele,
        email: this.email,
        password: this.password
      })
      .then(response => {
        // Traitement de la réponse de l'API
        console.log(response.status)
        if (response.status === 200) {
          // Redirection vers une autre page, affichage d'un message de succès, etc.
          // window.location.href = '/Login';
          this.$router.push('/Login')
        } else {
          console.error(response.data.message)
        }
      })
      .catch(error => {
        // Traitement des erreurs
        console.error(error)
      })
    }
  }
}
</script>

<style>

#error {
  color: red;
}

</style>
