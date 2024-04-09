<template>
    <main class="main">
      <section class="hero">
        <div class="hero-content">
          <h1 class="hero-title">¡Compra tus entradas ahora!</h1>
          <p class="hero-subtitle">Descubre los últimos estrenos y asegura tu asiento desde la comodidad de tu hogar.</p>
          <nuxt-link to="/movies" class="btn btn-primary">Explora películas</nuxt-link>

        </div>
      </section>

      <!-- Películas en Cartelera -->
      <section class="movies">
        <h2 class="section-title">Películas en Cartelera</h2>
        <div class="movie-list">
          <!-- Aquí se generaría dinámicamente la lista de películas -->
          <div class="movie">
            <img src="../public/img/BZL3LJQN.jpg" alt="Película 1">
            <h3 class="movie-title">Título de la Película</h3>
            <p class="movie-description">Breve descripción de la película.</p>
            <a href="#" class="btn btn-buy">Comprar Entradas</a>
          </div>
          <!-- Repetir para cada película -->
        </div>
      </section>

    </main>
</template>

<script>

export default {

}
</script>

<style>


.hero {
  /* add this background-image: https://shotdeck.com/assets/images/stills/thumb/small_BZL3LJQN.jpg; */
  
  background-image: url('../public/img/8K8T7RDW.jpg'); /* Ruta de tu nueva imagen de fondo */
  background-size: cover; /* Ajusta el tamaño del fondo para cubrir toda la sección */
  background-position: center; /* Ajusta la posición del fondo */
  background-repeat: no-repeat; /* Evita que el fondo se repita */
    color: #e0e0e0;
    text-align: center;
    padding: 100px 0;
    align-items: center;
    justify-content: center;
    display: flex;
  }



.main {
  padding: 20px;
}

.hero {
  background-color: #f8f9fa;
    color: #d4cece;
    text-align: center;
    padding: 100px 0;
    margin-left: -20px;
    top: -20px;
    position: relative;
    margin-right: -20px;
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
