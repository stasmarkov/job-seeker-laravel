<script setup>
import Layout from "@/Layouts/Layout.vue";
import Panel from "@/Components/Panel.vue";
import LinkButton from "@/Components/Buttons/LinkButton.vue";
import EmployerProfileLogo from "@/Components/Models/Employers/EmployerProfileLogo.vue";
import Tag from "@/Components/Models/Tags/Tag.vue";
import AnchorButton from "@/Components/Buttons/AnchorButton.vue";
import Like from "@/Components/Reactions/Like.vue";
import {Inertia} from "@inertiajs/inertia";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faArrowUpRightFromSquare} from "@fortawesome/free-solid-svg-icons";
import Article from "@/Components/Sections/Article.vue";
import CardWide from "@/Components/Models/Vacancies/CardWide.vue";
import BlockHeading from "@/Components/Headings/BlockHeading.vue";
import RegularLink from "@/Components/Elements/RegularLink.vue";

const props = defineProps({
  vacancy: Object,
  can: Object,
  similarVacancies: Object,
  likesCount: Number,
  isLiked: Boolean,
});

const like = () => {
  Inertia.get(route('vacancy.like', {'vacancy': props.vacancy.id}));
}
</script>

<template>
  <Head :title="props.vacancy.title">
    <meta name="description" :content="props.vacancy.short_description">
  </Head>

  <Layout>
    <div v-if="can.edit_vacancy" class="flex gap-2 mb-2">
      <LinkButton class="bg-green-600" :href="route('vacancy.edit', { vacancy: props.vacancy.id })">Edit</LinkButton>
    </div>

    <Article :hoverable="false">
      <div class="text-white">
        <div class="">
          <div class="flex justify-between">
            <h1 class="text-base font-semibold leading-7">
              <span class="text-3xl font-bold">{{ props.vacancy.title }}</span>
            </h1>
            <EmployerProfileLogo :employerProfile="props.vacancy.employerProfile" width="50"/>
          </div>

          <div class="mt-1 max-w-2xl text-sm leading-6 text-gray-300">Employer:
            <RegularLink v-if="props.vacancy.employerProfile"
                  class="self-start text-sm hover:underline  ease-linear transition"
                  :href="route('profile.employer.show', { employerProfile: props.vacancy.employerProfile.id })">
              {{ props.vacancy.employerProfile.name }}
            </RegularLink>

            <p class="text-xs text-gray-300">{{ vacancy.created_at }}</p>
          </div>
        </div>
        <div class="mt-6 border-t border-gray-100">
          <dl class="divide-y divide-gray-100">
            <div class=" py-6 sm:grid sm:grid-cols-3 sm:gap-4">
              <dt class="text-sm font-medium leading-6">Salary</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-300 sm:col-span-2 sm:mt-0">{{ vacancy.salary }}</dd>
            </div>
            <div class=" py-6 sm:grid sm:grid-cols-3 sm:gap-4">
              <dt class="text-sm font-medium leading-6 text-gray-100">Schedule</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-300 sm:col-span-2 sm:mt-0">{{ props.vacancy.schedule }}</dd>
            </div>
            <div class=" py-6 sm:grid sm:grid-cols-3 sm:gap-4">
              <dt class="text-sm font-medium leading-6 text-gray-100">Location</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-300 sm:col-span-2 sm:mt-0">{{ props.vacancy.location }}</dd>
            </div>
            <div class=" py-6 sm:grid sm:grid-cols-3 sm:gap-4">
              <dt class="text-sm font-medium leading-6 text-gray-100">Description</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-300 sm:col-span-2 sm:mt-0">
                {{ props.vacancy.description }}
              </dd>
            </div>
            <div class=" py-6 sm:grid sm:grid-cols-3 sm:gap-4">
              <dt class="text-sm font-medium leading-6 text-gray-100">Tags</dt>
              <dd class="mt-2 text-sm text-gray-100 sm:col-span-2 sm:mt-0">
                <div class="flex flex-wrap mt-auto gap-2">
                  <Tag v-for="tag in props.vacancy.tags" size="small" :tag/>
                </div>
              </dd>
            </div>
          </dl>
        </div>
      </div>

      <div class="mt-4 flex justify-end gap-2">
        <Like :route="route('vacancy.like', {'vacancy': props.vacancy.id })" :likesCount="props.likesCount"
              :isLiked="props.isLiked"/>
        <AnchorButton :href="props.vacancy.url" target="_blank">View more</AnchorButton>
      </div>
    </Article>

    <div class="space-y-4 mt-6">
      <BlockHeading>Similar vacancies</BlockHeading>
      <CardWide v-for="similarVacancy in props.similarVacancies" :vacancy="similarVacancy" />
    </div>

  </Layout>
</template>

<style scoped>

</style>
