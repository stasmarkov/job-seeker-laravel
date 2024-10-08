<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {faSuitcase} from "@fortawesome/free-solid-svg-icons";

const props = defineProps({
  vacanciesCount: {
    type: Number,
    default: 0,
  },
  loginsCount: {
    type: Number,
    default: 0,
  },
  usersCount: {
    type: Number,
    default: 0,
  }
})
</script>

<template>
  <Head title="Dashboard"/>

  <AdminLayout>
    <template #heading>
      Dashboard
    </template>

    <div>
      <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        <div class="bg-white overflow-hidden shadow rounded-lg" v-if="$page.props.isAdmin || $page.props.isEmployer">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                <font-awesome-icon :icon="faSuitcase" class="h-6 w-6 text-white" />
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    Total vacancies posted
                  </dt>
                  <dd class="flex items-baseline">
                    <div class="text-2xl leading-8 font-semibold text-gray-900">
                      {{ props.vacanciesCount }}
                    </div>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-4 sm:px-6">
            <div class="text-sm leading-5">
              <Link :href="route('vacancy.index')"
                 class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                View all
              </Link>
            </div>
          </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/>
                </svg>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    Logins
                  </dt>
                  <dd class="flex items-baseline">
                    <div class="text-2xl leading-8 font-semibold text-gray-900">
                      {{ props.loginsCount }}
                    </div>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-4 sm:px-6">
            <div class="text-sm leading-5">
              <Link :href="route('login_logs.index')"
                 class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                View all
              </Link>
            </div>
          </div>
        </div>
        <div class="bg-white overflow-hidden shadow rounded-lg" v-if="$page.props.isAdmin">
          <div class="px-4 py-5 sm:p-6">
            <div class="flex items-center">
              <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
              </div>
              <div class="ml-5 w-0 flex-1">
                <dl>
                  <dt class="text-sm leading-5 font-medium text-gray-500 truncate">
                    Total Users
                  </dt>
                  <dd class="flex items-baseline">
                    <div class="text-2xl leading-8 font-semibold text-gray-900">
                      {{ props.usersCount }}
                    </div>
                  </dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-4 sm:px-6">
            <div class="text-sm leading-5">
              <a :href="route('admin.users')"
                 class="font-medium text-indigo-600 hover:text-indigo-500 transition ease-in-out duration-150">
                View all
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>
