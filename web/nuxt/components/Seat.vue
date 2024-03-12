<!-- components/Seat.vue -->
<template>
    <div :class="{ seat: true, ocupada: seatStatus, disponible: !seatStatus }" @click="toggleSeatStatus"><img v-if="seatStatus" src="../public/img/disponible.png" alt="Butaca ocupada" class="butaca_ocupada"/> <img v-else src="../public/img/disponible.png" alt="Butaca disponible" class="butaca_disponible"/></div>
</template>

<script>
export default {
    props: {
        seatStatus: Boolean,
    },
    methods: {
        toggleSeatStatus() {
            this.$emit("toggleSeatStatus");
        },
    },
};
</script>

<style scoped>
.seat {
    width: 10px;
    height: 10px;
    margin-top: 10px;
    border: 1px solid #000;
    cursor: pointer;
    background-color: purple;
}

.ocupada {
    background-color: red;
}

.disponible {
    background-color: green;
    margin-top: 10px;
}
.butaca_ocupada{
    width: 100%;
    height: 100%;
    border-radius: 5px;
   

}
.butaca_disponible{
    width: 100px;
    height: 100px;
    border-radius: 5px;
    margin-top:10px;
}
</style>