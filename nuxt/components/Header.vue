<template>
  <div>
    <!-- Header -->
    <header class="header">  

      <div class="logo">
        <img src="https://cdn-icons-png.flaticon.com/256/4183/4183802.png" alt="Logo" />
      </div>
      <nav class="navigation">
        <ul>
          <!-- nombre de la pagina CineMa -->
          <li>
            <nuxt-link to="/" class="nav-link">Inicio</nuxt-link>
          </li>
          <li>
            <nuxt-link to="/movies" class="nav-link">Películas</nuxt-link>
          </li>
          <li>
            <nuxt-link to="/perfil" class="nav-link">Perfil</nuxt-link>
          </li>
        </ul>
      </nav>
      <div class="user-actions">
        <nuxt-link to="/login" class="btn btn-login">Iniciar sesión</nuxt-link>
        <nuxt-link to="/register" class="btn btn-register">Registrarse</nuxt-link>
      </div>
    </header>

  </div>
</template>

<style scoped>
.header {
  background-color: #1b1b1b;
  color: #fff;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed;
  top: 0;
  z-index: 1000;
  width: 100%;
  left: 0px;
}

.logo img {
  width: 70px;
  height: auto;
}

.navigation ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.navigation ul li {
  display: inline;
}

.navigation ul li .nav-link {
  text-decoration: none;
  color: #fff;
  font-weight: bold;
  font-size: 16px;
  padding: 10px 20px;
}

.user-actions .btn {
  text-decoration: none;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
}

.btn-login {
  background-color: #007bff;
  margin-left: 20px;
}

.btn-register {
  background-color: #28a745;
}
</style>
