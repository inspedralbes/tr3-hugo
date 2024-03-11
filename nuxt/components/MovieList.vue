<template>
    <div>
      <h1>Lista de Películas</h1>
      <ul>
        <li v-for="movie in movies" :key="movie.id">
          <h2>{{ movie.title }}</h2>
          <p>{{ movie.description }}</p>
          <img :src="movie.image" alt="Movie Poster" />
          <p> Fecha de lanzamiento: {{ movie.date }}</p>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      movies: {
        type: Array,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos opcionales para el componente */
  </style>
  