/* se importan los archivos para sus rutas en from */
import { createRouter, createWebHistory } from 'vue-router';
import Registro from './views/usuarios/RegistroUser.vue';
import Login from './views/usuarios/LoginUser.vue';
import creaciones from './views/procesos/VistaEventos.vue';
import procesos from './components/templates/SidebarEventos.vue';
import sidebar from './components/templates/SidebarEventos.vue';
import consultas from './views/procesos/VistaConsultas.vue';


/* se definen las rutas */
const routes = [
  {
    path: '/',
    component: sidebar,
  },
  {
    path: '/login',
    component: Login,
  },
  {
    path: "/registrate",
    name: "Registro",
    component: Registro
  },
  {
    path: "/creaciones",
    name: "crear",
    component: creaciones
  },
  {
    path: "/procesos",
    name: "proceso",
    component: procesos
  },
  {
    path: "/consultas",
    name: "consulta",
    component: consultas
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});


export default router;
