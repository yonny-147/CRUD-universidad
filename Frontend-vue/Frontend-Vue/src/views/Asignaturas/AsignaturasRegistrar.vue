<template>

    <div class="container mt-5">
      <div class="card">
          <div class="card-header">
            <h3>Registrar Asignatura</h3>
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
                <option value="1">Electiva</option>
                <option value="2">Obligatioria</option>
            </select>
            <div class="mb-3 mt-3">
              <button type="button" class="btn btn-primary" @click="RegistrarAsignatura">Registrar</button>
            </div>
      </div>
    </div>
    </div> 
  </template>
  
  <script>
  import axios from 'axios';
  
    export default {
      name: 'asignaturas',
      data(){
        return {
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
      methods: {
        
        RegistrarAsignatura(){
  
          let mythis = this
          axios.post('http://127.0.0.1:8000/api/asignaturas', this.model.asignatura)
          .then(res => {
  
            console.log(res.data)
            alert(res.data.message)
  
            this.model.asignatura = {
                nombre: '',
                descripcion: '',
                creditos: '',
                area: '',
                participacion: ''
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
  
