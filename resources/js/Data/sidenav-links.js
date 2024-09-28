export default function getSideNavLinks()
{
    return [
        {
            icon: 'fa-tv',
            path: route('admin.dashboard'),
            title: 'Dashboard',
            component: 'Admin/Dashboard',
            url:'/admin/dashboard',
            allowedRoles: ['admin','super_admin','accounting','officer_access']
        },
        // {
        //     icon: 'fa-users',
        //     path: route('admin.users.index'),
        //     title: 'Manage Users',
        //     component: 'Admin/Users/Index',
        //     url:'/admin/users',
        //     allowedRoles: ['admin','super_admin']
        // },
    ];
};
