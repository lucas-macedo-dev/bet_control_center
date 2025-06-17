<script setup lang="ts">
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const bets = page.props.bets || [];
console.log(bets);

</script>

<template>
    <Head title="Lista de apostas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-2xl font-semibold text-gray-800">Lista de Apostas</h2>
        </template>

        <div class="p-6 space-y-4">
            <div class="flex justify-end">
                <Link :href="route('bets.create')" class="btn btn-primary">
                    Nova Aposta
                </Link>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow rounded-xl">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">ID</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Valor Apostado</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Valor Recebido</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Data</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="bet in bets" :key="bet.id" class="border-t">
                            <td class="px-4 py-2">{{ bet.id }}</td>
                            <td class="px-4 py-2">{{ bet.bet_value }}</td>
                            <td class="px-4 py-2">{{ bet.value_received }}</td>
                            <td class="px-4 py-2">{{ bet.created_at }}</td>
                            <td class="px-4 py-2">
                                <Link :href="route('bets.show', bet.id)" class="text-blue-600 hover:underline">Ver</Link>
                            </td>
                        </tr>
                        <tr v-if="bets.length === 0">
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">Nenhuma aposta encontrada.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.btn {
    @apply px-4 py-2 rounded-xl font-semibold shadow transition duration-200;
}

.btn-primary {
    @apply bg-blue-600 text-white hover:bg-blue-700;
}
</style>
