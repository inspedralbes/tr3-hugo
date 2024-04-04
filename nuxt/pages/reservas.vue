<template>
  <div>
    <!-- Título que se mostrará solo una vez -->
    <div class="card">
      <div class="card-header">
        <h2>Tickets Comprados:</h2>
      </div>
      <div class="card-body">
        <ul class="ticket-list">
          <li v-for="(ticket, index) in tickets" :key="ticket.id" class="ticket-item">
            <!-- Mostrar título de la película solo si es diferente al ticket anterior -->
            <h3 v-if="index === 0 || ticket.movie !== tickets[index - 1].movie">{{ ticket.movie }}</h3>
            <div class="movie-info">
              <p>Fecha: {{ ticket.date }}</p>
              <p>Asiento: {{ ticket.seat }}</p>
              <p>Fila: {{ ticket.row }}</p>
              <p>Precio: {{ ticket.price }}€</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import { useStore } from '../stores/index.js';

export default {
  setup() {
    const userStore = useStore();

    return {
      tickets: userStore.tickets
    };
  }
};
</script>

<style scoped>
/* Estilos para las compras */
.ticket-list {
  list-style: none;
  padding: 0;
}

.ticket-card {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin-bottom: 20px;
  overflow: hidden;
}

.ticket-content {
  display: flex;
  padding: 20px;
}

.movie-info {
  flex: 1;
}

.movie-info h3 {
  margin-top: 0;
  margin-bottom: 10px;
  font-size: 1.2em;
}

.seat-info {
  flex: 1;
  text-align: right;
}

.seat-info p {
  margin: 0;
}
.card {

  width: 300px;
  border-radius: 10px;
  margin: 50px;
  background: #f6f2d7;
  overflow: hidden;
}
.card-header {
  height: 70px;
  border: 2px solid #836602;
  border-bottom: 2px dotted #836602;
  border-radius: 10px 10px 0 0;
  position: relative;
}
.card-header:before, .card-header:after {
  content: '';
  position: absolute;
  width: 24px;
  height: 24px;
  background: #fff;
  border-radius: 100%;
  bottom: -12px;
  border: 2px solid #836602;
  box-sizing: border-box;
}
.card-header:before { 
  left: -13px;
}
.card-header:after {
  right: -13px;
}
.card-body {
  height: 200px;
  border: 2px solid #836602;
  border-top: none;
  border-radius: 0 0 10px 10px;
  height: fit-content
}

</style>
