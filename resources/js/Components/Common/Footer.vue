<script setup>
import {Link} from '@inertiajs/vue3';
</script>

<template>
    <footer class="bg-black text-white py-12 px-4">
        <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Logo & Explore Section -->
            <div class="flex flex-col items-center justify-start">
                <img src="/logo.png" alt="Logo" class="w-12 object-contain mb-4" />
                <p class="text-lg font-semibold mb-4">Explore Legal Plans</p>
                <p class="font-medium text-center">We provide legal help for you, your family, or your business.</p>
            </div>

            <!-- About Section -->
            <div class="flex flex-col pt-4 mt-4 lg:mt-0 items-center justify-start">
                <h4 class="text-lg font-semibold mb-4">About</h4>
                <ul class="space-y-2 font-medium list-disc list-inside">
                    <li><Link :href="route('how-we-help')" class="hover:text-primary transition-all">How We Help?</Link></li>
                    <li><Link :href="route('vision-and-mission')" class="hover:text-primary transition-all">Vision & Mission</Link></li>
                    <li><Link :href="route('resources.become-an-affiliate')" class="hover:text-primary transition-all">Become an Affiliate</Link></li>
                    <li><Link :href="route('careers')" class="hover:text-primary transition-all">Careers</Link></li>
                    <li><Link :href="route('privacy-policy')" class="hover:text-primary transition-all">Privacy Policy</Link></li>
                    <li><Link :href="route('resources.contact-us')" class="hover:text-primary transition-all">Contact Us</Link></li>
                </ul>
            </div>

            <!-- Get Started Section -->
            <div class="flex flex-col pt-4 mt-4 lg:mt-0 items-center justify-start mr-10 md:mr-0">
                <h4 class="text-lg font-semibold mb-4 ">Get Started</h4>
                <ul class="space-y-2 font-medium  list-disc list-inside">
                    <li><Link :href="route('getting-started')" class="hover:text-primary transition-all">Get Plans</Link></li>
                    <li><Link :href="route('get-started')" class="hover:text-primary transition-all">Get Started</Link></li>
                    <li><Link :href="route('login')" class="hover:text-primary transition-all">Login</Link></li>
                </ul>
            </div>

            <!-- Follow Us Section -->
            <div class="flex flex-col pt-4 mt-4 lg:mt-0 items-center justify-start mr-10 md:mr-0">
                <h4 class="text-lg font-semibold mb-4 ">Follow Us</h4>
                <ul class="space-y-2 font-medium  list-disc list-inside">
                    <li><a :href="$page.props.settings?.facebook_url" target="_blank" class="hover:text-primary transition-all">Facebook</a></li>
                    <li><a :href="$page.props.settings?.youtube_url" target="_blank" class="hover:text-primary transition-all">YouTube</a></li>
                    <li><a :href="$page.props.settings?.line_url" target="_blank" class="hover:text-primary transition-all">Line</a></li>
                    <li><a :href="$page.props.settings?.instagram_url" target="_blank" class="hover:text-primary transition-all">Instagram</a></li>
                </ul>
            </div>
        </div>

        <div class="text-center  mt-8 border-t border-gray-200 pt-8">
            <div class="flex items-center md:justify-center justify-between space-x-5 md:space-x-16 font-bold text-sm">
                <a href="#" class="hover:text-primary transition-all">
                    <img src="https://cdn.kcak11.com/CountryFlags/countries/th.svg" alt="thai" class="inline-block w-6 mr-1.5 rounded-sm">
                    TLP Thai
                </a>
                <a href="#" class="hover:text-primary transition-all">
                    <img src="https://cdn.kcak11.com/CountryFlags/countries/us.svg" alt="us" class="inline-block w-6 mr-1.5 rounded-sm">
                    TLP USA
                </a>
                <a href="#" class="hover:text-primary transition-all">
                    <img src="https://cdn.kcak11.com/CountryFlags/countries/mm.svg" alt="myanmar" class="inline-block w-6 mr-1.5 rounded-sm">
                    TLP Myanmar
                </a>
            </div>
        </div>
    </footer>
</template>
