// store/User.js

import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    reservations: [],
    totalPrice: 0,
  }),
  actions: {
    setUser(user) {
      this.user = user;
    },
    addReservation(reservation) {
      this.reservations.push(reservation);
    },
    clearReservations() {
      this.reservations = [];
    },
    updateTotalPrice(price) {
      this.totalPrice = price;
    },
  },
});
