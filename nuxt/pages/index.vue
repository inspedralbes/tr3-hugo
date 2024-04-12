<template>
  <div>
    <Header />
    <main class="main">
      <section class="hero">
        <div class="hero-content">
          <h1 class="hero-title">¡Compra tus entradas ahora!</h1>
          <p class="hero-subtitle">Descubre los últimos estrenos y asegura tu asiento desde la comodidad de tu hogar.</p>
          <nuxt-link to="/movies" class="btn btn-primary">Explora películas</nuxt-link>
        </div>
      </section>

      <section class="movies">
        <h2 class="section-title">Películas en Cartelera</h2>
        <div class="movie-list">
          <div class="movie-item" v-for="(movie, index) in movies.slice(0, 4)" :key="movie.id">
            <img :src="movie.image" :alt="movie.title" class="movie-image" />
            <p class="movie-title">{{ movie.title }}</p>
          </div>
        </div>
        <div class="more-movies">
          <img src="https://media.tenor.com/2-fFcDedfCAAAAAi/arrow-point.gif" alt="Ver más películas" class="more-movies-gif" />
          <nuxt-link to="/movies" class="more-movies-link">Ver más películas</nuxt-link>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movies: [],
    };
  },
  mounted() {
    this.fetchMovies();
  },
  methods: {
    async fetchMovies() {
      try {
        const response = await fetch('http://tr3a22hugtrigon.daw.inspedralbes.cat/back/laravel/public/api/movies');
        if (!response.ok) {
          throw new Error('Failed to fetch movies');
        }
        const data = await response.json();
        this.movies = data;
      } catch (error) {
        console.error('Error fetching movies:', error);
      }
    },
  },
};
</script>

<style scoped>
.main {
  padding: 0px;
  background-color: #e1eaf3;
  min-height: 100vh;
  
}

.hero {
  background-image: url('../public/img/8K8T7RDW.jpg');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  color: #e0e0e0;
  text-align: center;
  padding: 100px 0;
}

.hero-content {
  max-width: 800px;
  margin: 0 auto;
}

.hero-title {
  font-size: 2.5em;
  margin-bottom: 20px;
  color: #e4e2e2;
  text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.hero-subtitle {
  font-size: 1em;
  margin-bottom: 30px;
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
  margin-bottom: 20px;
  text-align: center;
}

.movie-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.movie-item {
  margin: 10px;
  text-align: center;
}

.movie-image {
  width: 200px;
  height: 300px;
  object-fit: cover;
  border-radius: 10px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.movie-title {
  font-size: 1.2em;
  margin-top: 10px;
  font-weight: bold;
}
.more-movies {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  margin-top: 20px;
}

.more-movies-gif {
  width: 100px; /* Ajusta el tamaño según sea necesario */
  height: auto;
}

.more-movies-link {
  margin-left: 10px;
  font-weight: bold;
  text-decoration: none;
  color: #007bff; /* Puedes cambiar el color según tu preferencia */
}

.more-movies-link:hover {
  color: #0056b3; /* Cambia el color al pasar el mouse */
}
</style>
