<template>
  <div>
    <h1>Lista de Películas</h1>
    <ul>
      <li v-for="movie in movies" :key="movie.id">
        <h2>{{ movie.title }}</h2>
        <p>{{ movie.description }}</p>
        <img :src="movie.image" alt="Movie Poster">
        <p>Fecha de lanzamiento: {{ movie.date }}</p>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data () {
    return {
      movies: []
    }
  },
  async mounted () {
    try {
      const response = await fetch('http://localhost:8000/api/movies')
      const data = await response.json()
      this.movies = data
    } catch (error) {
      console.error('Error fetching movies:', error)
    }
  }
}
</script>
<style scoped>
/* Estilos opcionales para el componente */
.movie-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
  list-style: none;
  padding: 0;
}
.movie-list li {
  margin: 1rem;
  padding: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 300px;
}
.movie-image {
  width: 100px;
  height: 200px;
}
</style>
