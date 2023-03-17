<template>
    <main id="main">
        <section id="clients">
            <h2>Clients</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Jour</th>
                        <th>Heure</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in clients" :key="client.id">
                        <td>{{ client.id }}</td>
                        <td>{{ client.nom }}</td>
                        <td>{{ client.prenom }}</td>
                        <td>{{ client.email }}</td>
                        <td>{{ client.numtele }}</td>
                        <td>{{ client.created_at }}</td>
                        <td>{{ client.heure }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</template>

<script>

import axios from 'axios';

export default {
    name: 'App',
    data() {
        return {
            clients: [],
        };
    },
    methods: {
        loadData() {
            axios
                .get('http://localhost/MonSalonline/Rest_Api/api/client/read.php')
                .then(res => {
                    this.clients = res.data.data;
                    console.log(this.clients);
                })
                .catch(error => {
                    console.error(error);
                    alert('An error occurred while fetching data');
                });
        },

    },
    created() {
        this.loadData()
    }
}

</script>



<style>
/* Style général */

#main {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 50px 0;
}

h2 {
  text-align: center;
}


/* Style de la table des jours fériés */
table {
  border-collapse: collapse;
  width: 80%;
  margin-bottom: 50px;
  margin-top: 20px;
}

table th,
table td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: center;
}

table th {
  background-color: #0066cc;
  color: #fff;
}

table tr:nth-child(even) {
  background-color: #f2f2f2;
}

/* Style de la section clients */
#clients {
  width: 80%;
  margin-top: 50px;
}

#clients table {
  width: 100%;
}

#clients th {
  background-color: #0066cc;
  color: #fff;
  padding: 10px;
  text-align: center;
}

#clients td {
  padding: 10px;
  text-align: center;
}

#clients tr:nth-child(even) {
  background-color: #f2f2f2;
}


</style>