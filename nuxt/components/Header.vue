<!-- Component Navheader -->
<template>
  <div>
    <header class="header">
      <nav class="navigation">
        <ul>
          <li><a href="#">Inicio</a></li>
          <li><a href="#">Películas</a></li>
          <li><a href="#">Ofertas</a></li>
          <li><a href="#">Contacto</a></li>
        </ul>
      </nav>
      
    </header>
  </div>
</template>

<script>

</script>

<style scoped>
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
  font-size: x-large;
  padding: 28px;
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
</style>