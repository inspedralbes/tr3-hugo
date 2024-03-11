<template>
  <div>
    <header>
      <h1>Cine Fantástico</h1>
      <p>Descubre las mejores películas en la pantalla grande</p>
    </header>

    <section>
      <h2>Próximos Estrenos</h2>
      <p>No te pierdas nuestras emocionantes películas que llegarán próximamente. ¡Compra tus entradas ahora!</p>
      <NuxtLink to="/comprar" class="cta-button">Comprar Entradas</NuxtLink>
    </section>
  </div>
</template>

<style scoped>
  body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #1c1c1c;
    color: #ffffff;
  }

  header {
    background-color: #2c3e50;
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
    color: #ecf0f1;
  }

  h2 {
    font-size: 2em;
    margin-bottom: 20px;
    color: #ecf0f1;
  }

  p {
    font-size: 1.2em;
    color: #bdc3c7;
    margin-bottom: 30px;
  }

  .cta-button {
    background-color: #e74c3c;
    color: #ecf0f1;
    padding: 15px 30px;
    font-size: 1.2em;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out;
    cursor: pointer;
  }

  .cta-button:hover {
    background-color: #c0392b;
  }
</style>
