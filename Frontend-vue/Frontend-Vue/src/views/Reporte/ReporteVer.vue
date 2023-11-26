<template>
  <main>
    <div class="container mt-5">
      <div class="card">
        <div class="card-header">
          <h2>Registrar asignaturas de estudiantes con su respectivo profesor</h2>
        </div>
          <div class="card-body">
            <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
              <li class="mb-0 ms-3" v-for="(error, indexReportes) in this.errorList" :key="indexReportes">
                {{ error[0] }}
              </li>
            </ul>
          <div class="card-boy">
            <table class="table table-bordered text-center">
            <thead>
              <tr>
                <th>Estudiante</th>
                <th>Profesor</th>
                <th>Asignatura</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <select class="form-select" aria-label="Default select example" v-model="model.reporte.estudiante">
                    <option v-for="(estudiantes, index) in this.estudiantes" :key="index">
                      {{ estudiantes.nombres }}
                    </option>
                  </select>
                </td>
                <td>
                  <select class="form-select" aria-label="Default select example" v-model="model.reporte.profesor" >
                    <option v-for="(profesores,indexProfesores) in this.profesores" :key="indexProfesores">
                      {{ profesores.nombres }}
                    </option>
                  </select>
                </td>     
                <td>
                  <select class="form-select" aria-label="Default select example" v-model="model.reporte.asignatura" >
                    <option v-for="(asignaturas,indexAsignaturas) in this.asignaturas" :key="indexAsignaturas">
                      {{ asignaturas.nombre }}
                    </option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
          </div>
          <button type="button" class="btn btn-primary w-25 mt-1 content-center" @click="RegistrarReporte">Registrar</button>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
  import axios from "axios"

  export default {
    name: 'reportes',
    data(){
      return{
        errorList : '',
        estudiantes: [],
        profesores: [],
        asignaturas: [],
        
        model:{
          reporte:{
            estudiante: '',
            profesor: '',
            asignatura: ''
          }
        }
      }
    },
    mounted(){
      this.getEstudiantes()
      this.getProfesores()
      this.getAsignaturas()
    },
    methods: {
      RegistrarReporte(){

        let mythis = this
        axios.post('http://127.0.0.1:8000/api/reportes', this.model.reporte)
        .then(res => {

          console.log(res.data)
          alert(res.data.message)

          this.model.reporte = {
            estudiante: '',
            profesor: '',
            asignatura: ''
          }
          this.errorList = ''
        })
        .catch(function (error) {
          if (error.response) {
            if(error.response.status = 422){
              mythis.errorList = error.response.data.errors
            }else if (error.request) {
                console.log(error.request)
              } else {
                console.log('Error', error.message)
              }
          }
        })
        },

      getEstudiantes(){
        axios.get('http://127.0.0.1:8000/api/estudiantes')
          .then(res => {
            this.estudiantes = res.data.estudiantes
          })
      },
      getProfesores(){
        axios.get('http://127.0.0.1:8000/api/profesores')
          .then(res => {
            this.profesores = res.data.profesores
          })
      },
      getAsignaturas(){
        axios.get('http://127.0.0.1:8000/api/asignaturas')
          .then(res => {
            this.asignaturas = res.data.asignaturas
          })
      }
    }
  }

</script>
