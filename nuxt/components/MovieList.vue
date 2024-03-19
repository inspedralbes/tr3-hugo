<template>
  <div>
    <header class="page-header">
      <h1>¡Bienvenido a CineFlix!</h1>
      <p>Descubre las mejores películas en cartelera</p>
    </header>
    <div class="carousel-container">
      <button class="carousel-btn prev" @click="prevSlide">&#10094;</button>
      <ul class="carousel-list">
        <li v-for="(movie, index) in visibleMovies" :key="movie.id" :style="{ transform: 'translateX(' + (index * slideWidth) + 'px)' }">
          <img :src="movie.image" alt="Movie Poster" class="movie-image">
          <h2>{{ movie.title }}</h2>
          <p>{{ movie.description }}</p>
          <p>Fecha de lanzamiento: {{ movie.date }}</p>
          <button class="buy-ticket-btn" @click="idcompra(movie.id)">Comprar Tickets</button>
        </li>
      </ul>
      <button class="carousel-btn next" @click="nextSlide">&#10095;</button>
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
    idcompra(movieid) {
      console.log('IDCOMPRA', movieid)
      navigateTo(`/${movieid}`)
    }
  }
}
</script>
<style scoped>
/* Estilos para el componente */
div {
  font-family: Arial, Helvetica, sans-serif;
  color: #333;
  background: #f4f4f4;
  padding: 20px;
  display: flex;
  flex-direction: column;
}
<style>
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
}

.carousel-btn.prev {
  left: 0;
}

.carousel-btn.next {
  right: 0;
}

.movie-image {
  width: 100%;
  height: auto;
  border-radius: 5px;
}

.buy-ticket-btn {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
}
</style>