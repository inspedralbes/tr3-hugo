<template>
    <div class="profile-container">
      <h2 class="profile-title">Perfil de Usuario</h2>
      <div v-if="user" class="profile-info">
        <p><strong>Email:</strong> {{ user.email }}</p>
        <!-- Otros campos de información del usuario -->
      </div>
      <div v-else>
        <p>No hay información de usuario disponible</p>
        <!-- Otra acción que quieras mostrar si el usuario no está autenticado -->
      </div>
      <button @click="logout" class="logout-button">Cerrar sesión</button>
    </div>
  </template>
  
  
  <script>
  import { useStore } from '../stores/index.js';
  export default {
    computed: {
      user() {
        const userStore = useStore();
        return userStore.user;
      }
    },
    methods: {
      logout() {
        const userStore = useStore();
        userStore.setUser(null);
        localStorage.removeItem('user');
        this.$router.push('/login'); // Redirigir al usuario a la página de inicio de sesión
      }
    }
  }
  </script>
  
  <style scoped>
  /* Estilos */
  </style>
  