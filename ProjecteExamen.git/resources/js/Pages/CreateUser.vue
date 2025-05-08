<script setup>

import { useForm } from '@inertiajs/vue3';

const form = useForm({ //Form for add user
    name: '',
    surname: '',
    age: '',
    email: '',
    password: '',
});

const handleFormSubmit = () => {
    form.post(route('UserId.add'), {
        onSuccess: () => {
            form.reset();
        }
    });
};

</script>

<template>
    <form @submit.prevent="handleFormSubmit" enctype="multipart/form-data">
        <label>Nom</label>
        <input aria-label="name" v-model="form.name" type="text" name="name"
            class="border border-gray-300 p-2 w-full rounded-lg mb-2" id="name" />
            <label>Cognom</label>
        <input aria-label="surname" v-model="form.surname" type="text" name="surname"
            class="border border-gray-300 p-2 w-full rounded-lg mb-2" id="surname" />
            <label>Edat</label>
        <input aria-label="age" v-model="form.age" type="number" name="age"
            class="border border-gray-300 p-2 w-full rounded-lg mb-2" id="age" />
        <label>Correu Electrònic</label>
        <input aria-label="email" v-model="form.email" type="email" name="email"
            class="border border-gray-300 p-2 w-full rounded-lg mb-2" id="email" />
        <label>Contrasenya</label>
        <input aria-label="Password" v-model="form.password" type="password" name="password"
            class="border border-gray-300 p-2 w-full rounded-lg mb-2" id="password" />

        <button type="submit" class="bg-[#FFD4A5] text-title p-2 rounded-lg w-full mt-8">
            Crear Usuari
        </button>
    </form>

    <!-- <div v-if="form.hasErrors" class="text-red-500 mt-4">
      <div v-for="(message, key) in form.errors" :key="key">{{ message }}</div>
    </div> -->
</template>