import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    user :{},
    isLogged: false,
    authToken: null,
  }),
  getters: {
    getUserData : (state) => state.user,
    isUserLoggedIn: (state) => !!state.isLogged,
  },
  actions: {
    async fetchUser(){
      const token = localStorage.getItem('authToken');
      try {
      const response = await axios.get('/api/web/me', {
        headers: {
          'Authorization': `Bearer ${token}`
            }
          });
          if (response.data) {
            this.setIslogged(true);
            this.user = response.data;
          }
          console.log("FETCH USER",response);
      } catch (e) {
        this.logout();
        console.log(e);
        this.router.push({ name: 'login' });
      }
    },
    setIslogged(isLogged) {
      this.isLogged = isLogged;
    },
    setAuthToken(token) {
      this.authToken = token;
    },
    setRole(role) {
      this.role = role;
    },
    logout() {
      console.log("LOGOUT");
      this.authToken = null;
      this.role = '';
      //clear local storage
      localStorage.removeItem('authToken');
    }
  },
});
