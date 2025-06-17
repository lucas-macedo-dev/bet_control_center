<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const stats = page.props.stats || { bet_value: 0, value_received: 0 , loss : 0};
</script>

<template>

  
  <Head title="Dashboard"/>
  <AuthenticatedLayout>
    <template #header>

      <div v-if="$page.props.auth.user" class="p-6 space-y-6">
        <div class="flex justify-end space-x-4">
          <Link class="btn btn-primary" :href="route('bets.create')">Reportar Nova Aposta</Link>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total Apostado</h2>
            <p class="text-3xl font-bold text-blue-600">R$ {{ stats.bet_value }}</p>
          </div>
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-lg font-semibold text-gray-700">Total Recebido</h2>
            <p class="text-3xl font-bold text-green-600">R$ {{ stats.value_received }}</p>
          </div>
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-lg font-semibold text-gray-700">Prejuízo</h2>
            <p :class="stats.loss >= 0 ? 'text-red-600' : 'text-gray-500'" class="text-3xl font-bold">
              R$ {{ stats.loss.toFixed(2) }}
            </p>
          </div>
        </div>
      </div>
      <hr v-if="$page.props.auth.user" class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded-sm md:my-10 dark:bg-gray-700">
      <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-xl font-semibold mb-2">Estimativa Global de Perdas com Apostas</h2>
            <p class="text-3xl text-red-600 font-bold">US$ 1.2 Trilhão</p>
            <p class="text-sm text-gray-500 mt-1">Dados de 2024 - Inclui apostas legais e ilegais</p>
          </div>
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-xl font-semibold mb-2">Apostadores em Risco</h2>
            <p class="text-3xl text-yellow-500 font-bold">22%</p>
            <p class="text-sm text-gray-500 mt-1">Estudos apontam que 1 em cada 5 apostadores desenvolve
              comportamentos
              prejudiciais</p>
          </div>
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-xl font-semibold mb-2">Impacto em Jovens</h2>
            <p class="text-3xl text-blue-600 font-bold">35%</p>
            <p class="text-sm text-gray-500 mt-1">Dos usuários de plataformas de apostas têm entre 15 e 24 anos</p>
          </div>
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-xl font-semibold mb-2">Problemas Financeiros Relacionados</h2>
            <p class="text-3xl text-purple-600 font-bold">68%</p>
            <p class="text-sm text-gray-500 mt-1">Dos apostadores compulsivos relatam dívidas significativas</p>
          </div>
        </div>
      </div>
    </template>
  </AuthenticatedLayout>
</template>
<style scoped>
.btn {
  @apply px-4 py-2 rounded-xl font-semibold shadow transition duration-200;
}

.btn-primary {
  @apply bg-blue-600 text-white hover:bg-blue-700;
}

.btn-secondary {
  @apply bg-gray-200 text-gray-800 hover:bg-gray-300;
}
</style>