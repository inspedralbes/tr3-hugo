<template>
    <div class="background">
        <div class="register-container">
        <h2 class="register-title">Registrarse</h2>
        <input v-model="registerForm.name" type="text" placeholder="Nombre" required class="register-input">
        <input v-model="registerForm.email" type="email" placeholder="Correo electrónico" required class="register-input">
        <input v-model="registerForm.password" type="password" placeholder="Contraseña" required class="register-input">
        <button type="submit" @click="submitForm()" class="register-button">Register</button>
    </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            registerForm: {
                name: '',
                email: '',
                password: ''
            }
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await fetch(`http://localhost:8000/api/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(this.registerForm)
                });

                // Verificar si la solicitud fue exitosa
                if (response.ok) {
                    // Manejar la respuesta del inicio de sesión
                    const data = await response.json();
                    console.log(data);
                    console.log('Registro exitoso');
                } else {
                    // Manejar errores de la solicitud
                    console.error('Error al iniciar sesión:', response.statusText);
                }
            } catch (error) {
                // Manejar errores de la solicitud
                console.error('Error al iniciar sesión:', error);
            }



        },

    }
}
</script>
<style scoped>
.background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('https://wallpaperaccess.com/full/6400181.jpg'); /* Cambia 'ruta/a/tu/imagen.jpg' por la ruta de tu imagen de fondo */
    background-size: cover; /* Ajusta la imagen para que cubra toda la pantalla */
    background-position: center; /* Centra la imagen */
  }
  
.register-container {
    text-align: center;
    padding: 20px;
    background-color: #000;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width: 35%;
    position: relative;
    left: 29%;
    margin-top: 15%;
}

.register-title {
  color: #ff00ff; /* Color rosa neon */
  margin-bottom: 20px;
}

.register-input {
    width: 84%;
  padding: 10px;
  margin-bottom: 10px;
  border: 2px solid #ff00ff; /* Borde rosa neon */
  border-radius: 5px;
  background-color: #111; /* Fondo oscuro */
  color: #fff; /* Texto blanco */
}

.register-button {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  background-color: #ff00ff; /* Botón rosa neon */
  color: #000; /* Texto negro */
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.register-button:hover {
  background-color: #ff88ff; /* Transición a un tono más claro de rosa neon */
}
</style>