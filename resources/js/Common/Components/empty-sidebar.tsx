import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/Common/Components/ui/sidebar';
import { NavMain } from '@/Common/Components/nav-main';
import type { NavItem } from '@/Common/Types';
interface EmptySideBarProps {
    content?: NavItem[]
    footer?: React.ReactNode
    links?: LinkProps[]
}

export interface LinkProps {
    size: "default" | "sm" | "lg" | null | undefined,
    children: React.ReactNode
}

export function EmptySideBar({ content, footer, links }: EmptySideBarProps) {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        {
                            (links || []).map(({ size, children }, i) => (
                                <SidebarMenuButton key={i} size={size} asChild>
                                    {children}
                                </SidebarMenuButton>
                            ))
                        }
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={content || []} title='List items' />
            </SidebarContent>

            <SidebarFooter>
            </SidebarFooter>
        </Sidebar>
    )
}