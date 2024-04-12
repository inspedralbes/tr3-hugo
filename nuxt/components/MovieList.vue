  <template>
    <div class="body">
      <Header />

      <div class="carousel-container">
        <button class="carousel-btn prev" @click="prevSlide" :disabled="currentIndex === 0">❮</button>
        <ul class="carousel-list">
          <li v-for="(movie, index) in visibleMovies" :key="movie.id"
            :style="{ transform: 'translateX(' + (index * slideWidth) + 'px)' }">
            <div class="movie-card">
              <img :src="movie.image" :alt="'Cartel de la película ' + movie.title" class="movie-image">
              <div class="movie-content">
                <div class="movie-details">
                  <h2>{{ movie.title }}</h2>
                  <p class="description">{{ movie.description }}</p>
                  <p><strong>Fecha de lanzamiento:</strong> {{ movie.date }}</p>
                  <h3>{{ movie.session }}</h3> 
                </div>
                <div class="action-buttons">
                  <button class="buy-ticket-btn" @click="buyTicket(movie.id)">Comprar Tickets</button>
                  <select @click="loadSessions(movie.id)"> 
                    <option value="" class="">Selecciona una sesión</option>
                    <option v-for="session in sessions" :key="session.id" :value="session.id">{{ session.start_time }}</option>
                  </select>
                </div>
              </div>
              <div class="trailer">
                <a :href="movie.trailer" target="_blank">
                <img src="https://cdn.icon-icons.com/icons2/1238/PNG/512/playbuttononfilmstrip_83691.png" alt="Botón del tráiler">
                </a>
              </div>
            </div>
          </li>
        </ul>
        <button class="carousel-btn next" @click="nextSlide"
          :disabled="currentIndex >= movies.length - numVisibleSlides">❯</button>
      </div>
    </div>
  </template>



  <script>
  export default {
    data() {
      return {
        movies: [],
        sessions: [],
        currentIndex: 0,
        slideWidth: 300,
        numVisibleSlides: 3
      }
    },
    computed: {
      visibleMovies() {
        const endIndex = this.currentIndex + this.numVisibleSlides;
        return this.movies.slice(this.currentIndex, endIndex);
      }
    },

    async mounted() {
      try {
        const response = await fetch('http://tr3a22hugtrigon.daw.inspedralbes.cat/back/laravel/public/api/movies')
        const data = await response.json()
        this.movies = data

      } catch (error) {
        console.error('Error fetching movies:', error)
      }
    },
    methods: {
      prevSlide() {
        if (this.currentIndex > 0) {
          this.currentIndex--;
        }
      },
      nextSlide() {
    const maxIndex = this.movies.length - this.numVisibleSlides + 1;
    if (this.currentIndex < maxIndex) {
      this.currentIndex++;
    }
  },
      buyTicket(movieId) {
        console.log('ID de la película:', movieId);
        // Aquí puedes agregar la lógica para comprar tickets
        // Por ejemplo, redirigir a la página de compra de tickets
        navigateTo(`/${movieId}`);
      },
      async loadSessions(movieId) {
        try {
          const response = await fetch(`http://tr3a22hugtrigon.daw.inspedralbes.cat/back/laravel/public/api/movies/${movieId}/sessions`);
          const data = await response.json();
          this.sessions = data;
          console.log('Sesiones cargadas:', this.sessions); // Agregar este console.log
        } catch (error) {
          console.error('Error fetching sessions:', error);
        }
      }
    }
  }
  </script>

  <style scoped>
  .body {
    padding: 20px;
    background-color: #ccccccd5;
  }
  .movie-card {
    display: flex;
    flex-direction: column;
    background-color: #f9f9f9; /* Cambié el color de fondo */
    padding: 20px; /* Aumenté el espacio interior */
    border-radius: 10px; /* Hice los bordes más redondeados */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); /* Agregué una sombra suave */
    transition: transform 0.3s ease; /* Agregué una animación de transformación al pasar el mouse */
  }

  .movie-card:hover {
    transform: translateY(-5px); /* Levanta ligeramente la tarjeta al pasar el mouse */
  }

  .movie-content {
    flex: 1;
  }

  .action-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px; /* Añadí un margen superior */
  }

  .buy-ticket-btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 15px; /* Ajusté el espacio interior */
    border-radius: 5px; /* Hice los bordes más redondeados */
    cursor: pointer;
    transition: background-color 0.3s ease; /* Agregué una transición al cambiar de color */
  }

  .buy-ticket-btn:hover {
    background-color: #0056b3; /* Cambia el color al pasar el mouse */
  }

  select {
    margin-left: 10px;
    padding: 6px 10px; /* Ajusté el espacio interior */
    border: 1px solid #ccc; /* Agregué un borde */
    border-radius: 5px; /* Hice los bordes más redondeados */
  }

  .trailer {
    font-size: 0.9em;
    line-height: 1.4;
    margin-block: 0.75em;
    opacity: 0;
    transition: opacity 0.4s ease-in-out;
    font-family: "Arimo", sans-serif;
  }

  .movie-card:hover .trailer {
    opacity: 1;
    transition-delay: 0.3s;
  }

  .movie-card:hover .movie-image {
    filter: brightness(60%) blur(3px);
  }

  .movie-image {
    border-radius: 5px;
    height: 452px;
    width: 323px;
  }

  .carousel-container {
    position: relative;
    overflow: hidden;
  }

  .carousel-list {
    display: flex;
    list-style-type: none;
    transition: transform 0.5s ease;
  }

  .carousel-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    cursor: pointer;
    padding: 10px;
    z-index: 2;
    transition: background-color 0.3s ease;
  }

  .carousel-btn.prev {
    left: 0;
  }

  .carousel-btn.next {
    right: 0;
  }

  .carousel-btn:disabled {
    background-color: rgba(0, 0, 0, 0.2);
    cursor: not-allowed;
  }

  .movie-details {
    padding: 10px;
  }

  .movie-card {
    display: flex;
      padding: 10px;
      background-color: #f0f1f1e6;
      border-radius: 5px;
      box-shadow: 20px 1px 16px 7px rgba(0, 0, 0, 0.1);
      width: 364px;
      /* margin-top: 0%; */
      align-items: center;
      height: 85%;
      /* margin-left: 8px;*/
      flex-direction: column;
      transition: transform 0.3s ease; /* Agregué una animación de transformación al pasar el mouse */

  }





  .trailer img {
    width: 70px; 
    height: 70px;
    cursor: pointer;
    transition: transform 0.3s ease;
    margin-top: 10px;
    background-color: beige;
    position: relative;
    top:-500px;
  }
  .trailer img:hover {
    transform: scale(1.1);
  }
  .trailer img:active {
    transform: scale(0.9);
  }
  </style>