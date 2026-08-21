import { useEffect, useRef } from 'react';
import { Link } from '@inertiajs/react';
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/Common/Components/ui/sidebar';
import { useCurrentUrl } from '@/Common/Hooks/use-current-url';
import type { NavItem } from '@/Common/Types';

export function NavMain({ items = [], title = 'User Not Found' }: { items: NavItem[], title: string }) {
    const url = useRef<ReturnType<typeof useCurrentUrl>['isCurrentUrl']>(useCurrentUrl().isCurrentUrl)
    const isCurrentUrl = url.current

    console.log(isCurrentUrl('#'))
    return (
        <SidebarGroup className="px-2 py-0">
            <SidebarGroupLabel>{title || 'Platform'}</SidebarGroupLabel>
            <SidebarMenu>
                {items.map((item) => (
                    <SidebarMenuItem key={item.title}>
                        <SidebarMenuButton
                            asChild
                            isActive={isCurrentUrl(item.href)}
                            tooltip={{ children: item.title }}
                        >
                            <Link href={item.href}>
                                {item.icon}
                                <span>{item.title}</span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                ))}
            </SidebarMenu>
        </SidebarGroup>
    );
}
