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
              <label for="trailer">Trailer:</label>
              <input type="text" id="trailer" v-model="newMovie.trailer" required>
            </div>
            <div>
              <label for="totalSeats">Total de asientos:</label>
              <input type="number" id="totalSeats" v-model="newMovie.total_seats" required>
            </div>
            <div>
              <label for="startTime">Hora de inicio:</label>
              <input type="datetime-local" id="startTime" v-model="newSession.start_time" required>
            </div>
            <button type="submit">Agregar</button>
          </form>
        </div>
      </div>
      <div>

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
            <th>Trailer</th>
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
            <td>{{ movie.trailer }}</td>
            <td>{{ movie.total_seats }}</td>
            <td>
              <button @click="openEditModal(movie)">Editar</button>
              <button @click="deleteMovie(movie.id)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="showEditModal" class="modal">
      <div class="modal-content">
        <span class="close" @click="showEditModal = false">&times;</span>
        <h2>Editar película</h2>
        <form @submit.prevent="updateMovie">
          <div>
            <label for="editTitle">Título:</label>
            <input type="text" id="editTitle" v-model="editMovie.title" required>
          </div>
          <div>
            <label for="editDescription">Descripción:</label>
            <textarea id="editDescription" v-model="editMovie.description" required></textarea>
          </div>
          <div>
            <label for="editImage">Imagen:</label>
            <input type="text" id="editImage" v-model="editMovie.image" required>
          </div>
          <div>
            <label for="editDate">Fecha:</label>
            <input type="date" id="editDate" v-model="editMovie.date" required>
          </div>
          <div>
            <label for="editTrailer">Trailer:</label>
            <input type="text" id="editTrailer" v-model="editMovie.trailer" required>
          </div>
          <div>
            <label for="editTotalSeats">Total de asientos:</label>
            <input type="number" id="editTotalSeats" v-model="editMovie.total_seats" required>
          </div>
          <button type="submit">Guardar cambios</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      movies: [],
      showModal: false,
      showEditModal: false,
      newMovie: {
        title: '',
        description: '',
        image: '',
        trailer: '',
        date: '',
        total_seats: 0,
      },
      newSession: {
        start_time: ''
      },
      editMovie: {
        id: '',
        title: '',
        description: '',
        image: '',
        trailer: '',
        date: '',
        total_seats: 0,
      },
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
        const movieResponse = await fetch('http://localhost:8000/api/movies', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.newMovie),
        });
        const movieData = await movieResponse.json();
        this.movies.push(movieData);

        const sessionResponse = await fetch(`http://localhost:8000/api/movies/${movieData.id}/sessions`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.newSession),
        });
        const sessionData = await sessionResponse.json();
        console.log('Película y sesión agregadas:', movieData, sessionData);

        // Reiniciar los datos del formulario y cerrar el modal
        this.newMovie = {
          title: '',
          description: '',
          image: '',
          trailer: '',
          date: '',
          total_seats: 0,
        };
        this.newSession = {
          start_time: ''
        };
        this.showModal = false;
      } catch (error) {
        console.error('Error adding movie and session:', error);
      }
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
    },
    openEditModal(movie) {
      this.showEditModal = true;
      this.editMovie = {
        id: movie.id,
        title: movie.title,
        description: movie.description,
        image: movie.image,
        trailer: movie.trailer,
        date: movie.date,
        total_seats: movie.total_seats,
      };
    },

    async updateMovie() {
      try {
        const response = await fetch(`http://localhost:8000/api/movies/${this.editMovie.id}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(this.editMovie),
        });
        if (response.ok) {
          // Actualizar la película en la lista
          const index = this.movies.findIndex(movie => movie.id === this.editMovie.id);
          if (index !== -1) {
            this.movies.splice(index, 1, this.editMovie);
          }
          this.showEditModal = false;
        } else {
          console.error('Error al editar la película:', response.statusText);
        }
      } catch (error) {
        console.error('Error al editar la película:', error);
      }
    },
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
  background-color: rgba(0, 0, 0, 0.4);
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

th,
td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

img {
  border-style: none;
  height: 134px;
  width: 104px;
}
</style>
