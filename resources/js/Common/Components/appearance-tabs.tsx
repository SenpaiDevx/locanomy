import Sun from '@mui/icons-material/Sunny';
import Monitor from '@mui/icons-material/Monitor'
import DarkModeTwoToneIcon from '@mui/icons-material/DarkModeTwoTone';
import type { HTMLAttributes } from 'react';
import type { Appearance } from '@/Common/Hooks/use-appearance';
import { useAppearance } from '@/Common/Hooks/use-appearance';
import { cn } from '@/Common/Lib/utils';

export default function AppearanceToggleTab({
    className = '',
    ...props
}: HTMLAttributes<HTMLDivElement>) {
    const { appearance, updateAppearance } = useAppearance();

    const tabs: { value: Appearance; icon: React.ReactNode; label: string }[] = [
        { value: 'light', icon: <Sun style={{ marginLeft : '-4px', height : '16px', width : '16px'}} />, label: 'Light' },
        { value: 'dark', icon: <DarkModeTwoToneIcon style={{ marginLeft : '-4px', height : '16px', width : '16px'}} />, label: 'Dark' },
        { value: 'system', icon: <Monitor style={{ marginLeft : '-4px', height : '16px', width : '16px'}} />, label: 'System' },
    ];

    return (
        <div
            className={cn(
                'inline-flex gap-1 rounded-lg bg-neutral-100 p-1 dark:bg-neutral-800',
                className,
            )}
            {...props}
        >
            {tabs.map(({ value, icon: Icon, label }) => (
                <button
                    key={value}
                    onClick={() => updateAppearance(value)}
                    className={cn(
                        'flex items-center rounded-md px-3.5 py-1.5 transition-colors',
                        appearance === value
                            ? 'bg-white shadow-xs dark:bg-neutral-700 dark:text-neutral-100'
                            : 'text-neutral-500 hover:bg-neutral-200/60 hover:text-black dark:text-neutral-400 dark:hover:bg-neutral-700/60',
                    )}
                >
                    {Icon}
                    <span className="ml-1.5 text-sm">{label}</span>
                </button>
            ))}
        </div>
    );
}