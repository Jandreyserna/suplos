import axios from "axios";

// Creamos la base de las peticiones, con los datos necesarios
const apiClient = axios.create({
  baseURL: process.env.VUE_APP_BASE_URL
});


// Exportamos los métodos para las peticiones
export default apiClient;