export interface NavItem {
    title: string;
    route: string;
    disabled?: boolean;
    external?: boolean;
    icon?: string;
    label?: string;
}

export const authProfileNav: NavItem[] = [
    {
        title: "Dashboard",
        route: "dashboard",
    },
];

export const guestNav: NavItem[] = [
    {
        title: "Welcome",
        route: "welcome",
    },
];

export const authNav: NavItem[] = [
    {
        title: "Welcome",
        route: "welcome",
    },
];
