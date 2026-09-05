export type AdminDTO = {
    readonly id: string;
    readonly name: string;
    readonly email: string;
    readonly status: string;
    readonly emailVerified: boolean;
    readonly createdByAdminId: string | null;
};
export type AdminListDTO = {
    readonly items: AdminDTO[];
    readonly total: number;
    readonly page: number;
    readonly perPage: number;
    readonly lastPage: number;
};
export type AuthenticatedAdminDTO = {
    readonly id: string;
    readonly name: string;
    readonly email: string;
};
export type CreateAdminDTO = {
    readonly name: string;
    readonly email: string;
    readonly password: string;
    readonly createdByAdminId: string;
};
export type ForgotPasswordDTO = {
    readonly email: string;
};
export type LoginDTO = {
    readonly email: string;
    readonly password: string;
    readonly ipAddress: string;
    readonly userAgent: string;
    readonly remember: boolean;
};
export type RegisterAdminDTO = {
    readonly name: string;
    readonly email: string;
    readonly password: string;
};
export type ResetPasswordDTO = {
    readonly email: string;
    readonly token: string;
    readonly newPassword: string;
};
export type SetupAdminDTO = {
    readonly email: string;
    readonly password: string;
};
export type UpdateAdminDTO = {
    readonly adminId: string;
    readonly name: string;
    readonly email: string;
};
export type VerifyEmailDTO = {
    readonly email: string;
    readonly token: string;
};
