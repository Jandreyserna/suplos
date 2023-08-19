<template>
  <!-- sidebar para la navegacion -->
  <sidebareventos></sidebareventos>
  <!-- botones  formularios desde pestañas -->
  <div class="container">
    <button class="toggle-button" @click="showForm = !showForm, showFormCronograma = false"><h3>Información básica</h3></button>
    <button class="toggle-button" @click="showFormCronograma = !showFormCronograma , showForm = false "><h3>cronograma</h3></button>
  </div>

  <div>
    <!-- Fromulario de cronograma -->
    <form v-if="showFormCronograma" @submit.prevent="submitFormCrono"> 
      <div class="form-inputs">
          <div class="camp">
              <label for="fecha_inicio">Fecha Inicio: (*)</label>
              <input type="date" id="fecha_inicio" v-model="formulario.fechaInicio" :min="minFechaInicio" required><br><br>
          </div>

          <div class="camp">
              <label for="hora_inicio">Hora Inicio: (*)</label>
              <input type="time" id="hora_inicio" v-model="formulario.horaInicio" :min="minHoraInicio" required><br><br>
          </div>

          <div class="camp">
              <label for="fecha_cierre">Fecha Cierre: (*)</label>
              <input type="date" id="fecha_cierre" v-model="formulario.fechaCierre" :min="minFechaCierre" required><br><br>
          </div>

          <div class="camp">
              <label for="hora_cierre">Hora Cierre: (*)</label>
              <input type="time" id="hora_cierre" v-model="formulario.horaCierre" :min="minHoraCierre" required><br><br>
          </div>
      </div>
      <button type="submit">Enviar</button>
    </form>
  </div>
    
  <div class="container-form">
    <form class="form" v-if="showForm" @submit.prevent="submitForm"> <!-- Formulario de informacion basica -->
      <div class="title">
          <h2>Información básica</h2>
      </div>

      <div class="container-blocks-form">
        <div class="first-camps">
          <div class="camp">
            <label class="form-label" for="objeto">Objeto:</label>
            <input
                class="form-input"
                v-model="formData.objeto"
                type="text"
                id="objeto"
                required
                @input="validateAlphanumeric('objeto')"
            >
          </div>

          <div class="camp">
            <label for="options">Selecciona una opción:</label>
            <select v-model="formData.selectedOption" id="options">
              <option v-for="option in options" :value="option.codigo_producto" :key="option.codigo_producto">{{ option.nombre_producto }}</option>
            </select>
          </div>
        </div>

        <label class="form-label" for="descripcion">Descripción/Alcance:</label>
        <textarea
            class="form-textarea"
            v-model="formData.descripcion"
            id="descripcion"
            required
        ></textarea>

        <div class="secound-camps">
          <div class="camp-2">
            <label class="form-label" for="moneda">Moneda:</label>
            <select class="form-select" v-model="formData.moneda" id="moneda" required>
              <option value="COP">COP</option>
              <option value="USD">USD</option>
              <option value="EUR">EUR</option>
            </select>
          </div>

          <div class="camp-2">
            <label class="form-label" for="presupuesto">Presupuesto:</label>
            <input
            class="form-input"
            v-model="formData.presupuesto"
            type="text"
            id="presupuesto"
            required
            @input="formatCurrencyInput"
            >
          </div>
        </div>

        <div class="button">
          <button class="submit-button" :disabled="!isFormValid" @click="showFormCronograma = !showFormCronograma, showForm = !showForm" >
            Guardar
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
  
<script>
import sidebareventos from '../../components/templates/SidebarEventos.vue'
import Service from "./servicios/services";

