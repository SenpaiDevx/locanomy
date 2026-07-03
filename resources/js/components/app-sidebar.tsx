import { Link } from '@inertiajs/react';
import ImportContactsRoundedIcon from '@mui/icons-material/ImportContactsRounded';
import FolderRoundedIcon from '@mui/icons-material/FolderRounded';
import ViewComfyTwoToneIcon from '@mui/icons-material/ViewComfyTwoTone';
import RecommendTwoToneIcon from '@mui/icons-material/RecommendTwoTone';
import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import type { NavItem } from '@/types';
import {MainRoute, FooterRoute} from '../../../routes/ecommerce-route/link'
import { useAppearance } from '@/hooks/use-appearance';



export function AppSidebar() {
    const { appearance, updateAppearance } = useAppearance()
    const props = {
        ...(appearance == 'light') && { className : 'bg-[#f3f3f3]'}
    }
    
    return (
        <Sidebar collapsible="icon" variant="inset" {...props}>
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={'#'}>
                                <RecommendTwoToneIcon />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>
            
            <SidebarContent>
                <NavMain items={MainRoute} title='User Management' />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={FooterRoute} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}