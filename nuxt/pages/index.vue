<template>
  <div>
    <Header />
    <main class="main">
      <section class="hero">
        <div class="hero-content">
          <h1 class="hero-title">¡Compra tus entradas ahora!</h1>
          <p class="hero-subtitle">Descubre los últimos estrenos y asegura tu asiento desde la comodidad de tu hogar.
          </p>
          <nuxt-link to="/movies" class="btn btn-primary">Explora películas</nuxt-link>

        </div>
      </section>

      <section class="movies">
        <h2 class="section-title">Películas en Cartelera</h2>
        <MovieList :movies="movies" />

      </section>
    </main>
  </div>
</template>
<script>
// Importa el componente MovieList
import MovieList from '@/components/MovieList.vue'; // Ajusta la ruta según tu estructura

export default {
  components: {
    MovieList,
  },
  data() {
    return {
      movies: [], // Arreglo para almacenar las películas
    };
  },
  async mounted() {
    try {
      // Realiza la solicitud para obtener las películas
      const response = await fetch('http://localhost:8000/api/movies');
      const data = await response.json();
      this.movies = data; // Asigna las películas obtenidas al arreglo de datos
      console.log('Datos de películas:', this.movies);

    } catch (error) {
      console.error('Error fetching movies:', error);
    }
  },
};
</script>

<style scoped>
.hero {

  background-image: url('../public/img/8K8T7RDW.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: #e0e0e0;
  text-align: center;
  padding: 100px 0;
  align-items: center;
  justify-content: center;
  display: flex;
  top: -20px;
  position: relative;
  margin-left: -20px;

}



.main {
  padding: 20px;
}


.hero-title {
  font-size: 2.5em;
  margin-bottom: 20px;
  /* añade estilos originales */
  color: #e4e2e2;
  text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 2px;

}

.hero-subtitle {
  font-size: 1em;
  margin-bottom: 30px;
  /* añade estilos originales */
  color: #000000;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;


}

.btn-primary {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.section-title {
  font-size: 1.6em;
}

.movies {
  margin-top: 50px;
}

.movie-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

.movie {
  width: 30%;
  margin-bottom: 30px;
  text-align: center;
}

.movie img {
  width: 100%;
  height: auto;
  border-radius: 10px;
}

.movie-title {
  margin: 20px 0;
  font-size: 1.5em;
}

.movie-description {
  margin-bottom: 20px;
}

.btn-buy {
  background-color: #28a745;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  text-decoration: none;
}

.btn-buy:hover {
  background-color: #218838;
}
</style>
