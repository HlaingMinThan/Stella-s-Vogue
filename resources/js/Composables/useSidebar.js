import { ref } from 'vue';

export function useSidebar()
{
    const isSideNavOpen = ref(localStorage.getItem('is-sidenav-open') ?? false);

    const toggleSideNav = () => {
        isSideNavOpen.value = !isSideNavOpen.value;
        localStorage.setItem('is-sidenav-open', isSideNavOpen.value);
    };

    return { isSideNavOpen, toggleSideNav };
}
