<template>
  <div class="container">
    <h1>Películas</h1>
    <div>
      <button @click="openModal()">Agregar película</button>
      <div v-if="showModal" class="modal">
        <div class="modal-content">
          <span class="close" @click="showModal = false">&times;</span>
          <h2>Agregar película</h2>
          <form @submit.prevent="addMovie">
              <div>
              <label for="title">Título:</label>
              <input type="text" id="title" v-model="newMovie.title" required>
            </div>
            <div>
              <label for="description">Descripción:</label>
              <textarea id="description" v-model="newMovie.description" required></textarea>
            </div>
            <div>
              <label for="image">Imagen:</label>
              <input type="text" id="image" v-model="newMovie.image" required>
            </div>
            <div>
              <label for="date">Fecha:</label>
              <input type="date" id="date" v-model="newMovie.date" required>
            </div>
            <div>
              <label for="totalSeats">Total de asientos:</label>
              <input type="number" id="totalSeats" v-model="newMovie.total_seats" required>
            </div>
            <button type="submit">Agregar</button>
          </form>
        </div>
      </div>

    </div>
    <div v-if="movies.length === 0">No hay películas disponibles.</div>
    <div v-else>
      <table>
        <thead>
          <tr>
            <th>Título</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Fecha</th>
            <th>Total de asientos</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="movie in movies" :key="movie.id">
            <td>{{ movie.title }}</td>
            <td>{{ movie.description }}</td>
            <td><img :src="movie.image" alt=""></td>
            <td>{{ movie.date }}</td>
            <td>{{ movie.total_seats }}</td>
            <td>
              <button @click="editMovie(movie.id)">Editar</button>
              <button @click="deleteMovie(movie.id)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movies: [],
      showModal: false,
      newMovie: {
        title: '',
        description: '',
        image: '',
        date: '',
        total_seats: 0
      }
    };
  },
  mounted() {
    this.fetchMovies();
  },
  methods: {
    openModal() {
      this.showModal = true;
      console.log('Abrir modal');
      console.log(this.showModal);
    },
    async fetchMovies() {
      try {
        const response = await fetch('http://localhost:8000/api/movies');
        const data = await response.json();
        this.movies = data;
      } catch (error) {
        console.error('Error fetching movies:', error);
      }
    },
    async addMovie() {
    try {
      const response = await fetch('http://localhost:8000/api/movies', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(this.newMovie),
      });
      const data = await response.json();
      this.movies.push(data);
      this.newMovie = {
        title: '',
        description: '',
        image: '',
        date: '',
        total_seats: 0
      };
      this.showModal = false;
    } catch (error) {
      console.error('Error adding movie:', error);
    }
  },
    editMovie(id) {
      console.log('Editar película con ID:', id);
      // Implementa la lógica para editar la película
    },
    async deleteMovie(id) {
      try {
        await fetch(`http://localhost:8000/api/movies/${id}`, {
          method: 'DELETE',
        });
        this.movies = this.movies.filter(movie => movie.id !== id);
      } catch (error) {
        console.error('Error deleting movie:', error);
      }
    }
  }
};
</script>

<style>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.modal {
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

form {
  display: grid;
  grid-template-columns: 1fr;
  grid-row-gap: 10px;
}

form label {
  font-weight: bold;
}

form input,
form textarea,
form button {
  width: 100%;
  padding: 8px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

form button {
  background-color: #4CAF50;
  color: white;
  border: none;
  cursor: pointer;
}

form button:hover {
  background-color: #45a049;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}
img{
  border-style: none;
    height: 134px;
    width: 104px;

}
</style>
