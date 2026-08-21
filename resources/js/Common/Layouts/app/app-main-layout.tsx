import { AppContent } from '@/Common/Components/app-content';
import { AppShell } from '@/Common/Components/app-shell';
import { AppSidebar } from '@/Common/Components/app-sidebar';
import { AppSidebarHeader } from '@/Common/Components/app-sidebar-header';
import type { AppLayoutProps } from '@/Common/Types';

export function AppMain({
    children,
    breadcrumbs = [],
}: AppLayoutProps) {
    return (
        <AppShell variant="sidebar">
            <AppSidebar />
            <AppContent variant="sidebar" className="overflow-x-hidden">
                <AppSidebarHeader breadcrumbs={breadcrumbs} />
                {children}
            </AppContent>
        </AppShell>
    );
}
