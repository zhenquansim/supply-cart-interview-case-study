<script setup>
import { UserCircleIcon } from "@heroicons/vue/24/solid";
</script>

<template>
    <div class="h-16 drop-shadow-md bg-slate-50">
        <div class="mx-5 flex h-16 items-center justify-between">
            <!-- Action links -->
            <div class="flex items-center justify-between">
                <p class="pr-10">SupplyCart</p>
                <Link
                    v-for="link in menuLinks"
                    :href="link.url"
                    class="mx-1 px-2 data-active:font-bold data-active:bg-lime-500 data-active:text-white data-active:rounded-full"
                    :data-ui="$page.url === link.url ? 'active' : ''"
                    >{{ link.name }}
                </Link>
            </div>
            <div class="flex items-center">
                <div>
                    <button @click="showProfileAction = !showProfileAction">
                        <UserCircleIcon class="h-8 w-8 text-lime-500" />
                    </button>
                    <ul
                        v-if="showProfileAction"
                        class="absolute border right-5 rounded bg-white p-4"
                    >
                        <li>
                            <Link href="/logout" method="post">Logout</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="p-10 h-full">
        <div v-if="$page.props.auth.user" class="mb-2">
            <p>
                Welcome
                <span class="font-bold"> {{ $page.props.auth.user.name }} </span
                >!
                <span
                    v-if="$page.props.auth.user.membership_level"
                    class="rounded-full px-2 font-medium"
                    :style="{
                        background:
                            $page.props.auth.user.membership_level.bg_color,
                        color: $page.props.auth.user.text_color,
                    }"
                >
                    {{ $page.props.auth.user.membership_level.name }}
                </span>
                <span
                    v-if="$page.props.auth.user.membership_level"
                    class="text-sm"
                >
                    (You're entitled for a
                    {{ $page.props.auth.user.membership_level.discount }}%
                    discount!)
                </span>
            </p>
        </div>
        <slot />
    </div>
</template>

<script>
import Toast from "@/Components/Toast.vue";

export default {
    data() {
        return {
            showProfileAction: false,
            showToast: false,
            menuLinks: [
                {
                    name: "Products",
                    url: "/products",
                },
                {
                    name: "Order History",
                    url: "/orders",
                },
                {
                    name: "Cart",
                    url: "/carts",
                },
            ],
        };
    },
    watch: {
        showToast(newValue) {
            if (newValue)
                setTimeout(() => {
                    this.showToast = false;
                }, 2000);
        },
    },
};
</script>
