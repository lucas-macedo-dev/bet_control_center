<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';

const form = useForm({
  bet_value: null,
  value_received: null,
  description: '',
});

const submit = () => {
  form.post(route('bets.store'), {
    onSuccess: () => {
      form.reset();
      router.visit(route('dashboard'));
    },
  });
};
</script>

<template>

  <Head title="Nova Aposta" />
  <AuthenticatedLayout>
    <div class="p-6 max-w-2xl mx-auto">
      <h1 class="text-2xl font-bold mb-6">Cadastrar Nova Aposta</h1>

      <form @submit.prevent="submit" class="space-y-6">
        <div>
          <label class="block mb-1 font-semibold" for="bet_value">Valor Apostado (R$)</label>
          <input type="number" id="bet_value" v-model.number="form.bet_value"
            class="w-full border-gray-300 rounded-xl shadow" step="0.01" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold" for="value_received">Valor Recebido (R$)</label>
          <input type="number" id="value_received" v-model.number="form.value_received"
            class="w-full border-gray-300 rounded-xl shadow" step="0.01" required />
        </div>

        <div>
          <label class="block mb-1 font-semibold" for="description">Descrição (opcional)</label>
          <input type="text" id="description" v-model="form.description" class="w-full border-gray-300 rounded-xl shadow"
            maxlength="255" />
        </div>

        <div>
          <button type="submit" class="btn btn-primary">Salvar Aposta</button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.btn-primary {
  @apply bg-green-600 text-white px-4 py-2 rounded-xl hover:bg-green-700 transition;
}
</style>