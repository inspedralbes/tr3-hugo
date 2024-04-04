<template>
  <div class="background">
    <div class="login-container">
      <h2 class="login-title">Iniciar sesión</h2>
      <input v-model="loginForm.email" type="email" placeholder="Correo electrónico" required class="login-input">
      <input v-model="loginForm.password" type="password" placeholder="Contraseña" required class="login-input">
      <button type="submit" @click="submitForm()" class="login-button">Iniciar sesión</button>
      <!-- button with keyup enter -->
    </div>
  </div>
</template>

<script>
import { useStore } from '../stores/index.js';
export default {
  data() {
  return {
    loginForm: {
      email: '',
      password: ''
    }
  };
},
methods: {
    submitForm() {
      fetch(`http://localhost:8000/api/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(this.loginForm)
      })
      .then(response => {
        if (response.ok) {
          return response.json();
        } else {
          throw new Error(`Error al iniciar sesión: ${response.statusText}`);
        }
      })
      .then(data => {
        const userStore = useStore();
        userStore.setUser(data);
        // Almacenar el usuario en localStorage para persistencia
        localStorage.setItem('user', JSON.stringify(data));
        this.$router.push('/');
        console.log(data);
        console.log('Inicio de sesión exitoso');
      })
      .catch(error => {
        console.error('Error al iniciar sesión:', error);
      });
    }
  }
}
</script>
<style scoped>
.background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('https://wallpaperaccess.com/full/6400181.jpg');
  /* Cambia 'ruta/a/tu/imagen.jpg' por la ruta de tu imagen de fondo */
  background-size: cover;
  /* Ajusta la imagen para que cubra toda la pantalla */
  background-position: center;
  /* Centra la imagen */
}

.login-container {
  text-align: center;
  padding: 20px;
  background-color: #000;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
  width: 35%;
  position: relative;
  left: 29%;
  margin-top: 15%;
}

.login-title {
  color: #ff00ff;
  /* Color rosa neon */
  margin-bottom: 20px;
}

.login-input {
  width: 80%;
  padding: 10px;
  margin-bottom: 10px;
  border: 2px solid #ff00ff;
  /* Borde rosa neon */
  border-radius: 5px;
  background-color: #111;
  /* Fondo oscuro */
  color: #fff;
  /* Texto blanco */
}

.login-button {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: #ff00ff;
  /* Botón rosa neon */
  color: #000;
  /* Texto negro */
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-button:hover {
  background-color: #ff88ff;
  /* Transición a un tono más claro de rosa neon */
}
</style>