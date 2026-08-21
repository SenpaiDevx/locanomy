import type { NavItem } from '../../resources/js/Common/Types/navigations'
import ViewComfyTwoToneIcon from '@mui/icons-material/ViewComfyTwoTone';
import FolderRoundedIcon from '@mui/icons-material/FolderRounded';
import ImportContactsRoundedIcon from '@mui/icons-material/ImportContactsRounded';
export const MainRoute : NavItem[] = [
    {
        title: 'Dashboard',
        href: '/',
        icon: <ViewComfyTwoToneIcon />,
    },
]

export const FooterRoute : NavItem[] = [
     {
        title: 'Repository',
        href: '/',
        icon: <FolderRoundedIcon />,
    },
    {
        title: 'Documentation',
        href: '/',
        icon: <ImportContactsRoundedIcon />,
    },
]