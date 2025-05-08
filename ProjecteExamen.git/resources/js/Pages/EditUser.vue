<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  users: Array,
});

const form = useForm({
    name: '',
    surname: '',
    age: '',
    email: '',
    password: '',
});

const handleFormSubmit = (userId) => {
    form.post(route('UserId.update', userId), {
        onSuccess: (response) => {
            form.password = '';
            window.location.href = route('users.show');
        }
    });
};

form.name = props.users[0].name;
form.surname = props.users[0].surname;
form.age = props.users[0].age;
form.email = props.users[0].email;

</script>
<template>
    <div class="min-h-screen flex items-center justify-center bg-white">
      <div class="bg-gray-700 shadow-2xl rounded-2xl p-8 w-full max-w-5xl border border-gray-300">
        <div v-for="user in users" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-9 mt-7 pt-28">
        <h2 class="text-3xl font-semibold text-center text-white mb-6">Editar Usuari</h2>
        <form @submit.prevent="handleFormSubmit(user.id)" id="editForm" class="text-white">
            <label for="name">Nom</label><br>
            <input class="text-black border border-gray-300 p-2 w-full rounded-lg mb-8" type="text" name="name" id="name" v-model="form.name"><br>
            <label for="surname">Cognom</label><br>
            <input class="text-black border border-gray-300 p-2 w-full rounded-lg mb-8" type="text" name="surname" id="surname" v-model="form.surname"><br>
            <label for="age">Edat</label><br>
            <input class="text-black border border-gray-300 p-2 w-full rounded-lg mb-8" type="text" name="age" id="age" v-model="form.age"><br>
            <label for="email">Email</label><br>
            <input class="text-black border border-gray-300 p-2 w-full rounded-lg mb-8" type="text" name="email" id="email" v-model="form.email"><br>
            <label for="password">Contrasenya</label>
            <input class="text-black border border-gray-300 p-2 w-full rounded-lg mb-8" type="password" name="password" id="password" v-model="form.password">
            <button type="submit" form="editForm" class="bg-[#FFD4A5] text-black p-2 rounded-lg w-full mt-8">Modificar Usuari</button>
        </form>
    </div>
    </div>
</div>
</template>