export default {
  /* Tomo el data de ambos formularios*/
  data() {
    /* datos que se usan para ajustar la hora y fecha */
    const now = new Date();
    const futureDate = new Date(now.getTime() + 24 * 60 * 60 * 1000); // 24 horas después

    return {
      showFormCronograma: false,
      formulario: {
      fechaInicio: now.toISOString().substr(0, 10),
      horaInicio: `${String(now.getHours()).padStart(2, '0')}:${String(now.getMinutes()).padStart(2, '0')}`,
      fechaCierre: futureDate.toISOString().substr(0, 10),
      horaCierre: `${String(futureDate.getHours()).padStart(2, '0')}:${String(futureDate.getMinutes()).padStart(2, '0')}`,
      /* selectedOption: null, */
      options: [],
      valuesOption: []
      }, 
      
      showForm: false,
      formData: {
        objeto: '',
        actividad: '',
        descripcion: '',
        moneda: '',
        presupuesto: null,
        selectedOption: null,
      },
    };
  },

  async mounted() {
    const response = await Service.consult_activity();
    if (response.status == 200){
      this.options = response.data;
    }
    console.log(this.options);
  },
    

  computed: {
    /* Datos necesarios para los default Value del formulario de cronograma */
    minFechaInicio() {
    return new Date().toISOString().substr(0, 10);
    },
    minHoraInicio() {
    return new Date().toISOString().substr(11, 5);
    },
    minFechaCierre() {
    return new Date().toISOString().substr(0, 10);
    },
    minHoraCierre() {
    return new Date().toISOString().substr(11, 5);
    },
    /*  */
    isFormValid() {
      console.log(this.formData.selectedOption)
      return (
        this.formData.selectedOption &&
        this.formData.objeto &&
        /* this.formData.actividad && */
        this.formData.descripcion &&
        this.formData.moneda &&
        this.formData.presupuesto !== null
      );
    },
  },
  methods: {
    /* metodo para registrar un evento en la BD */
    async submitFormCrono() {
      // Validar que los campos en formulario de evento no estén vacíos
      if (
        this.formData.objeto &&
        this.formData.selectedOption &&
        this.formData.descripcion &&
        this.formData.moneda &&
        this.formData.presupuesto
      ) {
      try {
        /* se envian los datos a la API */
        await Service.registro_evento({
          object: this.formData.objeto,
          activity: this.formData.selectedOption,
          description: this.formData.descripcion,
          money: this.formData.moneda,
          budget: this.formData.presupuesto,
          init_date: this.formulario.fechaInicio,
          init_hour: this.formulario.horaInicio,
          finish_date: this.formulario.fechaCierre,
          finish_hour: this.formulario.horaCierre,
          state: 'Activo',
        });
        console.log('Formulario enviado:', this.formulario);
      } catch (error) {
            console.error('Error al enviar el formulario:', error);
      }
      } else {
          alert('Por favor, complete todos los campos antes de enviar el formulario; Incluyendo los campos de la pestaña de "informacion Basica"');
      }
    },

    /* valida que el campo objeto sea alfanumerico */
    validateAlphanumeric(field) {
        this.formData[field] = this.formData[field].replace(/[^a-zA-Z0-9]/g, '');
    },

    /* metodo para asignar comas al campo presupuesto */
    formatCurrencyInput() {
        // Formatear el valor como dinero con puntos como separadores de miles y coma para los centavos
        this.formData.presupuesto = this.formData.presupuesto
        .replace(/[^0-9,.]/g, '') // Eliminar caracteres no numéricos y no comas
        .replace(/^0+/g, '') // Eliminar ceros iniciales
        .replace(/(\.\d{2})\./g, '$1') // Eliminar puntos duplicados para los centavos
        .replace(/,(\d{3})/g, '$1') // Eliminar comas en los miles
        .replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Agregar comas como separadores de miles
    },
  },
  /* registro los componentes que se van a usar */
  components: {
    sidebareventos
  }
};
</script> 
    


<style scoped>
.form-inputs{
    display: flex;
    justify-content: space-around;
}

.form-inputs .camp{
    width: 20%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.form-inputs .camp input{
    width: 90%;
    height: 30px;
    font-size: 20px;
}

</style>

<style scoped>
  .container {
    width: 100%;
    max-width: 400px;
    margin: 0;
    display: flex;
    font-family: Arial, sans-serif;
  }

   .container-form {
    text-align: left;
  } 

 
  .container-blocks-form .first-camps{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
  }

  .camp{
    width: 100%;
  }

  .camp .form-input{
    width: 90%;
  }

  .camp-2{
    width: 100%;
  }

  .camp-2 .form-input{
    width: 80%;
  }

  .camp-2 .form-select{
    width: 80%;
  }

  .secound-camps{
    width: 50%;
    display: flex;

  }
  
  .toggle-button {
    padding: 10px 15%;
    background-color: #ffffff;
    color: rgb(0, 0, 0);
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .button{
    display: flex;
    justify-content: center;
  }
  
  .form {
    margin-top: 30px;
  }
  
  .form-label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    margin-left: 15px;
  }
  
  .form-input,
  .form-textarea,
  .form-select{
    width: 45%;
    padding: 8px;
    margin-bottom: 10px;
    margin-left: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }
  
  .submit-button {
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .submit-button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
  }

  .error-message {
    color: red;
    margin-top: 0.5em;
  }
  </style>
  

