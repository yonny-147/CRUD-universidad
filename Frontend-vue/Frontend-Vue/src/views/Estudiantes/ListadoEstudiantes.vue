<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2>Estudiantes registrados</h2>
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
                            <th>Semestre</th>
                        </tr>
                    </thead>
                    <tbody v-if="this.estudiantes.length > 0">
                        <tr v-for="(estudiante, index) in this.estudiantes" :key="index">
                            <td>{{ estudiante.documento }}</td>
                            <td>{{ estudiante.nombres }}</td>
                            <td>{{ estudiante.telefono }}</td>
                            <td>{{ estudiante.email }}</td>
                            <td>{{ estudiante.direccion }}</td>
                            <td>{{ estudiante.ciudad }}</td>
                            <td>{{ estudiante.semestre }}</td>
                            <td>
                                <RouterLink :to="{ path: 'estudiantes/'+estudiante.id+'/edit' }" class="btn btn-success">Editar</RouterLink>
                                <button type="button" class="btn btn-danger">Borrar</button>
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
    name: 'estudiantes',
    data() {
        return {
            estudiantes: []
        }
    },
    mounted() {
        this.getEstudiantes()
    },
    methods: {
        getEstudiantes() {
            axios.get('http://127.0.0.1:8000/api/estudiantes')
                .then(res => {
                    this.estudiantes = res.data.estudiantes
                })
        }
    }
}
</script>
  