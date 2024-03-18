<template>
  <div class="movie-details" v-if="movie">
    <div class="movie-info">
      <h2>{{ movie.title }}</h2>
      <p>{{ movie.description }}</p>
      <img :src="movie.image" alt="Movie Poster" class="movie-image">
      <p>Fecha de lanzamiento: {{ movie.date }}</p>
      <button class="reserve-button" @click="reservar">Reservar</button>
    </div>

    <div class="seat-selection" v-if="seats.length">
      <h2>Asientos</h2>
      <div class="seats-container">
  <div v-for="seat in seats" :key="seat.id" @click="seleccionarAsiento(seat.id, seat.row, seat.column)"
    :class="{ 'occupied': seat.occupied, 'selected': selectedSeats.includes(seat.id) }">
    <!-- Use appropriate image or icon for seat representation -->
    <img :src="seat.occupied ? '/img/ocupada.png' : '/img/disponible.png'" alt="Asiento" class="seat-image">
  </div>
</div>

      <div v-if="selectedSeats.length">
        <h3>Asientos seleccionados:</h3>
        <p>{{ selectedSeats.join(', ') }}</p>
        <button class="reserve-button" @click="reservarAsientos">Reservar Asientos</button>
      </div>
    </div>

  </div>
</template>
<script>
//import useUserStore from '../store/User';
import { useUserStore } from '../store/User';
export default {
  data() {
    return {
      movie: null,
      seats: [],
      id: null,
      selectedSeats: []
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
    async seleccionarAsiento(id, row, column) {
      console.log(`Asiento seleccionado: Fila ${row}, Columna ${column}`);
      if (!this.selectedSeats.includes(id)) {
        this.selectedSeats.push(id);
      } else {
        this.selectedSeats = this.selectedSeats.filter(seatId => seatId !== id);
      }
    },
    async reservarAsientos() {
      try {      
        const userStore = useUserStore();

        for (const seatId of this.selectedSeats) {
          const seat = this.seats.find(seat => seat.id === seatId);
          if (seat) {
            const response = await fetch(`http://localhost:8000/api/movies/${this.id}/seats/${seatId}/reserve`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({ id: seatId, occupied: true })
              
            });
            if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
            }
            userStore.addReservation({ seatId, movieId: this.id });

          }
        }
        this.fetchDataSeats();
        this.selectedSeats = []; // Limpiar los asientos seleccionados después de la reserva exitosa
      } catch (error) {
        console.error('Error reserving seats:', error);
      }
    },
   
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
  padding: 20px;
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.pexels.com/photos/375885/pexels-photo-375885.jpeg?cs=srgb&dl=pexels-clem-onojeghuo-375885.jpg&fm=jpg');
  color: white;
  background-size: cover;
  height: 100vh;
}

.movie-info {
  flex: 1.5;
  margin-right: 20px;
  height: fit-content;
  background-color: #d1d1d140;
}

.movie-image {
  width: 200px;
  height: 300px;
  border-radius: 5px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}
.movie-image:hover{
  transform: scale3d(1.5, 1.5, 1.5);
  transition: transform 0.5s;

}
.reserve-button {
  background-color: #ff3366;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px;
}

.seat-selection {
  flex: 1;
  background-color: #483d8b87;
    height: fit-content;
}
.seats-container {
  display: grid;
  grid-template-columns: repeat(10, 1fr); /* Adjust width of columns as needed */
  grid-template-rows: repeat(10, 1fr); /* Adjust height of rows as needed */
  gap: 5px; /* Adjust gap between seats */
}


.seats-container div {
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #ccc;
  border-radius: 3px;
  cursor: pointer;
  background-color: #88c05c; /* Default color for available seats */
}

.seats-container div.occupied {
  background-color: #ccc; /* Color for occupied seats */
}

.seats-container div.selected {
  background-color: #ffa500; /* Color for selected seats */
}

.seat-image {
  width: 30px;
  height: 30px;
  /* Add background images or icons for different seat states */
  /* Example: background-image: url('path/to/available-icon.png'); */
}

</style>