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
        <div v-for="seat in seats" :key="seat.id" @click="seleccionarAsiento(seat.id, seat.row, seat.column, seat.vip)"
          :class="{ 'occupied': seat.occupied, 'selected': selectedSeats.includes(seat.id), 'vip': seat.vip }">
          <img :src="seat.occupied ? '/img/ocupada.png' : '/img/disponible.png'" alt="Asiento" class="seat-image">
          <p v-if="seat.vip">{{ vipPrice }}€</p>
          <p v-else>{{ price }}€</p>




        </div>
      </div>

      <div v-if="selectedSeats.length">
        <h3>Asientos seleccionados:</h3>
        <p>{{ selectedSeats.join(', ') }}</p>
        <p v-if="selectedSeats.length > 0">
          Precio total: {{ calcularPrecioTotal() }}€
        </p> <button class="reserve-button" @click="reservarAsientos">Reservar Asientos </button>
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
      selectedSeats: [],
      price: 6,
      vipPrice: 8
    };
  },
  methods: {
    calcularPrecioTotal() {
    let totalPrice = 0;
    for (const seatId of this.selectedSeats) {
      const seat = this.seats.find(seat => seat.id === seatId);
      if (seat) {
        totalPrice += seat.vip ? this.vipPrice : this.price;
      }
    }
    return totalPrice;
  },
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
      const seat = this.seats.find(seat => seat.id === id); // Obtener la información del asiento actual
      if (seat) {
        if (!this.selectedSeats.includes(id)) {
          this.selectedSeats.push(id);
          // Comprueba si el asiento es VIP y muestra una alerta si lo es
          if (seat.vip) {
            alert('Asiento VIP seleccionado');

          }
        } else {
          this.selectedSeats = this.selectedSeats.filter(seatId => seatId !== id);
        }
      }
    },
    async reservarAsientos() {
      try {
        const userStore = useUserStore();
        let totalPrice = 0;

        for (const seatId of this.selectedSeats) {
          const seat = this.seats.find(seat => seat.id === seatId);
          if (seat) {
            totalPrice += seat.vip ? this.vipPrice : this.price;
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
            userStore.addReservation({ seatId, movieId: this.id});
            userStore.updateTotalPrice(totalPrice);

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
  display: grid;
  justify-content: space-between;
  padding: 20px;
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(../public/img/pexels-nathan-engel-436413.jpg);
  color: white;
  background-size: cover;
  height: 100vh;
  /* grid-auto-columns: 1fr 2fr; */
  grid-template-areas: 'carta asientos';
  grid-auto-rows: 1fr;
}

.movie-info {
  margin-right: 20px;
  height: fit-content;
  background-color: #d1d1d140;
  display: flex;
  place-items: center;
  border-radius: 5px;
  flex-direction: column;
  grid-area: carta;
}

.movie-image {
  width: 200px;
  height: 300px;
  border-radius: 5px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.movie-image:hover {
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
  grid-area: asientos;
  display: flex;
  flex-direction: column;
}

.seats-container {
  display: grid;
  grid-template-columns: repeat(10, 1fr);
  /* Adjust width of columns as needed */
  grid-template-rows: repeat(10, 1fr);
  /* Adjust height of rows as needed */
  gap: 5px;
  /* Adjust gap between seats */
}


.seats-container div {
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #ccc;
  border-radius: 3px;
  cursor: pointer;
  background-color: #88c05c;
  /* Default color for available seats */
}

.seats-container div.occupied {
  background-color: #ccc;
  /* Color for occupied seats */
}

.seats-container div.selected {
  background-color: #ffa500;
  /* Color for selected seats */
}

.seat-image {
  width: 30px;
  height: 30px;
  /* Add background images or icons for different seat states */
  /* Example: background-image: url('path/to/available-icon.png'); */
}

.seats-container div.vip {
  background-color: #ffd900;
  /* Color for VIP seats */
}
</style>