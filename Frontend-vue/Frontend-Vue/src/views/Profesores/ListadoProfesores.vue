<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>profesors registrados</h2>
            </div>
            <div class="card-boy">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombres</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Direccion</th>
                            <th>Ciudad</th>
                        </tr>
                    </thead>
                    <tbody v-if="this.profesores.length > 0">
                        <tr v-for="(profesor, index) in this.profesores" :key="index">
                            <td>{{ profesor.documento }}</td>
                            <td>{{ profesor.nombres }}</td>
                            <td>{{ profesor.telefono }}</td>
                            <td>{{ profesor.email }}</td>
                            <td>{{ profesor.direccion }}</td>
                            <td>{{ profesor.ciudad }}</td>
                            <td>
                                <RouterLink :to="{ path: 'profesores/'+profesor.id+'/edit' }" class="btn btn-success">Editar</RouterLink>
                                <button type="button" @click="deleteProfesor(profesor.id)" class="btn btn-danger">Borrar</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="7">...cargando</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
  
<script>
import axios from 'axios';

export default {
    name: 'profesores',
    data() {
        return {
            profesores: []
        }
    },
    mounted() {
        this.getProfesores()
    },
    methods: {
        getProfesores() {
            axios.get('http://127.0.0.1:8000/api/profesores')
                .then(res => {
                    this.profesores = res.data.profesores
                })
        },

        deleteProfesor(profesor_id){
            if(confirm('¿Estás seguro que quieres borrar este profesor?')){
                axios.delete(`http://127.0.0.1:8000/api/profesores/${profesor_id}/delete`).
                then(res => {
                    alert(res.data.message)
                    this.getProfesores()
                })          
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status = 404) {
                            alert(error.response.data.message)
                        }
                    }
                })
            }
        }
    }
}
</script>
  