<template>
    <PerfrectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
        <SidebarLinkItem/>
    </PerfrectScrollbar>
</template>

<script setup>
import PerfrectScrollbar from '@/Components/PerfectScrollbar'
import SidebarLinkItem from '@/Components/Sidebar/SidebarLinkItem'
</script>
