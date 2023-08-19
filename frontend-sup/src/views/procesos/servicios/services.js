//Se importa la instancia de axios
import apiClient from "./index";

export default {/* aqui creamos las llamadas apis a el backend en este caso Laravel */

  registro_evento(data_proceso){
    return apiClient.post("/crear-evento", data_proceso);
  },

  consult_activity(){
    return apiClient.get("/consultar-actividades")
  },

  consult_processes(datas){
    return apiClient.get("/consultar-procesos", datas)
  }


};