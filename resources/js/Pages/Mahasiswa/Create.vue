<template>
  <breeze-authenticated-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Tambah Mahasiswa
      </h2>
    </template>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <form @submit.prevent="submit">
              <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
                <div class="form-group">
                  <div>NIS</div>
                  <input type="text" v-model="form.nis" />
                  <div v-if="errors.nis">{{ errors.nis }}</div>
                </div>
                <div class="form-group">
                  <div>Nama Lengkap</div>
                  <input type="text" v-model="form.fullname" />
                  <div v-if="errors.fullname">{{ errors.fullname }}</div>
                </div>
                <div class="form-group">
                  <div>Jurusan</div>
                  <input type="text" v-model="form.major" />
                  <div v-if="errors.major">{{ errors.major }}</div>
                </div>
                <div class="form-group">
                  <div>Alamat</div>
                  <textarea v-model="form.address" />
                  <div v-if="errors.address">
                    {{ errors.address }}
                  </div>
                </div>
              </div>
              <div
                class="form-group px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
              >
                <loading-button
                  :loading="form.processing"
                  class="btn-indigo"
                  type="submit"
                  >Simpan</loading-button
                >
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </breeze-authenticated-layout>
</template>

<style scoped>
</style>

<script>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import TextInput from "@/Shared/TextInput";
import LoadingButton from "@/Shared/LoadingButton";

export default {
  components: {
    BreezeAuthenticatedLayout,
    LoadingButton,
    TextInput,
  },
  remember: "form",
  props: {
    errors: Object,
  },
  setup(props) {
    const form = useForm({
      nis: null,
      fullname: null,
      major: null,
      address: null,
    });

    function submit() {
      Inertia.post("/mahasiswa", {
        nis: parseInt(form.nis, 10),
        fullname: form.fullname,
        major: form.major,
        address: form.address,
      });
    }

    return { form, submit };
  },
};
</script>
