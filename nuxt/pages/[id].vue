<template>
  <!-- header component -->
  <Header />
  <div class="movie-details" v-if="movie">
    <div class="movie-info">
      <h2>{{ movie.title }}</h2>
      <img :src="movie.image" alt="Movie Poster" class="movie-image">
      <p>Fecha de lanzamiento: {{ movie.date }}</p>
      <p>{{ movie.description }}</p>
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
import { useStore } from '../stores/index'; // Asegúrate de que la ruta sea correcta
export default {
  data() {
    return {
      movie: null,
      seats: [],
      id: null,
      selectedSeats: [],
      price: 6,
      vipPrice: 8,
      isAuth: false
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
        const response = await fetch(`http://tr3a22hugtrigon.daw.inspedralbes.cat/back/laravel/public/api/movies/${this.id}`);
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
        const response = await fetch(`http://tr3a22hugtrigon.daw.inspedralbes.cat/back/laravel/public/api/movies/${this.id}/seats`);
        if (!response.ok) {
          throw new Error(`HTTP error! Status: ${response.status}`);
        }
        this.seats = await response.json();
      } catch (error) {
        console.error('Error fetching seats:', error);
      }
    },
    async seleccionarAsiento(id, row, column) {
      const seat = this.seats.find(seat => seat.id === id);
      if (seat && !seat.occupied) { // Verificar si el asiento está ocupado
        if (!this.selectedSeats.includes(id)) {
          this.selectedSeats.push(id);
          console.log('Asiento seleccionado:', id, row, column);
          if (seat.vip) {
            alert('Asiento VIP seleccionado');
          }
        } else {
          this.selectedSeats = this.selectedSeats.filter(seatId => seatId !== id);
        }
      } else {
        alert('Este asiento ya está ocupado. Por favor, selecciona otro.');
      }

    },
    async reservarAsientos() {
      const userStore = useStore();

      // Verificar si el usuario está autenticado
      if (!userStore.user) {
        alert('Debes iniciar sesión para reservar asientos.');
        // Redirigir a la página de inicio de sesión
        //ir a /login
        navigateTo('/login');
        return;
      }

      try {
        let totalPrice = 0;

        for (const seatId of this.selectedSeats) {
          const seat = this.seats.find(seat => seat.id === seatId);
          if (seat) {
            totalPrice += seat.vip ? this.vipPrice : this.price;
            const response = await fetch(`http://tr3a22hugtrigon.daw.inspedralbes.cat/back/laravel/public/api/tickets`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                movie_id: this.id,
                user_id: userStore.user.id,
                total_seats: this.selectedSeats.length,
                seat_id: seatId,
                price_per_seat: seat.vip ? this.vipPrice : this.price
              })
            });
            if (!response.ok) {
              throw new Error(`HTTP error! Status: ${response.status}`);
            }
            // Agregar el asiento reservado al store
            userStore.addReservation(seat);
            userStore.updateTotalPrice(totalPrice);
            //asiento ocupado, cambiar imagen si esta reservado
            seat.occupied = true;


            // Agregar un ticket con el título de la película y el ID del asiento
            userStore.addTicket({ movie: this.movie.title, seat: seatId, row: seat.row });
            await fetch(`http://tr3a22hugtrigon.daw.inspedralbes.cat/back/laravel/public/api/movies/${this.id}/seats/${seatId}/reserve`, {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({ id: seatId, occupied: true })
            });
          }
        }
        this.fetchDataSeats();
        this.selectedSeats = []; // Limpiar los asientos seleccionados después de la reserva exitosa
        navigateTo('/reservas');
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
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(../public/img/F5CV2K4Y.jpg);
  color: white;
  background-size: cover;
  height: 100vh;
  /* grid-auto-columns: 1fr 2fr; */
  grid-template-areas: 'carta asientos';
  grid-auto-rows: 1fr;
  margin-top:-6px;
}

.movie-info {
  margin-right: 20px;
  height: -moz-fit-content;
  height: 82%;
  background-color: #d1d1d140;
  display: flex;
  place-items: center;
  border-radius: 5px;
  flex-direction: column;
  grid-area: carta;
  width: 610px;
}

.movie-image {
  width: 394px;
  height: 553px;
  border-radius: 5px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
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
  /* disabe */
  cursor: not-allowed;


}

.seats-container div:hover {
  background-color: #00ff00;
  /* Color for available seats on hover */
}

.seats-container div.occupied:hover {
  background-color: #ff0000;
  /* Color for occupied seats on hover */
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