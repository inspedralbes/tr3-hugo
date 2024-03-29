// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  //add css normalize
  css: ['normalize.css'],
  modules: ['@pinia/nuxt', '@nuxt/image'],
  telemetry: false,
})