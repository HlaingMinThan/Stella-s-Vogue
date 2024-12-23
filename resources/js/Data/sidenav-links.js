export default function getSideNavLinks() {
    return [
        // {
        //     icon: "fa-tv",
        //     path: route("admin.dashboard"),
        //     title: "Dashboard",
        //     component: "Admin/Dashboard",
        //     url: "/admin/dashboard",
        //     allowedRoles: ["admin"],
        // },
        {
            icon: "fa-users",
            path: route("admin.collections.index"),
            title: "Manage Collections",
            component: "Admin/Collections/Index",
            url: "/admin/collections",
            allowedRoles: ["admin","staff","stock"],
        },
        {
            icon: "fa-inbox",
            path: route("admin.inventories.index"),
            title: "Manage Inventories",
            component: "Admin/Inventories/Index",
            url: "/admin/inventories",
            allowedRoles: ["admin"],
        },
        // {
        //     icon: 'fa-users',
        //     path: route('admin.orders.index'),
        //     title: 'Manage Orders',
        //     component: 'Admin/Orders/Index',
        //     url:'/admin/orders',
        //     allowedRoles: ['admin','staff']
        // }
    ];
}
