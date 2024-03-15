<template>
  <div>
    <div class="login-register-buttons">
      <nuxt-link to="/Login" class="login-btn">
        <img src="login_icon.png" alt="Login">
      </nuxt-link>
      <nuxt-link to="/Register" class="register-btn">
        <img src="register_icon.png" alt="Register">
      </nuxt-link>
    </div>
  </div>
  <div class="landing">
    <section class="hero">
      <h1 class="hero-title">¡Bienvenido a nuestro Cine!</h1>
      <p class="hero-subtitle">Descubre las últimas películas y compra tus entradas ahora</p>
      <nuxt-link to="/movies" class="cta btn-primary">Comprar entradas</nuxt-link>
    </section>
    <section class="features">
      <div class="feature">
        <div class="feature-icon">
          <i class="fas fa-film"></i>
        </div>
        <h2>Amplia Selección de Películas</h2>
        <p>Explora nuestra amplia gama de películas para todos los gustos. Desde emocionantes aventuras hasta conmovedores dramas.</p>
      </div>
      <div class="feature">
        <div class="feature-icon">
          <i class="fas fa-ticket-alt"></i>
        </div>
        <h2>Compra Fácil de Entradas</h2>
        <p>Adquiere tus entradas de forma rápida y segura desde nuestra plataforma. ¡Sin colas ni complicaciones!</p>
      </div>
      <div class="feature">
        <div class="feature-icon">
          <i class="fas fa-headset"></i>
        </div>
        <h2>Excelente Servicio al Cliente</h2>
        <p>Estamos aquí para ayudarte con cualquier pregunta o problema que puedas tener. Nuestro equipo está comprometido con tu satisfacción.</p>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  // Aquí puedes añadir cualquier lógica necesaria para tu landing page
}
</script>

<style scoped>
.landing {
  text-align: center;
}

.hero {
  padding: 100px 0;
  background-image: url('https://t4.ftcdn.net/jpg/04/41/71/47/360_F_441714717_25NQrjVZaao3XejzZzVWbj9eq8zuFZyF.jpg'); /* Ruta de tu imagen de fondo */
  background-size: cover;
  background-position: center;
  color: #fff; /* Ajusta el color del texto según tu imagen de fondo */
  font-family: 'Arial', sans-serif; /* Fuentes alternativas */
}

.hero-title {
  font-size: 3em;
  margin-bottom: 20px;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Sombra de texto */
}

.hero-subtitle {
  font-size: 1.5em;
  color: #555;
  margin-bottom: 30px;
}

.cta {
  display: inline-block;
  margin-top: 20px;
  padding: 15px 30px;
  font-size: 1.2em;
  background-color: #ff6347; /* Rojo */
  color: white;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.cta:hover {
  background-color: #ff4500; /* Rojo oscuro */
}

.features {
  display: flex;
  justify-content: space-around;
  align-items: flex-start;
  flex-wrap: wrap;
  padding: 50px 0;
}

.feature {
  width: 30%;
  margin-bottom: 30px;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s;
  background-color: #f8f9fa; /* Gris claro */
}

.feature:hover {
  transform: translateY(-5px);
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
}

.feature-icon {
  font-size: 3em;
  margin-bottom: 20px;
  color: #ff6347; /* Rojo */
}

.feature h2 {
  font-size: 1.8em;
  margin-bottom: 15px;
  color: #333;
}

.feature p {
  font-size: 1.1em;
  color: #555;
}
</style>
