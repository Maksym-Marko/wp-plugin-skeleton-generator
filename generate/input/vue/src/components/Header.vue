<template>
	<header class="bg-white wp-block-template-part">
		<nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
			<div class="flex lg:flex-1">
				<router-link to="/" class="-m-1.5 p-1.5">
					<span class="sr-only">WPP Generator</span>
					<img class="h-8 w-auto" src="https://markomaksym.com.ua/wp-content/uploads/2022/01/favicon32.png"
						alt="" />
				</router-link>
			</div>
			<div class="flex lg:hidden">
				<button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
					@click="mobileMenuOpen = true">
					<span class="sr-only">Open main menu</span>
					<Bars3Icon class="h-6 w-6" aria-hidden="true" />
				</button>
			</div>
			<PopoverGroup class="hidden lg:flex lg:gap-x-12">

				<div v-for="item in navigation" :key="item.label">

					<!-- Simple link -->
					<router-link :to="item.route" class="text-sm font-semibold leading-6 text-gray-900"
						v-if="!Array.isArray(item.children)">
						{{ item.label }}
					</router-link>

					<!-- Dropdown -->
					<Popover v-if="Array.isArray(item.children)" class="relative">
						<PopoverButton class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900 mt-1">
							{{ item.label }}
							<ChevronDownIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true" />
						</PopoverButton>

						<transition enter-active-class="transition ease-out duration-200"
							enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0"
							leave-active-class="transition ease-in duration-150"
							leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
							<PopoverPanel
								class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-sm overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
								<div class="p-4">
									<div v-for="subItem in item.children" :key="subItem.label"
										class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm leading-6 hover:bg-gray-50">
										<div class="flex-auto">

											<router-link :to="subItem.route" class="block font-semibold text-gray-900">
												{{ subItem.label }}
											</router-link>
										</div>
									</div>
								</div>
							</PopoverPanel>
						</transition>
					</Popover>

				</div>

			</PopoverGroup>
			<div class="hidden lg:flex lg:flex-1 lg:justify-end">
				<a href="https://markomaksym.com.ua/wp-plugin-skeleton-generator/" target="_blank"
					class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">WPP
					Generator<span aria-hidden="true">&rarr;</span></a>
			</div>
		</nav>

		<Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
			<div class="fixed inset-0 z-10" />
			<DialogPanel
				class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
				<div class="flex items-center justify-between">
					<router-link to="/" class="-m-1.5 p-1.5">
						<span class="sr-only">WPP Generator</span>
						<img class="h-8 w-auto" src="https://markomaksym.com.ua/wp-content/uploads/2022/01/favicon32.png"
							alt="" />
					</router-link>
					<button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
						<span class="sr-only">Close menu</span>
						<XMarkIcon class="h-6 w-6" aria-hidden="true" />
					</button>
				</div>
				<div class="mt-6 flow-root">
					<div class="-my-6 divide-y divide-gray-500/10">
						<div class="space-y-2 py-6">

							<div v-for="item in navigation" :key="item.label">

								<!-- Simple link -->
								<router-link :to="item.route"
									class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
									v-if="!Array.isArray(item.children)" @click="mobileMenuOpen = false">
									{{ item.label }}
								</router-link>

								<Disclosure v-if="Array.isArray(item.children)" as="div" class="-mx-3" v-slot="{ open }">
									<DisclosureButton
										class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
										{{ item.label }}
										<ChevronDownIcon :class="[open ? 'rotate-180' : '', 'h-5 w-5 flex-none']"
											aria-hidden="true" />
									</DisclosureButton>
									<DisclosurePanel class="mt-2 space-y-2">

										<router-link v-for="subItem in item.children" :key="subItem.label"
											class="block rounded-lg py-2 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50"
											:to="subItem.route" @click="mobileMenuOpen = false">
											{{ subItem.label }}
										</router-link>


									</DisclosurePanel>
								</Disclosure>

							</div>

						</div>
						<div class="py-6">
							<a href="https://markomaksym.com.ua/wp-plugin-skeleton-generator/" target="_blank"
								class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">WPP
								Generator<span aria-hidden="true">&rarr;</span></a>
						</div>
					</div>
				</div>
			</DialogPanel>
		</Dialog>
	</header>
</template>
  
<script setup>
import { ref, computed } from 'vue'
import {
	Dialog,
	DialogPanel,
	Disclosure,
	DisclosureButton,
	DisclosurePanel,
	Popover,
	PopoverButton,
	PopoverGroup,
	PopoverPanel,
} from '@headlessui/vue'
import {
	Bars3Icon,
	XMarkIcon,
} from '@heroicons/vue/24/outline'
import { ChevronDownIcon } from '@heroicons/vue/20/solid'
import store from '@/store'

const navigation = computed(() => store.getters['navigation/getHeaderMenu'])

const mobileMenuOpen = ref(false)
</script>