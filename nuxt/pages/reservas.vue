<template>
  <div class="background">
  <div class="ticket-container">
    <div class="card">
      <div class="card-body">
        <!-- Título que se mostrará solo una vez -->
        <h2>Tus Compras de Asientos</h2>

        <!-- Iterar sobre los tickets -->
        <div v-for="(ticket, index) in tickets" :key="ticket.id">
          <div class="ticket-card">
            <div class="ticket-header">
              <!-- Mostrar título de la película solo si es diferente al ticket anterior -->
              <h3 v-if="index === 0 || ticket.movie !== tickets[index - 1].movie">{{ ticket.movie }}</h3>
            </div>
            <div class="ticket-content">
              <div class="movie-info">
                <p>Fecha: {{ ticket.date }}</p>
                <p>Asiento: {{ ticket.seat }}</p>
                <p>Fila: {{ ticket.row }}</p>
                <p>Columna: {{ ticket.column }}</p>
              </div>
              <div class="seat-info">
                <!-- Mostrar precio total -->
                <h3>Total: {{ totalPrice }}€</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import { useStore } from '../stores/index.js';

export default {
  setup() {
    const userStore = useStore();
    userStore.saveTotalPrice();
    userStore.saveReservations();

    return {
      tickets: userStore.tickets,
      totalPrice: userStore.totalPrice,
      reservas: userStore.reservas
    };
  }
};
</script>

<style scoped>

/* fondo de pantalla estilo cinema */
.background {
  background-image: url(/_nuxt/public/img/ticket.jpg);
    background-size: cover;
    background-position: center;
    font-family: 'Roboto', sans-serif;
    margin: 0;
    height: 100vh;
}
.ticket-container {
  display: flex;
  justify-content: center;
}

.card {
  width: 80%;
  max-width: 800px;
  border-radius: 10px;
  margin-top: 50px;
  background: #a89ca4;
  overflow: hidden;
}

.card-body {
  padding: 20px;
}

.ticket-card {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  overflow: hidden;
}

.ticket-header {
  padding: 15px 20px;
}

.ticket-content {
  display: flex;
  padding: 20px;
}

.movie-info {
  flex: 1;
}

.movie-info p {
  margin: 5px 0;
}

.seat-info {
  flex: 1;
  text-align: right;
}

.seat-info h3 {
  margin: 0;
}

@media (max-width: 768px) {
  .card {
    width: 95%;
  }
}
</style>
