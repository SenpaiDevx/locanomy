import { Avatar, AvatarFallback, AvatarImage } from '@/Common/Components/ui/avatar';
import { useInitials } from '@/Common/Hooks/use-initials';
import type { User } from '@/Common/Types';

export function UserInfo({
    user,
    showEmail = false,
}: {
    user: User;
    showEmail?: boolean;
}) {
    // const getInitials = useInitials();

    return (
        <>
            <Avatar className="h-8 w-8 overflow-hidden rounded-full">
                <AvatarImage src={user.avatar} alt={user.name} />
                <AvatarFallback className="rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                    {/* {getInitials(user.name)} */}
                    Admin Account
                </AvatarFallback>
            </Avatar>
            <div className="grid flex-1 text-left text-sm leading-tight">
                <span className="truncate font-medium">{'Caliban'}</span>
                {showEmail && (
                    <span className="truncate text-xs text-muted-foreground">
                        {'cristianempillo.lopez24@gmail.com'}
                    </span>
                )}
                
            </div>
        </>
    );
}
