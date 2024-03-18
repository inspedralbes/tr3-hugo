<template>
  <div>
    <h1>Lista de Películas</h1>
    <ul>
      <li v-for="movie in movies" :key="movie.id">
        <img :src="movie.image" alt="Movie Poster" class="movie-image">
        <h2>{{ movie.title }}</h2>
        <p>{{ movie.description }}</p>
        <p>Fecha de lanzamiento: {{ movie.date }}</p>
        <button class="buy-ticket-btn" @click="idcompra(movie.id)">Comprar Tickets</button>

      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movies: []
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
  color: #ddd;
  background: radial-gradient(#252525, #181818, #212121);
  padding: 20px;
  display: flex;
  flex-direction: column;


}

h1 {
  font-size: 2em;
  margin-bottom: 20px;
  color: #444;
}

ul {
  list-style: none;
  padding: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

li {
  margin: 1rem;
  padding: 1rem;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 350px;
  background-color: #fff;
  box-shadow: 0 0 10px rgba(247, 3, 3, 0.1);
  transition: transform 0.2s ease-in-out;
  border: 1px solid rgb(245, 141, 5);
  box-shadow: 0 0 2px #e97101;
  background: linear-gradient(45deg, #111, #252525, #111, #252525);

}

li:hover {
  transform: scale(1.05);
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
}

h2 {
  font-size: 1.5em;
  margin-bottom: 10px;
  color: #555;
}

p {
  color: #777;
  margin-bottom: 10px;
}

.movie-image {
  width: 275px;
  height: 350px;
  margin-bottom: 10px;
  left: 11%;
position: relative;
  box-shadow: 0 0 11px 5px #e97101;  
  background-size: contain;
  background-color: tomato;
  border-radius: 8px;
}

.buy-ticket-btn {
  background-color: #ff6347;
  /* Color de fondo */
  color: white;
  /* Color del texto */
  padding: 15px 25px;
  /* Espaciado interno */
  font-size: 1em;
  /* Tamaño del texto */
  border: none;
  /* Sin borde */
  border-radius: 5px;
  /* Bordes redondeados */
  cursor: pointer;
  /* Cambiar cursor al pasar el ratón */
  transition: background-color 0.3s ease-in-out;
  /* Transición de color al pasar el ratón */
}

/* Cambia el color al pasar el ratón */
.buy-ticket-btn:hover {
  background-color: #ff4500;
  /* Nuevo color de fondo al pasar el ratón */
}
</style>
