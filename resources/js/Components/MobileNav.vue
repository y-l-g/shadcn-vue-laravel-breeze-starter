<script setup lang="ts">
import { Button } from '@/Components/ui/button'
import { ref } from 'vue'
import { guestNav, authNav, type NavItem } from '@/Config/config';
import Logo from './Logo.vue'
import { Link } from '@inertiajs/vue3';
import Sheet from './ui/sheet/Sheet.vue';
import SheetTrigger from './ui/sheet/SheetTrigger.vue';
import SheetContent from './ui/sheet/SheetContent.vue';
import ScrollArea from './ui/scroll-area/ScrollArea.vue';
import { User } from '@/types';

// defineProps<{
//     auth: User;
// }>();

const open = ref(false)

</script>

<template>
    <Sheet v-model:open="open">
        <SheetTrigger as-child>
            <Button
                variant="ghost"
                class="mr-2 px-2 text-base flex-shrink-0 hover:bg-transparent focus-visible:bg-transparent focus-visible:ring-0 focus-visible:ring-offset-0 md:hidden"
            >
                <svg
                    strokeWidth="1.5"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                >
                    <path
                        d="M3 5H11"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M3 12H16"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M3 19H21"
                        stroke="currentColor"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                <span class="sr-only">Toggle Menu</span>
            </Button>
        </SheetTrigger>
        <SheetContent
            side="left"
            class="pr-0"
        >
            <a
                @click="open = false"
                href="/"
                class="mr-10 flex items-center lg:space-x1 xl:space-x-1 text-[#FF2D20]"
            >
                <Logo class="stroke-[#FF2D20] fill-[#FF2D20] w-8 h-8" />

                <span class="font-semibold">
                    Laravel
                </span>
            </a>
            <ScrollArea class="my-4 h-[calc(100vh-8rem)] pb-10 pl-6">
                <div
                    v-if="$page.props.auth.user"
                    class="flex flex-col space-y-3"
                >
                    <Link
                        v-for="item in authNav"
                        :href="route(item.route)"
                        :key="item.route"
                    >
                    {{ item.title }}
                    </Link>
                </div>
                <div
                    v-else
                    class="flex flex-col space-y-3"
                >
                    <Link
                        v-for="item in guestNav"
                        :href="route(item.route)"
                        :key="item.route"
                        @click="open = false"
                    >
                    {{ item.title }}
                    </Link>
                </div>
            </ScrollArea>
        </SheetContent>
    </Sheet>
</template>
