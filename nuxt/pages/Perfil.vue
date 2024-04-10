<template>
  <div class="background">
    <div class="profile-container">
      <div class="card_profile">
        <h2 class="profile-title">Perfil de Usuario</h2>
        <div v-if="user" class="profile-info">
          <p><strong>Name:</strong> {{ user.name }}</p>
          <p><strong>Email:</strong> {{ user.email }}</p>

        </div>        <div v-else>

       

        <p>No hay información de usuario disponible</p>
        <!-- Otra acción que quieras mostrar si el usuario no está autenticado -->
      </div> </div>
      <div class="">

      </div>
      <button @click="logout" class="logout-button">Cerrar sesión</button>
    </div>
  </div>
</template>


<script>
import { useStore } from '../stores/index.js';
export default {
  data() {
    return {
      user: null,
    };
  },

  methods: {

    logout() {
      const userStore = useStore();
      userStore.setUser(null);
      localStorage.removeItem('user');
      this.$router.push('/login'); // Redirigir al usuario a la página de inicio de sesión
    }
  },

  mounted() {
    const userStore = useStore();
    this.user = userStore.returnUser();
  },
}
</script>

<style scoped>
/* Estilos */
.background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url('../public/img/perf.png');
  background-size: cover;
  background-position: center;
  font-family: 'Roboto', sans-serif;
}

.profile-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;

}
.card_profile{
  background-color: rgb(8 8 8 / 40%);
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    width: auto;
    margin: 0 auto;
}
.profile-title {
  font-size: 2rem;
  color: white;
}

.profile-info {
  background-color: rgba(255, 255, 255, 0.8);
  padding: 20px;
  border-radius: 5px;
  margin-top: 20px;
}

.logout-button {
  background-color: #ff3366;
  color: white;
  border: none;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 5px;
}
</style>