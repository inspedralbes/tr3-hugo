// store/User.js

import { defineStore } from 'pinia';

export const useUserStore = defineStore('user', {
  state: () => ({
    user: null,
    reservations: [],
    totalPrice: 0,
    tickets: [],
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
    addTicket(ticket) {
      this.tickets.push(ticket);
    },
    updateTotalPrice(price) {
      this.totalPrice = price;
    },
    saveReservations() {
        return this.reservations;
        return this.tickets;
     
    },
   
},
});
