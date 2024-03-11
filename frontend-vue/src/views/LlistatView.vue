<template>
  <div class="interpreter-list">
    <h1>Lista de Intérpretes</h1>
    <ul class="interpreter-grid">
      <li v-for="item in arrayItems" :key="item.nombre" class="interpreter-item">
        <div class="interpreter-details">
          <h2>{{ item.nombre }}</h2>
          <p><strong>Nacimiento:</strong> {{ item.nacimiento }}</p>
          <p><strong>Número de premios Goya:</strong> {{ item.numGoya }}</p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      arrayItems: [],
    };
  },
  created() {
    this.getItems();
  },
  methods: {
    async getItems() {
      try {
        const response = await fetch("/interpretes.json");

        if (!response.ok) {
          throw new Error(`Error en la solicitud: ${response.statusText}`);
        }

        const jsonResponse = await response.json();
        console.log("items", jsonResponse);
        this.arrayItems = jsonResponse;
      } catch (error) {
        console.error("Error al obtener los elementos:", error);
      }
    },
  },
};
</script>

<style>
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
}

.interpreter-list {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  color: #333;
}

.interpreter-grid {
  list-style: none;
  padding: 0;
  display: flex;
  flex-wrap: wrap;
}

.interpreter-item {
  background-color: #fff;
  border: 1px solid #ddd;
  margin: 10px;
  flex: 1 0 calc(33.33% - 20px);
  padding: 15px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.interpreter-details {
  padding-left: 10px;
}

h2 {
  color: #333;
  margin-bottom: 5px;
}

p {
  margin: 0;
  color: #353532;
}

@media (max-width: 768px) {
  .interpreter-item {
    flex: 1 0 calc(50% - 20px);
  }
}

@media (max-width: 480px) {
  .interpreter-item {
    flex: 1 0 calc(100% - 20px);
  }
}
</style>
