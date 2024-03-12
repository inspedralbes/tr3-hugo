<template>
  <div>
    <h2>Sala de Butacas</h2>
    <div>
      <Seat
        v-for="(seatStatus, index) in seatStatusList"
        :key="index"
        :seatStatus="seatStatus"
        @toggleSeatStatus="toggleSeatStatus(index)"
      />
    </div>
  </div>
</template>

<script>
import Seat from '~/components/Seat.vue';

export default {
  components: {
    Seat,
  },
  data() {
    return {
      seatStatusList: Array(20).fill(false), // Inicialmente, todas las butacas están disponibles
    };
  },
  methods: {
    toggleSeatStatus(index) {
      this.$set(this.seatStatusList, index, !this.seatStatusList[index]);
    },
  },
};
</script>

<style scoped>
/* Agrega aquí tus reglas de estilo si es necesario */
</style>
