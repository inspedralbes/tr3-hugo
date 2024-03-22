<template>
    <div>
      <h2>Reservas:</h2>
      <ul>
        <li v-for="reservation in reservations" :key="reservation.id">
          {{ reservation }}
        </li>
        <!-- v-if tickets -->
     <li v-for="ticket in tickets" :key="ticket.id">
          {{ ticket }}
        </li> 


      </ul>
    </div>
  </template>
  
  <script>
  import { useUserStore } from '../store/User';
  
  export default {
    setup() {
      const userStore = useUserStore();
      
      return {
        reservations: userStore.reservations,
        tickets: userStore.tickets

      };
    }
  };
  </script>
  
  <style scoped>
  /* Estilos para las reservas */
  </style>
  