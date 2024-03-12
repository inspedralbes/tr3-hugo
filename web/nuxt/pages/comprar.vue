<!-- ComprarPage.vue -->
<template>
    <div>
      <header>
        <h1>¡Compra tus Entradas!</h1>
        <p>Selecciona tus películas favoritas y vive una experiencia única en el cine.</p>
      </header>
  
      <section>
        <div class="movie-selection">
          <div v-for="movie in movies" :key="movie.id" class="movie-card">
            <img :src="movie.image" alt="Movie Poster" class="movie-poster">
            <h2>{{ movie.title }}</h2>
            <p>{{ movie.description }}</p>
            <button @click="addToCart(movie)">Agregar al Carrito</button>
          </div>
        </div>
        
        <div class="cart">
          <h2>Carrito de Compra</h2>
          <ul>
            <li v-for="item in cart" :key="item.id">
              <span>{{ item.title }}</span>
              <span>{{ item.quantity }}x</span>
            </li>
          </ul>
          <button @click="checkout">Completar Compra</button>
        </div>
      </section>
    </div>
  </template>
  
  <style scoped>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
    color: #333;
  }
  
  header {
    background-color: #3498db;
    color: #ecf0f1;
    padding: 20px;
    text-align: center;
  }
  
  section {
    text-align: center;
    padding: 50px 20px;
  }
  
  h1 {
    font-size: 3em;
    margin-bottom: 20px;
  }
  
  p {
    font-size: 1.2em;
    color: #555;
    margin-bottom: 30px;
  }
  
  .movie-selection {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
  }
  
  .movie-card {
    margin: 1rem;
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 250px;
    background-color: #fff;
  }
  
  .movie-poster {
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 10px;
  }
  
  .cart {
    margin-top: 50px;
  }
  
  .cart h2 {
    font-size: 2em;
    margin-bottom: 20px;
  }
  
  ul {
    list-style: none;
    padding: 0;
  }
  
  li {
    margin: 10px 0;
    display: flex;
    justify-content: space-between;
  }
  
  button {
    background-color: #e74c3c;
    color: #ecf0f1;
    padding: 10px 20px;
    font-size: 1em;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease-in-out;
  }
  
  button:hover {
    background-color: #c0392b;
  }
  </style>
  
  <script>
  export default {
    data() {
      return {
        movies: [
          { id: 1, title: 'La Aventura', description: 'Una película emocionante', image: 'la-aventura.jpg' },
          { id: 2, title: 'Comedia Divertida', description: 'Ríete a carcajadas', image: 'comedia-divertida.jpg' },
          { id: 3, title: 'Drama Profundo', description: 'Una historia conmovedora', image: 'drama-profundo.jpg' },
        ],
        cart: [],
      };
    },
    methods: {
      addToCart(movie) {
        const existingItem = this.cart.find(item => item.id === movie.id);
        if (existingItem) {
          existingItem.quantity++;
        } else {
          this.cart.push({ ...movie, quantity: 1 });
        }
      },
      checkout() {
        // Aquí podrías implementar la lógica de compra (envío a una API, etc.)
        alert('¡Compra completada! Gracias por elegir Cine Fantástico.');
        this.cart = [];
      },
    },
  };
  </script>
  