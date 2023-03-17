<template>
    <div class="container" id="page_reservation">
        <div class="row my-4">
            <div class="col-md-6 mx-auto">
                <div class="calendar">
                    <label for="reservation_date">Rechercher une date :</label>
                    <input type="date" v-model="searchDate" id="reservation_date" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row my-4" v-if="reservations.length">
            <div class="col-md-6 mx-auto">
                <h3 class="text-center">Réservations du {{ searchDate }}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="color: black;">Heure</th>
                            <th scope="col" style="color: black;">État</th>
                            <th scope="col" style="color: black;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(hour, index) in hours" :key="hour">
                            <td>{{ hour }}</td>
                            <td>{{ isReserved(hour) ? 'Réservé' : 'Disponible' }}</td>
                            <td>
                                <button v-if="!isReserved(hour)" class="btn btn-primary"
                                    @click="reserveHour(hour)">Réserver</button>
                                <button v-else class="btn btn-danger" @click="deleteReservation(hour)">Supprimer</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row my-4" v-else>
            <div class="col-md-6 mx-auto">
                <h3 class="text-center">Aucune réservation pour cette date</h3>
            </div>
        </div>
    </div>
</template>
  
  
<script>
import axios from 'axios';

export default {
    name: 'App',
    data() {
        return {
            hours: ['09:00', '10:00', '11:00', '12:00', '14:00', '15:00', '16:00', '17:00', '18:00'],
            reservations: [],
            searchDate: new Date().toISOString().slice(0, 10),
            currentUserId: localStorage.getItem('user_id'),
            editReservationId: null,
            editReservationHeure: '',
            deleteReservationId: null
        };
    },
    created() {
        this.loadData();
    },
    methods: {
        isReserved(hour) {
            return this.reservations.some(
                reservation => reservation.heure === hour && reservation.created_at === this.searchDate
            );
        },
        reserveHour(hour) {

            // Vérifier si le client a déjà réservé une heure pour la date de réservation sélectionnée
            if (this.reservations.some(reservation => reservation.user_id === this.currentUserId && reservation.created_at === this.searchDate)) {
                alert("Vous avez déjà réservé une heure pour cette date.");
                return;
            }

            const reservation = {
                user_id: this.currentUserId,
                created_at: this.searchDate,
                heure: hour
            };

            axios
                .post('http://localhost/MonSalonline/Rest_Api/api/reservation/create.php', reservation)
                .then(res => {
                    this.loadData();
                    alert('Réservation réussie');
                })
                .catch(error => {
                    console.error(error);
                    alert('Échec de la réservation');
                });
        },

        loadData() {
            axios
                .get('http://localhost/MonSalonline/Rest_Api/api/reservation/read.php')
                .then(res => {
                    this.reservations = res.data.data;
                })
                .catch(error => {
                    console.error(error);
                    alert('Une erreur est survenue lors du chargement des données');
                });
        },
        deleteReservation(hour) {
            const reservation = this.reservations.find(
                (reservation) => reservation.heure === hour && reservation.created_at === this.searchDate
            );
            if (reservation) {
                if (reservation.user_id === this.currentUserId) {
                    this.deleteReservationId = reservation.id;
                    axios
                        .post('http://localhost/MonSalonline/Rest_Api/api/reservation/delete.php', {
                            'id': reservation.id
                        })
                        .then(res => {
                            this.loadData();
                            alert('Réservation supprimée');
                            this.deleteReservationId = null;
                        })
                        .catch(error => {
                            console.error(error);
                            alert("Échec de la suppression de la réservation");
                        });
                } else {
                    alert("Vous ne pouvez supprimer que votre propre réservation");
                }
            } else {
                alert("Cette réservation n'existe pas");
            }
        }

    }
}


</script>

