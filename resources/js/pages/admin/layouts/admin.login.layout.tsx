import AdminLoginField from "@/Modules/admin/components/admin.login.field";
export function AdminLoginLayout() {
    const SunIcon = ({ className }: { className: string }): React.ReactNode => {
        return (
            <svg
                viewBox="0 0 24 24"
                fill="none"
                className={className}
                aria-hidden="true"
            >
                {Array.from({ length: 8 }).map((_, i) => {
                    const angle = (i * Math.PI) / 4;
                    const x1 = 12 + Math.cos(angle) * 4.5;
                    const y1 = 12 + Math.sin(angle) * 4.5;
                    const x2 = 12 + Math.cos(angle) * 10.5;
                    const y2 = 12 + Math.sin(angle) * 10.5;
                    return (
                        <line
                            key={i}
                            x1={x1}
                            y1={y1}
                            x2={x2}
                            y2={y2}
                            stroke="currentColor"
                            strokeWidth="1.6"
                            strokeLinecap="round"
                        />
                    );
                })}
            </svg>
        )
    };
    
    return (
        <div className="min-h-screen w-full flex items-center justify-center bg-stone-100 p-4 sm:p-6 font-sans">
            <div className="relative w-full max-w-4xl overflow-hidden rounded-[28px] shadow-[0_20px_60px_-15px_rgba(0,0,0,0.25)] flex flex-col md:flex-row md:min-h-135">
                <div className="absolute inset-0 md:relative md:inset-auto md:w-1/2 md:shrink-0 bg-black overflow-hidden">
                    <div
                        className="absolute inset-0"
                        style={{
                            background:
                                "radial-gradient(120% 90% at 20% 100%, rgba(255,150,60,0.55) 0%, rgba(234,106,43,0.35) 30%, rgba(0,0,0,0) 65%)",
                        }}
                    />
                    <div className="absolute -left-6 bottom-0 h-2/3 w-2/3 opacity-70 blur-2xl"
                        style={{
                            background:
                                "repeating-linear-gradient(100deg, rgba(255,170,90,0.5) 0px, rgba(255,170,90,0.5) 6px, rgba(0,0,0,0) 6px, rgba(0,0,0,0) 26px)",
                            maskImage:
                                "linear-gradient(to top, rgba(0,0,0,1), rgba(0,0,0,0))",
                            WebkitMaskImage:
                                "linear-gradient(to top, rgba(0,0,0,1), rgba(0,0,0,0))",
                        }}
                    />

                    {/* copy — hidden on mobile per brief, shown from md up */}
                    <div className="hidden md:flex relative z-10 h-full flex-col justify-start p-10 lg:p-12">
                        <h1 className="max-w-[15ch] text-3xl lg:text-[2rem] font-semibold leading-[1.2] text-white tracking-tight">
                            Convert your ideas into successful business.
                        </h1>
                    </div>
                </div>
                <div className="relative z-10 w-full md:w-1/2 flex items-center justify-center px-6 py-14 sm:px-10 md:bg-white">
                    <div className="w-full max-w-85">
                        <SunIcon className="h-7 w-7 text-orange-500 mb-5" />

                        <h2 className="text-2xl font-semibold text-white md:text-stone-900 tracking-tight">
                            Get Started
                        </h2>
                        <p className="mt-1.5 mb-7 text-sm text-white/60 md:text-stone-500">
                            Welcome to HectaStudio — let's get started
                        </p>
                        {/* admin field */}
                        <AdminLoginField />
                        <p className="mt-6 text-center text-xs text-white/60 md:text-stone-500">
                            Already have account?{" "}
                            <a href="#" className="font-semibold text-white md:text-stone-900 underline underline-offset-2">
                                Login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    )
}