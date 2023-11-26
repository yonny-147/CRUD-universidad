<template>

    <div class="container mt-5">
      <RouterLink to="/listadoEstudiantes" aria-current="page" class="btn btn-primary mb-3">Ver estudiantes</RouterLink>
      <div class="card">
          <div class="card-header">
            <h3>Registrar Estudiante</h3>
          </div>
          <div class="card-body">
            <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
              <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
                {{ error[0] }}
              </li>
            </ul>
  
            <div class="mb-3">
              <label class="mb-2">Documento de identificacion</label>
              <input class="form-control" placeholder="Digite el numero de documento" v-model="model.estudiante.documento"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Nombre Completo</label>
              <input class="form-control" placeholder="Digite el nombre completo" v-model="model.estudiante.nombres"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Numero de telefono</label>
              <input class="form-control" placeholder="Digite el numero de telefono" v-model="model.estudiante.telefono"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Correo electronico</label>
              <input class="form-control" placeholder="Digite el correo electronico" v-model="model.estudiante.email"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Direccion</label>
              <input class="form-control" placeholder="Digite la direccion" v-model="model.estudiante.direccion"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Ciudad</label>
              <input class="form-control" placeholder="Digite la ciudad" v-model="model.estudiante.ciudad"/>
            </div>
            <div class="mb-3">
              <label class="mb-2">Semestre</label>
              <input class="form-control" placeholder="Digite el semestre" v-model="model.estudiante.semestre"/>
            </div>
            <div class="mb-3">
              <button type="button" class="btn btn-primary" @click="EditarEstudiante">Editar</button>
            </div>
      </div>
    </div>
    </div> 
  </template>
  
  <script>
  import axios from 'axios';
  
    export default {
      name: 'EstudiantesEditar',
      data(){
        return {
          errorList : '',
          model:{
            estudiante:{
              documento: '',
              nombres: '',
              telefono: '',
              email: '',
              direccion: '',
              ciudad: '',
              semestre: ''
            }
          }
        }
      },
      mounted(){
        this.getDataEstudiantes(this.$route.params.id)
      },
      methods: {
        
        getEstudiantesData(estudiante_id){
          axios.get(`http://localhost:${estudiante_id}/edit`)
          .then(res => {
            console.log(res)
          })
          .catch(err => {});
        },

        EditarEstudiante(){
  
          let mythis = this
          axios.post('http://127.0.0.1:8000/api/estudiantes', this.model.estudiante)
          .then(res => {
  
            console.log(res.data)
            alert(res.data.message)
  
            this.model.estudiante = {
              documento: '',
              nombres: '',
              telefono: '',
              email: '',
              direccion: '',
              ciudad: '',
              semestre: ''
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
        }
      },
    }
  </script>
  