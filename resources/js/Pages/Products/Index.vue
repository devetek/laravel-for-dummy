<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Products
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-6 flex justify-between items-center">
              <inertia-link class="btn-indigo" :href="route('products.create')">
                <span>Create</span>
              </inertia-link>
            </div>
            <table class="w-full whitespace-nowrap">
              <tr class="text-left font-bold">
                <th class="px-6 pt-6 pb-4">ID</th>
                <th class="px-6 pt-6 pb-4">Name</th>
                <th class="px-6 pt-6 pb-4">Desc</th>
                <th class="px-6 pt-6 pb-4" colspan="2">Price</th>
              </tr>
              <tr
                v-for="product in products"
                :key="product.id"
                class="hover:bg-gray-100 focus-within:bg-gray-100"
              >
                <td class="border-t">
                  <inertia-link
                    class="px-6 py-4 flex items-center focus:text-indigo-500"
                    :href="route('products.edit', product.id)"
                  >
                    {{ product.id }}
                    <icon
                      v-if="product.id"
                      name="trash"
                      class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
                    />
                  </inertia-link>
                </td>
                <td class="border-t">
                  <inertia-link
                    class="px-6 py-4 flex items-center focus:text-indigo-500"
                    :href="route('products.edit', product.id)"
                  >
                    {{ product.name }}
                    <icon
                      v-if="product.id"
                      name="trash"
                      class="flex-shrink-0 w-3 h-3 fill-gray-400 ml-2"
                    />
                  </inertia-link>
                </td>
                <td class="border-t">
                  <inertia-link
                    class="px-6 py-4 flex items-center"
                    :href="route('products.edit', product.id)"
                    tabindex="-1"
                  >
                    {{ product.description }}
                  </inertia-link>
                </td>
                <td class="border-t">
                  <inertia-link
                    class="px-6 py-4 flex items-center"
                    :href="route('products.edit', product.id)"
                    tabindex="-1"
                  >
                    {{ product.price }}
                  </inertia-link>
                </td>
                <td class="border-t w-px">
                  <inertia-link
                    class="px-4 flex items-center"
                    :href="route('products.edit', product.id)"
                    tabindex="-1"
                  >
                    <icon
                      name="cheveron-right"
                      class="block w-6 h-6 fill-gray-400"
                    />
                  </inertia-link>
                </td>
              </tr>
              <tr v-if="products.length === 0">
                <td class="border-t px-6 py-4" colspan="4">
                  No products found.
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import throttle from "lodash.throttle";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";

export default {
  components: {
    BreezeAuthenticatedLayout,
  },
  props: {
    products: Object,
  },
};
</script>
