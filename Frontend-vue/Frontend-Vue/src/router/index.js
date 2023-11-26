import { createRouter, createWebHistory } from 'vue-router'

import EstudiantesRegistrar from '../views/Estudiantes/EstudiantesRegistrar.vue'
import ListadoEstudiantes from '../views/Estudiantes/ListadoEstudiantes.vue'
import EstudiantesEditar from '../views/Estudiantes/EstudiantesEditar.vue'
import ProfesoresRegistrar from '../views/Profesores/ProfesoresRegistrar.vue'
import AsignaturasRegistrar from '../views/Asignaturas/AsignaturasRegistrar.vue'


import ReporteVer from '../views/Reporte/ReporteVer.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),

  routes: [
    {
      path: '/',
      name: 'reportes',
      component: ReporteVer
    },
    {
      path: '/estudiantes',
      name: 'estudiantes',
      component: EstudiantesRegistrar
    },
    {
      path: '/listadoEstudiantes',
      name: 'listadoEstudiantes',
      component: ListadoEstudiantes
    },
    {
      path: '/estudiantes/:id/edit',
      name: 'estudiantesEdit',
      component: EstudiantesEditar
    },

    {
      path: '/profesores',
      name: 'profesores',
      component: ProfesoresRegistrar
    },
    {
      path: '/asignaturas',
      name: 'asignaturas',
      component: AsignaturasRegistrar
    },
  ]
})

export default router
