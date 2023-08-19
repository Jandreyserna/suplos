<template>
    <div>
      <div class="top-bar" @click="toggleSubMenu">
        <span class="top-bar-text">Procesos / Eventos</span>
      </div>
      <div class="menu-bar">
        <div class="menu-item">
          <div class="acceder">
            <span class="access-button" v-if="showMenu">Acceder</span>
          </div>
          <div class="sub-menu" v-if="showSubMenu">
            <!-- me direcciona a la vista del formulario de crear -->
            <router-link to="/creaciones">
                <button class="sub-menu-button">
                <font-awesome-icon icon="plus" /> Crear
                </button>
            </router-link>
            <!-- me direcciona a la vista del formulario de consultas -->
            <router-link to="/consultas">
              <button class="sub-menu-button">
                <font-awesome-icon icon="search" /> Consultar
              </button>
            </router-link>
            <button class="sub-menu-button">
              <font-awesome-icon icon="copy" /> Copiar
            </button>
          </div>
        </div>
      </div>
    </div>
</template>

<script>

export default {
  data() {
    return {
      showMenu: true,
      showSubMenu: false
    };
  },
  methods: {
    toggleSubMenu() {
      this.showMenu = !this.showMenu;
      this.showSubMenu = !this.showSubMenu;
    }
  }
};
</script>


<style>

.sub-menu-button{
  display: flex;
  flex-direction: column;
  align-items: center;
}

.top-bar {
  display: flex;
  justify-content: center; 
  align-items: center; 
  background-color: #2D5499;
  height: 40px;
  color: #FFF;
}

.top-bar-text {
  font-size: 18px;
  font-weight: bold;
}

.menu-bar {
  display: flex;
  justify-content: center;
  background-color: #2D5499;
  color: #fff;
  padding: 10px;
  height: 40px;
}

.menu-item {
  position: relative;
  cursor: pointer;
  margin-right: 20px;
}

.access-button {
  display: inline-block;
  padding: 8px 16px;
  background-color: #2D5499;
  border-radius: 5px;
  cursor: pointer;
}


.sub-menu {
  top: 100%;
  left: 0;
  display: flex;
  flex-direction: row;
  background-color: #444;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
  z-index: 1;
}

.sub-menu-button {
  border: none;
  background-color: transparent;
  color: #fff;
  padding: 8px 16px;
  text-align: left;
  cursor: pointer;
}

.sub-menu-button svg{
  height: 2em;
}

.sub-menu-button:hover {
  background-color: #555;
}
</style>


