
import React from "react";
import TextField from "@mui/material/TextField";
import FormControl from "@mui/material/FormControl";
import InputAdornment from "@mui/material/InputAdornment";
import IconButton from "@mui/material/IconButton";
import Visibility from "@mui/icons-material/Visibility"
import VisibilityOff from "@mui/icons-material/VisibilityOff"
import Mail from "@mui/icons-material/Mail"
import Lock from "@mui/icons-material/Lock"
import type { SetupAdminDTO } from "@/Modules/admin/types"
export default function AdminLoginField(): React.ReactNode {
    const [field, setField] = React.useState<SetupAdminDTO>({
        email: "hi@hectastudio.in",
        password: ""
    });
    const [showPassword, setShowPassword] = React.useState(false);
    const inputSx = {
        "& .MuiOutlinedInput-root": {
            borderRadius: "12px",
            backgroundColor: { xs: "rgba(255,255,255,0.06)", md: "#FAFAF9" },
            "& fieldset": {
                borderColor: { xs: "rgba(255,255,255,0.18)", md: "#E7E5E4" },
            },
            "&:hover fieldset": {
                borderColor: { xs: "rgba(255,255,255,0.32)", md: "#D6D3D1" },
            },
            "&.Mui-focused fieldset": {
                borderColor: "#EA6A2B",
                borderWidth: "1.5px",
            },
        },
        "& .MuiInputBase-input": {
            color: { xs: "#FFFFFF", sm: "#1C1917", md: "#1C1917", },
            fontSize: "0.9rem",
            padding: "14px 14px",
        },
        "& .MuiInputBase-input::placeholder": {
            color: { xs: "rgba(255,255,255,0.45)", md: "#A8A29E", },
            opacity: 1,
        },
        "& .MuiSvgIcon-root, & svg": {
            color: { xs: "rgba(255,255,255,0.5)", md: "#A8A29E", },
        },
    };
    return (
        <form action="" className="flex flex-col gap-4">
            <FormControl>
                <label className="mb-1.5 block text-xs font-medium text-white/70 md:text-stone-600">
                    Your email
                </label>
                <TextField fullWidth size="small" value={field.email} onChange={(e) => setField((prev) => {
                    return { ...prev, email: e.target.value }
                })} placeholder="you@example.com"
                    type="email" sx={inputSx} slotProps={{
                        input: {
                            startAdornment: (
                                <InputAdornment position="start">
                                    <Mail sx={{ fontSize: 16, strokeWidth: 1.75 }} />
                                </InputAdornment>
                            )
                        }
                    }}

                />
            </FormControl>
            <FormControl>
                <label className="mb-1.5 block text-xs font-medium text-white/70 md:text-stone-600">
                    Create new password
                </label>
                <TextField
                    fullWidth
                    size="small"
                    value={field.password}
                    onChange={(e) => setField((prev) => {
                        return { ...prev, password: e.target.value }
                    })}
                    placeholder="••••••••••"
                    type={showPassword ? "text" : "password"}
                    sx={inputSx}
                    slotProps={{
                        input: {
                            startAdornment: (
                                <InputAdornment position="start">
                                    <Lock sx={{ fontSize: 16, strokeWidth: 1.75 }} />
                                </InputAdornment>
                            ),
                            endAdornment: (
                                <InputAdornment position="end">
                                    <IconButton size="small" onClick={() => setShowPassword((v) => !v)} edge="end" sx={{ color: "inherit" }}>
                                        {showPassword ? (
                                            <VisibilityOff sx={{ fontSize: 16, strokeWidth: 1.75 }} />
                                        ) : (
                                            <Visibility sx={{ fontSize: 16, strokeWidth: 1.75 }} />
                                        )}
                                    </IconButton>
                                </InputAdornment>
                            )
                        }
                    }}

                />
            </FormControl>
            <button type="submit" className="mt-2 w-full rounded-full
             bg-orange-500 hover:bg-orange-600 active:bg-orange-700
              transition-colors py-3 text-sm font-semibold text-white
               shadow-[0_8px_20px_-6px_rgba(234,106,43,0.6)]">
                Create new account
            </button>

        </form>
    );
}