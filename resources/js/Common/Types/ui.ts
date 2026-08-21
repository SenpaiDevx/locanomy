import type { ReactNode } from 'react';
import type { BreadcrumbItem } from '@/Common/Types/navigations';

export type AppLayoutProps = {
    children: ReactNode;
    breadcrumbs?: BreadcrumbItem[];
};

export type AuthLayoutProps = {
    children?: ReactNode;
    name?: string;
    title?: string;
    description?: string;
};
