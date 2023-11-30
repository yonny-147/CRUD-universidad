<template>

    <div class="container mt-5">
      <RouterLink to="/listadoAsignaturas" aria-current="page" class="btn btn-primary mb-3">Ver asignaturas</RouterLink>
      <div class="card">
          <div class="card-header">
            <h3>Editar Asignatura</h3>
          </div>
          <div class="card-body">
            <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
              <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
                {{ error[0] }}
              </li>
            </ul>
  
            <div class="mb-3">
              <label class="mb-2">Nombre</label>
              <input class="form-control" placeholder="Digite el nombre" v-model="model.asignatura.nombre"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Descripcion</label>
              <input class="form-control" placeholder="Digite la descripcion" v-model="model.asignatura.descripcion"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Creditos</label>
              <input class="form-control" placeholder="Digite el correo electronico" v-model="model.asignatura.creditos"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Area de conocimiento</label>
              <input class="form-control" placeholder="Digite el area de conocimiento" v-model="model.asignatura.area"/>
            </div>
            <select class="form-select" aria-label="Default select example" v-model="model.asignatura.participacion">
                <option value="Electiva">Electiva</option>
                <option value="Obligatioria">Obligatioria</option>
            </select>
            <div class="mb-3 mt-3">
              <button type="button" class="btn btn-primary" @click="EditarEstudiante">Actualizar</button>
            </div>
      </div>
    </div>
    </div> 
  </template>
  
  <script>
  import axios from 'axios';
  
    export default {
      name: 'AsignaturasEditar',
      data(){
        return {
          asignatura_id: '',
          errorList : '',
          model:{
            asignatura:{
              nombre: '',
              descripcion: '',
              creditos: '',
              area: '',
              participacion: ''
            }
          }
        }
      },
      mounted(){
        this.asignatura_id = this.$route.params.id
        this.getAsignaturasData(this.$route.params.id)
      },
      methods: {
        
        getAsignaturasData(asignatura_id){
          axios.get(`http://127.0.0.1:8000/api/asignaturas/${asignatura_id}/edit`)
          .then(res => {
            console.log(res.data.asignatura)
            this.model.asignatura = res.data.asignatura
          })         
          .catch(function (error) {
            if (error.response) {
              if(error.response.status = 404){
                alert(error.response.data.message)
              }
            }
          })
        },

        EditarEstudiante(){
          
          let mythis = this
          axios.put(`http://127.0.0.1:8000/api/asignaturas/${this.asignatura_id}/edit`, this.model.asignatura)
          .then(res => {
  
            console.log(res.data)
            alert(res.data.message)
  
            this.errorList = ''
          })
          .catch(function (error) {
            if (error.response) {
              if(error.response.status = 422){
                mythis.errorList = error.response.data.errors
              }
              if (error.response.data.status = 404) {
                alert(response.data.message)
              }
            }
          })
        }
      },
    }
  </script>
  