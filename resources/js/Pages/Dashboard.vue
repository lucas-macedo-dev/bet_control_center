<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const stats = page.props.stats || { total_apostado: 0, total_recebido: 0 };
const prejuizo = computed(() => stats.total_apostado - stats.total_recebido);
</script>

<template>

  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>

      <div class="p-6 space-y-6">
        <div v-if="!$page.props.auth.user" class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-xl font-semibold mb-2">Estimativa Global de Perdas com Apostas</h2>
            <p class="text-3xl text-red-600 font-bold">US$ 1.2 Trilhão</p>
            <p class="text-sm text-gray-500 mt-1">Dados de 2024 - Inclui apostas legais e ilegais</p>
          </div>
          <div class="bg-white rounded-2xl p-6 shadow">
            <h2 class="text-xl font-semibold mb-2">Apostadores em Risco</h2>
            <p class="text-3xl text-yellow-500 font-bold">22%</p>
            <p class="text-sm text-gray-500 mt-1">Estudos apontam que 1 em cada 5 apostadores desenvolve comportamentos
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

        <div v-else class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 shadow">
              <h2 class="text-lg font-semibold text-gray-700">Total Apostado</h2>
              <p class="text-3xl font-bold text-blue-600">R$ {{ stats.total_apostado }}</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow">
              <h2 class="text-lg font-semibold text-gray-700">Total Recebido</h2>
              <p class="text-3xl font-bold text-green-600">R$ {{ stats.total_recebido }}</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow">
              <h2 class="text-lg font-semibold text-gray-700">Prejuízo</h2>
              <p :class="prejuizo >= 0 ? 'text-red-600' : 'text-gray-500'" class="text-3xl font-bold">
                R$ {{ prejuizo.toFixed(2) }}
              </p>
            </div>
          </div>

          <div class="flex space-x-4">
            <Link class="btn btn-primary" :href="route('bets.create')">Cadastrar Nova Aposta</Link>
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