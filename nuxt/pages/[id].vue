<template>
    <div v-if="info_obtinguda">
        {{ movies.id }}
        <h2>{{ movies.title }}</h2>
        <p>{{ movies.description }}</p>
        <img :src="movies.image" alt="Movie Poster" class="movie-image">
        <p>Fecha de lanzamiento: {{ movies.date }}</p>


    </div>

    <div v-if="fetchDataSeatsIsDone">
        <h2>Asientos</h2>
        <div class="asientos">
        <div v-for="asiento in asientos" :key="asiento.id">
            <!-- v-if si esta occupied /img/ocupada.img -->
            <!-- v-else /img/disponible.png -->
            <img :src="asiento.occupied ? '/img/ocupada.png' : '/img/disponible.png'" alt="Asiento" style="width: 50px; height: 50px;">
        </div>
    </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            movies: null,
            info_obtinguda: false,
            asientos: [],
            fetchDataSeatsIsDone: false,
        }
    },
    methods: {
        async fetchDataMovie() {
            try {
                const response = await fetch(`http://localhost:8000/api/movies/${this.id}`);

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                this.movies = data;
                if (this.movies) {
                    this.info_obtinguda = true
                }
            } catch (error) {
                console.error('Error fetching movies:', error);
            }
        },
        async fetchDataSeats() {
            try {
                const response = await fetch(`http://localhost:8000/api/movies/${this.id}/seats`);

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                this.asientos = data;
                this.fetchDataSeatsIsDone = true;
                console.log('ASIENTOS',this.asientos);
                if (this.movies) {
                    this.info_obtinguda = true
                }
            } catch (error) {
                console.error('Error fetching movies:', error);
            }
        },
    },
    async mounted() {
        this.fetchDataMovie();
        this.fetchDataSeats();

    },


    created() {
        this.id = this.$route.params.id
    },
}
</script>

<style scoped>
h2 {
    font-size: 1.5em;
    margin-bottom: 10px;
    color: #555;
}

p {
    color: #777;
    margin-bottom: 10px;
}

.movie-image {
    width: 200px;
    height: 250px;
    border-radius: 5px;
    margin-bottom: 10px;
}
.asientos{
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    grid-template-rows:repeat(10, 1fr); ;
}
</style>