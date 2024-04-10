<template>
    <div class="background">
      <div class="register-container">
        <h2 class="register-title">Registrarse</h2>
        <input v-model="registerForm.name" type="text" placeholder="Nombre" required class="register-input">
        <input v-model="registerForm.email" type="email" placeholder="Correo electrónico" required class="register-input">
        <input v-model="registerForm.password" type="password" placeholder="Contraseña" required class="register-input">
        <button type="submit" @click="submitForm()" class="register-button">Register</button>
        <p class="error-message" v-if="errorMessage">{{ errorMessage }}</p>
        <p>¿Ya tienes una cuenta? <router-link to="/login" class="login-link">Iniciar sesión</router-link></p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        registerForm: {
          name: '',
          email: '',
          password: ''
        },
        errorMessage: ''
      };
    },
    methods: {
      async submitForm() {
        try {
          const response = await fetch(`http://localhost:8000/api/register`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(this.registerForm)
          });
  
          if (response.ok) {
            const data = await response.json();
            console.log(data);
            console.log('Registro exitoso');
            // Redireccionar a la página de inicio de sesión después del registro exitoso
            this.$router.push('/login');
          } else {
            const errorData = await response.json();
            this.errorMessage = errorData.message || 'Error al registrar. Inténtelo de nuevo más tarde.';
          }
        } catch (error) {
          console.error('Error al iniciar sesión:', error);
          this.errorMessage = 'Error al registrar. Inténtelo de nuevo más tarde.';
        }
      }
    }
  }
  </script>
  
  <style scoped>
  /* Estilos de fondo y contenedor */
  .background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
     background-image: url('https://wallpaperaccess.com/full/6400181.jpg');
    background-size: cover;
    background-position: center;
  }
  
  .register-container {
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
  
  /* Estilos de texto y enlaces */
  .register-title {
    color: #ff00ff;
    margin-bottom: 20px;
  }
  
  .register-input {
    width: 84%;
    padding: 10px;
    margin-bottom: 10px;
    border: 2px solid #ff00ff;
    border-radius: 5px;
    background-color: #111;
    color: #fff;
  }
  
  .register-button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #ff00ff;
    color: #000;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .register-button:hover {
    background-color: #ff88ff;
  }
  
  .login-link {
    color: #ff00ff;
    text-decoration: underline;
  }
  
  /* Estilos de mensaje de error */
  .error-message {
    color: #ff0000;
    margin-top: 10px;
  }
  </style>
    