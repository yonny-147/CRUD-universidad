import { createRouter, createWebHistory } from 'vue-router'

import EstudiantesRegistrar from '../views/Estudiantes/EstudiantesRegistrar.vue'
import ListadoEstudiantes from '../views/Estudiantes/ListadoEstudiantes.vue'
import EstudiantesEditar from '../views/Estudiantes/EstudiantesEditar.vue'
import ProfesoresRegistrar from '../views/Profesores/ProfesoresRegistrar.vue'
import ListadoProfesores from '../views/Profesores/ListadoProfesores.vue'
import ProfesoresEditar from '../views/Profesores/ProfesoresEditar.vue'
import AsignaturasRegistrar from '../views/Asignaturas/AsignaturasRegistrar.vue'
import ListadoAsignaturas from '../views/Asignaturas/ListadoAsignaturas.vue'
import AsignaturasEditar from '../views/Asignaturas/AsignaturasEditar.vue'



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
      name: 'estudiantesEditar',
      component: EstudiantesEditar
    },
    {
      path: '/profesores',
      name: 'profesores',
      component: ProfesoresRegistrar
    },
    {
      path: '/listadoProfesores',
      name: 'listadoProfesores',
      component: ListadoProfesores
    },
    {
      path: '/profesores/:id/edit',
      name: 'profesoresEditar',
      component: ProfesoresEditar
    },
    {
      path: '/asignaturas',
      name: 'asignaturas',
      component: AsignaturasRegistrar
    },
    {
      path: '/listadoAsignaturas',
      name: 'listadoAsignaturas',
      component: ListadoAsignaturas
    },
    {
      path: '/asignaturas/:id/edit',
      name: 'asignaturasEditar',
      component: AsignaturasEditar
    }
  ]
})

export default router
