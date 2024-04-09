<template>
  <div>
    <MovieList :movies="movies" />
  </div>
</template>

<script>
import MovieList from '@/components/MovieList.vue'; // Ajusta la ruta según tu estructura
export default {
  components: {
    MovieList,
  },
  data() {
    return {
      movies: [],
    };
  },
  async mounted() {
    try {
      const response = await fetch('http://localhost:8000/api/movies');
      const data = await response.json();
      this.movies = data;
      console.log('Datos de películas:', this.movies);

    } catch (error) {
      console.error('Error fetching movies:', error);
    }
  },
};
</script>

<style>
/* Estilos para el componente */
</style>
