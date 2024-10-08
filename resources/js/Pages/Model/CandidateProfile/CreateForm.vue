<script setup>
import InputError from '@/Components/FormElements/InputError.vue';
import InputLabel from '@/Components/FormElements/InputLabel.vue';
import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue';
import TextInput from '@/Components/FormElements/TextInput.vue';
import {Link, useForm, usePage} from '@inertiajs/vue3';
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import {useCurrentUser} from "@/Composables/useCurrentUser.js";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import FormHeading from "@/Components/Headings/FormHeading.vue";
import InputWrapper from "@/Components/FormElements/InputWrapper.vue";
import CheckboxButtons from "@/Components/FormElements/CheckboxButtons.vue";
import TextareaInput from "@/Components/FormElements/TextareaInput.vue";
import InputDescription from "@/Components/FormElements/InputDescription.vue";

const props = defineProps({
  user: {
    type: Object,
  },
  tags: {
    type: Object
  }
});

function checkboxFormSubmit(value) {
  form.tags = value;
}

const form = useForm({
  first_name: '',
  last_name: '',
  description: '',
  experience_since: new Date().getFullYear(),
  tags: [],
});

</script>

<template>
  <AdminLayout>
    <template #heading>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit candidate profile</h2>
    </template>

    <template #default>
      <div v-if="props.user.id" class="flex gap-2 mb-4">
        <LinkButton :href="route('account.edit', { user: props.user.id })">Edit account</LinkButton>
      </div>

      <FormHeading description="Create a profile.">
        Edit Employer Profile
      </FormHeading>

      <form @submit.prevent="form.post(route('profile.candidate.store', { user: user.id }))" class="mt-6 space-y-6">
        <div class="flex justify-between gap-4">
          <InputWrapper id="first_name" label="First Name" :message="form.errors.first_name">
            <TextInput
              type="text"
              class="mt-1 block w-full"
              v-model="form.first_name"
              required
              autofocus
              autocomplete="first_name"
            />
          </InputWrapper>
          <InputWrapper id="last_name" label="Last Name" :message="form.errors.last_name">
            <TextInput
              type="text"
              class="mt-1 block w-full"
              v-model="form.last_name"
              required
              autofocus
              autocomplete="last_name"
            />
          </InputWrapper>
        </div>

        <div>
          <InputWrapper id="experience_since" label="Experience since" :message="form.errors.experience_since">
            <TextInput
              type="number"
              class="mt-1 block w-full"
              v-model="form.experience_since"
              autofocus
            />
          </InputWrapper>
        </div>

        <div>
          <InputWrapper id="description" label="Description" :message="form.errors.description">
            <TextareaInput
              type="text"
              class="mt-1 block w-full"
              v-model="form.description"
              required
              autofocus
            />
            <InputDescription>
              Tell us what projects and tasks you've completed, what technologies you've used, your current role in the team, and where you want to grow.
            </InputDescription>
          </InputWrapper>
        </div>


        <CheckboxButtons :items="props.tags" :selectedItems="form.tags" type="admin"
                         @checkboxCheckedEvent="checkboxFormSubmit"/>

        <div class="flex items-center gap-4">
          <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

          <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
          >
            <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
          </Transition>
        </div>
      </form>

    </template>
  </AdminLayout>
</template>
