<template>
  <div class="movie-details" v-if="movie">
    <div class="movie-info">
      <h2>{{ movie.title }}</h2>
      <p>{{ movie.description }}</p>
      <img :src="movie.image" alt="Movie Poster" class="movie-image">
      <p>Fecha de lanzamiento: {{ movie.date }}</p>
      <button @click="reservar">Reservar</button>
    </div>

    <div class="seat-selection" v-if="seats.length">
      <h2>Asientos</h2>
      <div class="seats-container">
        <div
          v-for="seat in seats"
          :key="seat.id"
          @click="reservarAsiento(seat.id, seat.row, seat.column)"
          :class="{ 'occupied': seat.occupied }"
        >
          <img
            :src="seat.occupied ? '/img/ocupada.png' : '/img/disponible.png'"
            alt="Asiento"
            class="seat-image"
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movie: null,
      seats: [],
      id: null
    };
  },
  methods: {
    async fetchDataMovie() {
      try {
        const response = await fetch(`http://localhost:8000/api/movies/${this.id}`);
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        this.movie = await response.json();
      } catch (error) {
        console.error('Error fetching movie:', error);
      }
    },
    async fetchDataSeats() {
      try {
        const response = await fetch(`http://localhost:8000/api/movies/${this.id}/seats`);
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        this.seats = await response.json();
      } catch (error) {
        console.error('Error fetching seats:', error);
      }
    },
    async reservarAsiento(id, row, column) {
      try {
        console.log(`Asiento seleccionado: Fila ${row}, Columna ${column}`);
        const response = await fetch(`http://localhost:8000/api/movies/${this.id}/seats/${id}/reserve`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ id, occupied: true })
        });
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        this.fetchDataSeats();
      } catch (error) {
        console.error('Error reserving seat:', error);
      }
    },
    async reservar() {
      // Lógica para reservar una película completa
    }
  },
  async mounted() {
    this.id = this.$route.params.id;
    await this.fetchDataMovie();
    await this.fetchDataSeats();
  }
};
</script>

<style scoped>
.movie-details {
  display: flex;
  justify-content: space-between;
}

.movie-info {
  flex: 1;
  margin-right: 20px;
}

.movie-image {
  width: 200px;
  height: 300px;
  border-radius: 5px;
}

.seat-selection {
  flex: 1;
}

.seats-container {
  display: grid;
  grid-template-columns: repeat(10, 1fr);
  grid-template-rows: repeat(10, 1fr);
  gap: 5px;
}

.seats-container div {
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #ccc;
  border-radius: 3px;
  cursor: pointer;
}

.seats-container div.occupied {
  background-color: #ccc;
}

.seat-image {
  width: 30px;
  height: 30px;
}
</style>
    