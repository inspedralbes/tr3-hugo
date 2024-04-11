<template>
  <Header />
  <div class="background">
    <div class="profile-container" style="overflow-y: auto;">
      <div class="card_profile">
        <h2 class="profile-title">Perfil de Usuario</h2>
        <div v-if="user" class="profile-info">
          <p><strong>Name:</strong> {{ user.name }}</p>
          <p><strong>Email:</strong> {{ user.email }}</p>
          <div v-if="userTickets.length > 0">
            <h3>Tickets del usuario:</h3>
            <ul class="ticket-list">
              <li v-for="ticket in userTickets" :key="ticket.id" class="ticket-item">
                <div class="ticket-details">
                  <p><strong>Película:</strong> {{ ticket.movie_id }}</p>
                  <p><strong>Asiento:</strong> {{ ticket.seat_id }}</p>
                  <p><strong>Precio:</strong> {{ ticket.price_per_seat }}</p>
                </div>
              </li>
            </ul>
          </div>
          <div v-else>
            <p>No hay tickets asociados a este usuario.</p>
          </div>
        </div>
        <div v-else>
          <p>No hay información de usuario disponible</p>
          <!-- Otra acción que quieras mostrar si el usuario no está autenticado -->
        </div>
      </div>
      <div>
        <!-- Otros componentes o contenido -->
      </div>
      <button @click="logout" class="logout-button">Cerrar sesión</button>
    </div>
  </div>
</template>

<script>
import { useStore } from '../stores/index.js';

export default {
  data() {
    return {
      user: null,
      userTickets: []
    };
  },

  methods: {
    logout() {
      const userStore = useStore();
      userStore.setUser(null);
      localStorage.removeItem('user');
      this.$router.push('/login');
    }
  },

  mounted() {
    const userStore = useStore();
    this.user = userStore.returnUser();
    if (this.user) {
      // Fetch user tickets
      fetch(`http://tr3a22hugtrigon.daw.inspedralbes.cat/back/laravel/public/api/tickets/${this.user.id}/user`)
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          this.userTickets = data;
        })
        .catch(error => {
          console.error('Error fetching user tickets:', error);
        });
    }
  },
}
</script>

<style scoped>
/* Estilos */
.background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('../public/img/perf.png');
  background-size: cover;
  background-position: center;
  font-family: 'Roboto', sans-serif;
}

.profile-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
}

.card_profile {
  background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    width: 30%;
    /* margin: 1px auto; */
    position: relative;
    margin-top: 45%;
}

.profile-title {
  font-size: 2rem;
  color: black; /* Cambiado a negro para mayor contraste */
}

.profile-info {
  margin-top: 20px;
}

.ticket-list {
  list-style: none;
  padding: 0;
}

.ticket-item {
  background-color: #f9f9f9;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 5px;
  transition: background-color 0.3s ease; /* Agregada transición */
}

.ticket-item:hover {
  background-color: #e0e0e0; /* Cambio de color al pasar el ratón */
}

.ticket-details {
  /* Estilos de los detalles del ticket */
}

.logout-button {
  background-color: #ff3366;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin-top: 20px; /* Añadido espacio superior */
  cursor: pointer;
  border-radius: 5px;
}
</style>
