import type { InertiaLinkProps } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';

export type IsCurrentUrlFn = (
    urlToCheck: NonNullable<InertiaLinkProps['href']>,
    currentUrl?: string,
    startsWith?: boolean,
) => boolean;

export type IsCurrentOrParentUrlFn = (
    urlToCheck: NonNullable<InertiaLinkProps['href']>,
    currentUrl?: string,
) => boolean;

export type WhenCurrentUrlFn = <TIfTrue, TIfFalse = null>(
    urlToCheck: NonNullable<InertiaLinkProps['href']>,
    ifTrue: TIfTrue,
    ifFalse?: TIfFalse,
) => TIfTrue | TIfFalse;

export type UseCurrentUrlReturn = {
    currentUrl: string;
    isCurrentUrl: IsCurrentUrlFn;
    isCurrentOrParentUrl: IsCurrentOrParentUrlFn;
    whenCurrentUrl: WhenCurrentUrlFn;
};

function normalizePath(url: string): string {
    return url.split('?')[0].replace(/\/+$/, '');
}

export function useCurrentUrl(): UseCurrentUrlReturn {
    const { url } = usePage();

    const currentUrl = normalizePath(url);

    const isCurrentUrl: IsCurrentUrlFn = (
        urlToCheck,
        currentUrlOverride,
        startsWith = false,
    ) => {
        const base = normalizePath(currentUrlOverride ?? currentUrl);
        const target = typeof urlToCheck === 'string'
            ? urlToCheck
            : String(urlToCheck);

        let targetPath = target;

        if (target.startsWith('http')) {
            try {
                targetPath = new URL(target).pathname;
            } catch {
                return false;
            }
        }

        targetPath = normalizePath(targetPath);

        return startsWith
            ? base.startsWith(targetPath)
            : base === targetPath;
    };

    const isCurrentOrParentUrl: IsCurrentOrParentUrlFn = (
        urlToCheck,
        currentUrlOverride,
    ) => {
        return isCurrentUrl(urlToCheck, currentUrlOverride, true);
    };

    const whenCurrentUrl: WhenCurrentUrlFn = <TIfTrue, TIfFalse = null>(
        urlToCheck: NonNullable<InertiaLinkProps['href']>,
        ifTrue: TIfTrue,
        ifFalse: TIfFalse = null as TIfFalse,
    ) => {
        return isCurrentUrl(urlToCheck) ? ifTrue : ifFalse;
    };

    return {
        currentUrl,
        isCurrentUrl,
        isCurrentOrParentUrl,
        whenCurrentUrl,
    };
}