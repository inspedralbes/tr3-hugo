<template>
  <div class="ticket-sales">
    <!-- Cabecera -->
    <!-- add favicon -->

    <header class="header">
      <div class="logo">
        <img src="../public/img/8K8T7RDW.jpg" alt="Logo">
      </div>
      <nav class="navigation">
        <ul>
          <li><a href="#">Inicio</a></li>
          <li><a href="#">Películas</a></li>
          <li><a href="#">Próximos Estrenos</a></li>
          <li><a href="#">Ofertas</a></li>
          <li><a href="#">Contacto</a></li>
        </ul>
      </nav>
      <div class="user-actions">
        <a href="/Login" class="btn btn-login">Iniciar sesión</a>
        <a href="/Register" class="btn btn-register">Registrarse</a>
      </div>
    </header>
   <!-- Hero -->
    <main class="main">
      <section class="hero">
        <div class="hero-content">
          <h1 class="hero-title">¡Compra tus entradas ahora!</h1>
          <p class="hero-subtitle">Descubre los últimos estrenos y asegura tu asiento desde la comodidad de tu hogar.</p>
          <a href="/movies" class="btn btn-primary">Explora películas</a>
        </div>
      </section>

      <!-- Películas en Cartelera -->
      <section class="movies">
        <h2 class="section-title">Películas en Cartelera</h2>
        <div class="movie-list">
          <!-- Aquí se generaría dinámicamente la lista de películas -->
          <div class="movie">
            <img src="../public/img/portada.jpg" alt="Película 1">
            <h3 class="movie-title">Título de la Película</h3>
            <p class="movie-description">Breve descripción de la película.</p>
            <a href="#" class="btn btn-buy">Comprar Entradas</a>
          </div>
          <!-- Repetir para cada película -->
        </div>
      </section>
    </main>

    <!-- Pie de Página -->
    <footer class="footer">
      <p>&copy; 2024 Cine Online. Todos los derechos reservados.</p>
    </footer>
  </div>
</template>

<script>
export default {
  // Aquí puedes añadir cualquier lógica necesaria para tu página de venta de entradas de cine
}
</script>

<style scoped>
/* Estilos generales */
.ticket-sales {
  font-family: 'Arial', sans-serif;
}
.hero-content{
  padding: 12px;
  border-radius: 10px;
  width: 65%;
  position: relative;
  max-width: 600px; 
}
.hero {
  /* add this background-image: https://shotdeck.com/assets/images/stills/thumb/small_BZL3LJQN.jpg; */
  
  background-image: url('/img/8K8T7RDW.jpg'); /* Ruta de tu nueva imagen de fondo */
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

.header {
  background-color: #1b1b1b;
  color: #fff;
  padding: 20px 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.logo img {
  width: 150px;
  height: auto;
}

.navigation ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.navigation ul li {
  display: inline;
  margin-right: 20px;
}

.navigation ul li a {
  text-decoration: none;
  color: #fff;
  font-weight: bold;
}

.user-actions .btn {
  text-decoration: none;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  margin-left: 20px;
}

.btn-login {
  background-color: #007bff;
}

.btn-register {
  background-color: #28a745;
}

.main {
  padding: 20px;
}

.hero {
  background-color: #f8f9fa;
  color: #d4cece;
  text-align: center;
  padding: 100px 0;
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
  font-size: 2em;
  margin-bottom: 20px;
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

.footer {
  background-color: #1b1b1b;
  color: #fff;
  text-align: center;
  padding: 20px 0;
}
</style>
