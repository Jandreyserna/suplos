<template>
  <menulogo></menulogo>
  <div class="registro-user">
    <div class="log-container">
        <img src="@/assets/sup.png" alt="Suplos Logo" class="logo">
    </div>

    <h2>Registro</h2>
    <form @submit.prevent="submitForm">

      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" v-model="Registro.nombre" required><br><br>
      
      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" v-model="Registro.email" required><br><br>
      
      <label for="password">Contraseña:</label>
      <input type="password" id="password" v-model="Registro.password" required><br><br>
      
      <button type="submit">Registrarse</button>
    </form>
  </div>
</template>
  
<script>
  import menulogo from '../../components/templates/MenuLogo.vue';

  export default {
    data() {
      return {
        Registro: {
          nombre: '',
          email: '',
          password: ''
        }
      };
    },
    methods: {
      submitForm() {
        
        console.log('Datos de registro:', this.registro);
      }
    },
    components :{
      menulogo
    }
  };
</script>


<style>
.registro-user{
  display: flex;
  justify-content: center;
  flex-direction: column;
  margin: 5% auto;
  width: 25%;
  height: 600px;
  background-color: #000000;
  box-shadow: 5px 5 px 10px  black;
  padding: 30px;
  border-radius: 6px;
  font-size: large;
  color: #245DA8;

}

.registro-user form{
  margin-top: 15px;
  display: flex;
  justify-content: center;
  flex-direction: column;
  margin-left: 5%;
}

.registro-user form label{
  display: flex;
  align-items: flex-start;
}

.registro-user form input{
  width: 90%;
  height: 20px;
  border-radius: 5px;
}

.registro-user form button{
  width: 40%;
  margin: auto;
  height: 30px;
}

</style>
  