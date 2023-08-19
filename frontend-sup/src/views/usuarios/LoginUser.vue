<template>
  <menulogo></menulogo>
  <div class="container-login">
    <div class="log-container">
        <img src="@/assets/sup.png" alt="Suplos Logo" class="logo">
    </div>

    <h2>Iniciar sesión</h2>
    <form @submit.prevent="submitForm">
      <div class="camp-1">
        <label for="User">Usuario:</label>
        <input type="text" id="User" v-model="credentials.email" required><br><br>
      </div>

      <div class="camp-1">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" v-model="credentials.password" required><br><br>
      </div>  
        
      <button type="submit">Iniciar sesión</button>
    </form>
  </div>
</template>
  
<script>
  import menulogo from '../../components/templates/MenuLogo.vue';
  export default {
    data() {
      return {
        credentials: {
          email: '',
          password: ''
        }
      };
    },
    methods: {
      submitForm() {
        console.log('Credenciales de inicio de sesión:', this.credentials);
      }
    },
    components :{
      menulogo/* ,
      registrate */
    }
  };
</script>

<style>
.container-login{
  margin: 5% auto;
  width: 25%;
  height: 450px;
  background-color: #000000;
  box-shadow: 5px 5 px 10px  black;
  padding: 30px;
  border-radius: 5px;
  font-size: large;
  color: #245DA8;
}

.log-container{
  margin: auto;
  padding: 20px;
}

.log-container .logo{
  width: 60%;
}

.camp-1{
  display: flex;
  flex-direction: column;
}

.camp-1 input{
  width: 90%;
  margin: auto;
  height: 20px;
  border-radius: 6px;
}

.camp-1 label{
  margin: 0 5%;
  display: flex;
  justify-content: flex-start;
}

.container-login form button{
  height: 50px;
  width: 50%;
  font-size: larger;
}

</style>
  