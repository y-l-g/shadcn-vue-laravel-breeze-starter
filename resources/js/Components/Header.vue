<script setup lang="ts">
import Logo from '@/Components/Logo.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { guestNav, authNav, type NavItem } from '@/Config/config';
import MobileNav from '@/Components/MobileNav.vue';
import { ref } from 'vue';
import Button from '@/Components/ui/button/Button.vue';
import { SunIcon, MoonIcon, GithubLogoIcon, PersonIcon } from '@radix-icons/vue';
import { useDark, useToggle } from '@vueuse/core';
import NavigationMenuList from './ui/navigation-menu/NavigationMenuList.vue';
import NavigationMenuItem from './ui/navigation-menu/NavigationMenuItem.vue';
import NavigationMenuTrigger from './ui/navigation-menu/NavigationMenuTrigger.vue';
import NavigationMenuContent from './ui/navigation-menu/NavigationMenuContent.vue';
import NavigationMenuLink from './ui/navigation-menu/NavigationMenuLink.vue';
import NavigationMenu from './ui/navigation-menu/NavigationMenu.vue';
import DropdownMenu from './ui/dropdown-menu/DropdownMenu.vue';
import DropdownMenuTrigger from './ui/dropdown-menu/DropdownMenuTrigger.vue';
import DropdownMenuContent from './ui/dropdown-menu/DropdownMenuContent.vue';
import DropdownMenuLabel from './ui/dropdown-menu/DropdownMenuLabel.vue';
import DropdownMenuSeparator from './ui/dropdown-menu/DropdownMenuSeparator.vue';
import DropdownMenuItem from './ui/dropdown-menu/DropdownMenuItem.vue';
import Separator from './ui/separator/Separator.vue';

const isOpen = ref(false)

const links = [
    {
        name: 'GitHub',
        href: 'https://github.com/laravel/laravel',
        icon: GithubLogoIcon,
    },
];

const isDark = useDark()
const toggleDark = useToggle(isDark)

</script>


<template>
    <header class="sticky z-40 top-0 bg-background/80 backdrop-blur-lg border-b border-border">
        <div class="container flex h-14 max-w-screen-2xl items-center">
            <div class="mr-4 md:mr-1 hidden md:flex">
                <a
                    href="/"
                    class="mr-10 flex items-center lg:space-x1 xl:space-x-1 text-[#FF2D20]"
                >
                    <Logo class="stroke-[#FF2D20] fill-[#FF2D20] w-8 h-8" />

                    <span class="font-semibold">
                        Laravel
                    </span>
                </a>
                <nav class="flex items-center  max-lg:space-x-4 space-x-6 text-sm font-medium">
                    <template v-if="$page.props.auth.user">
                        <Link
                            v-for="item in authNav"
                            class="transition-colors hover:text-foreground/80 text-foreground/60 "
                            :class="{ 'font-semibold !text-foreground': route().current(item.route) }"
                            :href="route(item.route)"
                            :key="item.route"
                        >
                        {{ item.title }}
                        </Link>
                    </template>
                    <template v-else>
                        <Link
                            v-for="item in guestNav"
                            class="transition-colors hover:text-foreground/80 text-foreground/60"
                            :class="{
                                'font-semibold !text-foreground': route().current(item.route),
                            }"
                            :href="route(item.route)"
                            :key="item.route"
                        >
                        {{ item.title }}
                        </Link>
                    </template>
                </nav>
            </div>
            <MobileNav :auth="$page.props.auth.user" />
            <div class="flex flex-1 items-center space-x-2 justify-end">
                <!-- <div class="w-full flex-1 md:w-auto md:flex-none">
                        <Button
                            variant="outline"
                            class="relative h-8 w-full justify-start rounded-[0.5rem] bg-background text-sm font-normal text-muted-foreground shadow-none sm:pr-12 md:w-40 lg:w-64"
                            @click="isOpen = true"
                        >
                            <span class="hidden lg:inline-flex">Search documentation...</span>
                            <span class="inline-flex lg:hidden">Search...</span>
                        </Button>
                    </div> -->
                <nav class="flex items-center">
                    <Button
                        class="w-9 h-9"
                        aria-label="Toggle dark mode"
                        :variant="'ghost'"
                        :size="'icon'"
                        @click="toggleDark()"
                    >
                        <component
                            :is="isDark ? SunIcon : MoonIcon"
                            class="w-5 h-5 text-foreground"
                        />
                    </Button>
                    <Separator
                        orientation="vertical"
                        class="h-7"
                    />
                    <Button
                        v-for="link in links"
                        :key="link.name"
                        as="a"
                        class="w-9 h-9"
                        :href="link.href"
                        target="_blank"
                        :variant="'ghost'"
                        :size="'icon'"
                    >
                        <component
                            :is="link.icon"
                            class="w-5 h-5"
                        />
                    </Button>


                    <DropdownMenu>
                        <DropdownMenuTrigger as-child>

                            <Button
                                :variant="'ghost'"
                                size="icon"
                            >
                                <span class="pi pi-user" />
                                <span class="sr-only">Toggle user menu</span>
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent
                            align="end"
                            v-if="$page.props.auth.user"
                        >
                            <Link :href="route('dashboard')">
                            <DropdownMenuItem>
                                Dashboard
                            </DropdownMenuItem>
                            </Link>
                            <DropdownMenuSeparator />
                            <Link :href="route('profile.edit')">
                            <DropdownMenuItem>
                                Profile
                            </DropdownMenuItem>
                            </Link>
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                            <DropdownMenuItem>
                                Logout
                            </DropdownMenuItem>
                            </Link>


                        </DropdownMenuContent>
                        <DropdownMenuContent
                            align="end"
                            v-else
                        >
                            <Link :href="route('login')">
                            <DropdownMenuItem>
                                Login
                            </DropdownMenuItem>
                            </Link>
                            <Link :href="route('register')">
                            <DropdownMenuItem>
                                Register
                            </DropdownMenuItem>
                            </Link>
                        </DropdownMenuContent>
                    </DropdownMenu>

                </nav>
            </div>
        </div>
    </header>
</template>
