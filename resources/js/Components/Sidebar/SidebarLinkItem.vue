<template>
    <SidebarLink
        title="Dashboard"
        :href="route('dashboard')"
        :active="route().current('dashboard')"
    >
        <template #icon>
            <DashboardIcon
                class="flex-shrink-0 w-6 h-6"
                aria-hidden="true"
            />
        </template>
    </SidebarLink>

    <SidebarLink
        title="Products"
        :href="route('product')"
        :active="route().current('product')"
    >
        <template #icon>
            <DashboardIcon
                class="flex-shrink-0 w-6 h-6"
                aria-hidden="true"
            />
        </template>
    </SidebarLink>

    <!-- <SidebarCollapsible title="Dropdown">
        <SidebarCollapsibleItem href="#" title="Link 1" :active="false" />
        <SidebarCollapsibleItem href="#" title="Link 2" :active="true" />
        <SidebarCollapsibleItem href="#" title="Link 3" :active="false" />
    </SidebarCollapsible>
    <SidebarCollapsible title="Dropdown">
        <SidebarCollapsibleItem href="#" title="Link 1" :active="false" />
        <SidebarCollapsibleItem href="#" title="Link 2" :active="true" />
        <SidebarCollapsibleItem href="#" title="Link 3" :active="false" />
    </SidebarCollapsible> -->

</template>

<script setup>
    import SidebarLink from '@/Components/Sidebar/SidebarLink'
    import { DashboardIcon } from '@/Components/Icons/Outline'
    import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible'
    import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem'
</script>
