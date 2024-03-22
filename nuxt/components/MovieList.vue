<template>
  <div class="body">
    <header class="page-header">
      <h1>¡Bienvenido a CineFlix!</h1>
      <p>Descubre las mejores películas en cartelera</p>
    </header>
    <div class="carousel-container">
      <button class="carousel-btn prev" @click="prevSlide" :disabled="currentIndex === 0">❮</button>
      <ul class="carousel-list">
        <li v-for="(movie, index) in visibleMovies" :key="movie.id"
          :style="{ transform: 'translateX(' + (index * slideWidth) + 'px)' }">
          <div class="movie-card">
            <img :src="movie.image" alt="Cartel de la película {{ movie.title }}" class="movie-image">
            <div class="movie-details">
              <h2>{{ movie.title }}</h2>
              <p class="description">{{ movie.description }}</p>
              <p><strong>Fecha de lanzamiento:</strong> {{ movie.date }}</p>
              <button class="buy-ticket-btn" @click="buyTicket(movie.id)">Comprar Tickets</button>
            </div>
          </div>
        </li>
      </ul>
      <button class="carousel-btn next" @click="nextSlide"
        :disabled="currentIndex >= movies.length - numVisibleSlides">❯</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movies: [],
      currentIndex: 0,
      slideWidth: 300,
      numVisibleSlides: 3
    }
  },
  computed: {
    visibleMovies() {
      const endIndex = this.currentIndex + this.numVisibleSlides;
      return this.movies.slice(this.currentIndex, endIndex);
    }
  },
  async mounted() {
    try {
      const response = await fetch('http://localhost:8000/api/movies')
      const data = await response.json()
      this.movies = data
    } catch (error) {
      console.error('Error fetching movies:', error)
    }
  },
  methods: {
    prevSlide() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      }
    },
    nextSlide() {
      const maxIndex = this.movies.length - this.numVisibleSlides;
      if (this.currentIndex < maxIndex) {
        this.currentIndex++;
      }
    },
    buyTicket(movieId) {
      console.log('ID de la película:', movieId);
      // Aquí puedes agregar la lógica para comprar tickets
      // Por ejemplo, redirigir a la página de compra de tickets
       navigateTo(`/${movieId}`);
    }
  }
}
</script>

<style scoped>
/* Estilos para el componente */
.body {
  font-family: Arial, Helvetica, sans-serif;
  color: #333;
  padding: 20px;
  display: flex;
  flex-direction: column;
  background-color: #accdec;
}
div {
  font-family: Arial, Helvetica, sans-serif;
  color: #333;
  padding: 20px;
  display: flex;
  flex-direction: column;
}

.carousel-container {
  position: relative;
  overflow: hidden;

}

.carousel-list {
  display: flex;
  list-style-type: none;
  padding: 0;
  margin: 0;
  transition: transform 0.5s ease;
}

.carousel-btn {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  border: none;
  cursor: pointer;
  padding: 10px;
  z-index: 2;
  transition: background-color 0.3s ease;
}

.carousel-btn.prev {
  left: 0;
}

.carousel-btn.next {
  right: 0;
}

.carousel-btn:disabled {
  background-color: rgba(0, 0, 0, 0.2);
  cursor: not-allowed;
}

.movie-image {
  border-radius: 5px;
    height: 466px;
    width: 362px;

}

.movie-details {
  padding: 10px;
}

.buy-ticket-btn {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
}
.movie-card {
  display: flex;
    padding: 10px;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    width: 372px;
    align-items: center;
}
</style>
