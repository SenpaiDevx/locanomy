import { createInertiaApp, type ResolvedComponent } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { initializeTheme } from '@/Common/Hooks/use-appearance';
import { Provider } from 'react-redux'
import { createRoot } from 'react-dom/client';
import { StrictMode } from 'react';
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
export const queryClient = new QueryClient({
    defaultOptions: {
        queries: {
            staleTime: 1000 * 60 * 10, // 3mins
            gcTime: 1000 * 60 * 10,   // 10mins cache garbage collection
            retry: 2,
            refetchOnWindowFocus: false,
        },
    },
}); // Initialize the client

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.tsx`,
            import.meta.glob<ResolvedComponent>('./Pages/**/*.tsx')
        ),
    setup({ el, App, props }) {
        const root = createRoot(el);
        root.render(
            <StrictMode>
                <QueryClientProvider client={queryClient}>
                    <App {...props} />
                </QueryClientProvider>
            </StrictMode>,
        );
    },
     progress: {
        color: '#4B5563',
    },
});
initializeTheme();