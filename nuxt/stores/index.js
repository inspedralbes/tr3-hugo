// stores/index.js
import { defineStore } from 'pinia';

export const useStore = defineStore('main', {
  state: () => ({
    user: JSON.parse(localStorage.getItem('user')) || null,
    reservations: [],
    totalPrice: 0,
    tickets: [],
  }),
  actions: {
    setUser(user) {
      this.user = user;
      localStorage.setItem('user', JSON.stringify(user));
    },
    addReservation(reservation) {
      this.reservations.push(reservation);
    },
    clearReservations() {
      this.reservations = [];
    },
    addTicket(ticket) {
      this.tickets.push(ticket);
    },
    updateTotalPrice(price) {
      this.totalPrice = price;
    },
    saveReservations() {
      return this.reservations;
      return this.tickets;

    }

  },
});
