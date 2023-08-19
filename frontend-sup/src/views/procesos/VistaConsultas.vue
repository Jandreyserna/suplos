<template>
    <div>
      <!-- llamamos al sidebar del template, en este caso sirve de menu de navegacion -->
      <sidebareventos></sidebareventos>
      <form @submit.prevent="submitForm" class="formulario-eventos">
        <div class="container-form-eventos">
          <div class="camp">
            <label for="idCerrada">Id Cerrada:</label>
            <input type="text" id="idCerrada" v-model="busqueda.idCerrada" placeholder="Número id procesos/Eventos"><br><br>
          </div>

          <div class="camp">
            <label for="objetoDescripcion">Objeto/Descripción:</label>
            <input type="text" id="objetoDescripcion" v-model="busqueda.objetoDescripcion" placeholder="Objeto/Descripción"><br><br>
          </div>
          
          <div class="camp">
            <label for="comprado">Comprado:</label>
            <input type="text" id="comprado" v-model="busqueda.comprado" placeholder="Responsable Evento"><br><br>
          </div>
        </div>

        <div class="container-select">
          <label for="estado">Estado:</label>
          <select id="estado" v-model="busqueda.estado">
            <option value="Activo">Activo</option>
            <option value="Publicado">Publicado</option>
            <option value="Evaluacion">Evaluacion</option>
          </select><br><br>
        </div>
        
        <div class="buttons">
          <button type="submit">Buscar</button>
        </div>
      </form>
    </div>

  <div>
    <!-- creamos la tabla de eventos y la llenamos desde BD -->
    <div class="table-container">
      <table class="custom-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Ronda</th>
            <th>Objeto</th>
            <th>Descripción</th>
            <th>Fecha Inicio</th>
            <th>Fecha Cierre</th>
            <th>Estado</th>
            <th>Responsable del Evento</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="evento in this.eventos" :key="evento.id">
            <td>{{ evento.id }}</td>
            <td>1</td>
            <td>{{ evento.object }}</td>
            <td>{{ evento.description }}</td>
            <td>{{ evento.init_date }}</td>
            <td>{{ evento.finish_date }}</td>
            <td>{{ evento.state }}</td>
            <td>Jandrey Steven Serna</td>
            <td>
              <button @click="editarEvento(evento.id)">Editar</button>
              <button id="eliminar" @click="eliminarEvento(evento.id)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

  <script>
  /* importamos las dependencias necesarias para la vista */
  import sidebareventos from '../../components/templates/SidebarEventos.vue'
  import Service from "./servicios/services";

  export default {
    /* creamos las datas que usarremos en el script */
    data() { 
      return {
        eventos: [],
        busqueda: {
          idCerrada: '',
          objetoDescripcion: '',
          comprador: '-',
          estado: 'todos',     
        }
      };
    },
    /* definimos los metodos del archivo */
    methods: {
      async submitForm() {/* metodo para hacer la consulta por filtros a la BD por llamada API */
        console.log(this.busqueda);
        const response = await Service.consult_processes({params: this.busqueda});
        if (response.status == 200){
          this.eventos = response.data; 
        }
        console.log(this.eventos);
      },

      editarEvento(id) {
        console.log(`Editar evento ${id}`);
      },

      eliminarEvento(id) {
        console.log(`Eliminar evento ${id}`);
      }
    },

    /* metodo que trae los datos de la BD para la table */
    async mounted() {
      const response = await Service.consult_processes();
      if (response.status == 200){
        this.eventos = response.data; 
      }
    },

    /* se definen los componentes que se llaman desde este archivo */
    components: {
    sidebareventos
  }
  };
  </script>

<style scoped>
.formulario-eventos{
  margin-top:5%;
  font-size:20px;
  display: flex;
  flex-direction: column;
}

.container-form-eventos{
  display:flex;
  align-items: center;
  margin-left: 2%;
}

.container-form-eventos .camp {
  display:flex;
  flex-direction:column;
  margin-right: 10%;
  width:33%;
}

.camp input{
  width:100%;
  height: 30px;
}

.container-select{
  display:flex;
  flex-direction: column;
}

.container-select label{
  width:32%;
  margin-left:2%;
}

.container-select select{
  height:30px;
  width:23%;
  margin-left:2%;
}

.buttons{
  display: flex;
  justify-content: end;
}

.buttons button{
  border-radius: 6px;
  height: 35px;
  width: 10%;
  background-color:#a8a8a8;
  margin-right: 5%;
}

/*  estilos para la tabla de eventos */

.table-container {
  margin-top:25px;
  max-width: 100%;
  overflow-x: auto;
}

.custom-table {
  width: 100%;
  border-collapse: collapse;
  border: 1px solid #201f1f;
}

.custom-table th,
.custom-table td {
  padding: 10px;
  border: 1px solid #201e1e;
}

.custom-table th {
  background-color: #222121;
  text-align: left;
  color: white;
}

.custom-table td {
  text-align: center;
}

.custom-table button {
  padding: 5px 10px;
  background-color: #007bff;
  color: white;
  border: none;
  cursor: pointer;
}

.custom-table #eliminar {
  padding: 5px 10px;
  background-color: #f70000;
  color: white;
  border: none;
  cursor: pointer;
  margin-left:3px;
}
.custom-table button:hover {
  background-color: #0056b3;
}

</style>
  