<template>

  <div class="container mt-5">
    <div class="card">
        <div class="card-header">
          <h3>Registrar Profesor</h3>
        </div>
        <div class="card-body">
          <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0">
            <li class="mb-0 ms-3" v-for="(error, indexProfesores) in this.errorList" :key="indexProfesores">
              {{ error[0] }}
            </li>
          </ul>

          <div class="mb-3">
            <label class="mb-2">Documento de identificacion</label>
            <input class="form-control" placeholder="Digite el numero de documento" v-model="model.profesor.documento"/>
          </div>
          <div class="mb-3">
            <label class="mb-2">Nombre Completo</label>
            <input class="form-control" placeholder="Digite el nombre completo" v-model="model.profesor.nombres"/>
          </div>
          <div class="mb-3">
            <label class="mb-2">Numero de telefono</label>
            <input class="form-control" placeholder="Digite el numero de telefono" v-model="model.profesor.telefono"/>
          </div>
          <div class="mb-3">
            <label class="mb-2">Correo electronico</label>
            <input class="form-control" placeholder="Digite el correo electronico" v-model="model.profesor.email"/>
          </div>
          <div class="mb-3">
            <label class="mb-2">Direccion</label>
            <input class="form-control" placeholder="Digite la direccion" v-model="model.profesor.direccion"/>
          </div>
          <div class="mb-3">
            <label class="mb-2">Ciudad</label>
            <input class="form-control" placeholder="Digite la ciudad" v-model="model.profesor.ciudad"/>
          </div>
          <div class="mb-3">
            <button type="button" class="btn btn-primary" @click="RegistrarProfesor">Registrar</button>
          </div>
        </div>
    </div>
  </div> 
</template>

<script>
import axios from 'axios';

  export default {
    name: 'profesores',
    data(){
      return {
        errorList : '',
        model:{
          profesor:{
            documento: '',
            nombres: '',
            telefono: '',
            email: '',
            direccion: '',
            ciudad: ''
          }
        }
      }
    },
    methods: {
      
      RegistrarProfesor(){

        let mythis = this
        axios.post('http://127.0.0.1:8000/api/profesores', this.model.profesor)
        .then(res => {

          console.log(res.data)
          alert(res.data.message)

          this.model.profesor = {
            documento: '',
            nombres: '',
            telefono: '',
            email: '',
            direccion: '',
            ciudad: ''
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
