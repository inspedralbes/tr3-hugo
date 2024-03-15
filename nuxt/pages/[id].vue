<template>
    <div v-if="info_obtinguda">
        {{ movies.id }}
        <h2>{{ movies.title }}</h2>
        <p>{{ movies.description }}</p>
        <img :src="movies.image" alt="Movie Poster" class="movie-image">
        <p>Fecha de lanzamiento: {{ movies.date }}</p>
        <button @click="reservar">Reservar</button>
    </div>

    <div v-if="fetchDataSeatsIsDone">
        <h2>Asientos</h2>
        <div class="asientos">
            <div v-for="asiento in asientos" :key="asiento.id">
                <img :src="asiento.occupied ? '/img/ocupada.png' : '/img/disponible.png'" alt="Asiento" style="width: 50px; height: 50px;" @click="clickAsiento(asiento.id)">
                <p>{{ asiento.id }}</p>
                <p>{{ asiento.occupied }}</p>
                <p>{{ asiento.movie_id }}</p>
                <button v-if="!asiento.occupied" @click="reservarAsiento(asiento.id)">Reservar</button>
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
            id: null,
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
                this.info_obtinguda = true;
            } catch (error) {
                console.error('Error fetching movie:', error);
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
            } catch (error) {
                console.error('Error fetching seats:', error);
            }
        },
        async clickAsiento(id) {
            try {
                const response = await fetch(`http://localhost:8000/api/movies/${this.id}/seats/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        occupied: !this.asientos.find(asiento => asiento.id === id).occupied
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                this.fetchDataSeats();
            } catch (error) {
                console.error('Error updating seat:', error);
            }
        },
        async reservarAsiento(id) {
            try {
                const response = await fetch(`http://localhost:8000/api/movies/${this.id}/seats/${id}/reserve`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        occupied: true
                    })
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                this.fetchDataSeats();
            } catch (error) {
                console.error('Error reserving seat:', error);
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

.asientos {
    display: grid;
    grid-template-columns: repeat(10, 1fr);
    grid-template-rows: repeat(10, 1fr);
    margin-left: 60%;
}
</style>
