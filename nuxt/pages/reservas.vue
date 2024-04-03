<template>
  <div>
    <h2>Reservas:</h2>
    <ul>
      <li v-for="reservation in reservations" :key="reservation.id">
        {{ reservation }}
      </li>
      <li v-for="ticket in tickets" :key="ticket.id">
        {{ ticket }}
      </li>
    </ul>
  </div>
</template>

<script>
import { useStore } from '../stores/index'; // Asegúrate de que la ruta sea correcta

export default {
  setup() {
    const userStore = useStore();
    
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
