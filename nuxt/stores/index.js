// stores/index.js
import { defineStore } from 'pinia';

export const useStore = defineStore('main', {
  state: () => ({
    user: typeof localStorage !== 'undefined' ? JSON.parse(localStorage.getItem('user')) || null : null,
    reservations: [],
    totalPrice: 0,
    tickets: [],
  }),
  actions: {
    setUser(user) {
      this.user = user;
      if (typeof localStorage !== 'undefined') {
        localStorage.setItem('user', JSON.stringify(user));
      }
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
      return { reservations: this.reservations, tickets: this.tickets };
    },
    saveTotalPrice() {
      return this.totalPrice;
    },
    returnUser() {
      return this.user;
    } 
      

  },
});
