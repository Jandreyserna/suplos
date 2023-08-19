<template>
    <div id="top-menu">
      <div class="logo-container">
        <img src="@/assets/suplos.png" alt="Suplos Logo" class="logo">
      </div>

      <ul class="menu-items">
        <router-link v-if="$route.path === '/'" to="/registrate">Registro</router-link>
        <router-link  v-if="$route.path === '/registrate'" to="/">Volver</router-link>
      </ul>
    </div>
  </template>

  <style>
  #top-menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    background-color: #245DA8;
    color: #fff;
  }
  
  .logo-container {
    display: flex;
    align-items: center;
  }
  
  .logo {
    width: 100px;
  }
  
  .menu-items {
    list-style: none;
    display: flex;
    gap: 20px;
  }
  
  .menu-items li a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
  }
  

  </style>
  
  