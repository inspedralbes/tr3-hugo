<template>
    <div>
      <h2>Tickets Comprados:</h2>
      <ul class="ticket-list">
        <li v-for="ticket in tickets" :key="ticket.id" class="ticket-card">
          <div class="ticket-content">
            <div class="movie-info">
              <h3>{{ ticket.movie }}</h3>
              <p>Fecha: {{ ticket.date }}</p>
            </div>
            <div class="seat-info">
              <p>Asiento: {{ ticket.seat }}</p>
              <p>Fila: {{ ticket.row }}</p>
              <p>Precio: {{ ticket.price }}€</p>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import { useStore } from '../stores/index.js';
  
  export default {
    setup() {
      const userStore = useStore();
  
      return {
        tickets: userStore.tickets.map(ticket => ({
          id: ticket.id,
          movie: ticket.movie, // Asegúrate de que esta propiedad exista en el objeto ticket
          date: ticket.date,
          seat: ticket.seat,
          row: ticket.row,
          price: ticket.price
        }))
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
  
  </style>
  