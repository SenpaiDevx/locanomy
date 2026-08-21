import type { InertiaLinkProps } from '@inertiajs/react';
import React from 'react'

export type BreadcrumbItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
};

export type NavItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: React.ReactNode | null;
    isActive?: boolean;
};