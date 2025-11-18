import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useToast } from "@/hooks/use-toast";
import { Vote, User, Shield, Users } from "lucide-react";

type UserRole = "pemilih" | "admin" | "calon";

const Login = () => {
  const [userId, setUserId] = useState("");
  const [password, setPassword] = useState("");
  const [selectedRole, setSelectedRole] = useState<UserRole>("pemilih");
  const [isLoading, setIsLoading] = useState(false);
  const navigate = useNavigate();
  const { toast } = useToast();

  // Dummy user data for each role
  const validUsers = {
    pemilih: [
      { id: "081234567890", password: "pemilih123", name: "Ahmad Fauzi" },
      { id: "089876543210", password: "pemilih123", name: "Siti Nurhaliza" },
      { id: "082345678901", password: "pemilih123", name: "Budi Santoso" },
    ],
    admin: [
      { id: "admin", password: "admin123", name: "Administrator" },
    ],
    calon: [
      { id: "calon1", password: "calon123", name: "Ahmad Rizki", candidateNumber: 1 },
      { id: "calon2", password: "calon123", name: "Siti Aisyah", candidateNumber: 2 },
      { id: "calon3", password: "calon123", name: "Muhammad Farhan", candidateNumber: 3 },
    ],
  };

  const handleLogin = (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);

    setTimeout(() => {
      const users = validUsers[selectedRole];
      const user = users.find(
        (u) => u.id === userId && u.password === password
      );

      if (user) {
        localStorage.setItem("userId", user.id);
        localStorage.setItem("userName", user.name);
        localStorage.setItem("userRole", selectedRole);
        
        if (selectedRole === "calon" && "candidateNumber" in user) {
          localStorage.setItem("candidateNumber", user.candidateNumber.toString());
        }
        
        toast({
          title: "Login Berhasil",
          description: `Selamat datang, ${user.name}!`,
        });
        
        // Navigate based on role
        if (selectedRole === "pemilih") {
          navigate("/voting");
        } else if (selectedRole === "admin") {
          navigate("/admin");
        } else if (selectedRole === "calon") {
          navigate("/candidate");
        }
      } else {
        toast({
          variant: "destructive",
          title: "Login Gagal",
          description: "ID atau password salah.",
        });
      }
      
      setIsLoading(false);
    }, 800);
  };

  const roleButtons = [
    {
      role: "pemilih" as UserRole,
      label: "Login Sebagai Pemilih",
      icon: User,
      gradient: "from-primary to-accent",
    },
    {
      role: "admin" as UserRole,
      label: "Login Sebagai Admin",
      icon: Shield,
      gradient: "from-secondary to-primary",
    },
    {
      role: "calon" as UserRole,
      label: "Login Sebagai Calon",
      icon: Users,
      gradient: "from-accent to-secondary",
    },
  ];

  return (
    <div className="min-h-screen w-full gradient-primary flex items-center justify-center p-4">
      <div className="w-full max-w-md animate-scale-in">
        <div className="bg-card rounded-[20px] shadow-soft p-8 md:p-10">
          <div className="flex flex-col items-center mb-8">
            <div className="w-16 h-16 rounded-full gradient-primary flex items-center justify-center mb-4">
              <Vote className="w-8 h-8 text-primary-foreground" />
            </div>
            <h1 className="text-2xl md:text-3xl font-bold text-foreground text-center">
              E-Voting OSIS
            </h1>
            <p className="text-muted-foreground text-center mt-2">
              Pemilihan Ketua & Wakil OSIS
            </p>
          </div>

          {/* Role Selection Buttons */}
          <div className="grid grid-cols-1 gap-3 mb-6">
            {roleButtons.map(({ role, label, icon: Icon, gradient }) => (
              <Button
                key={role}
                type="button"
                variant={selectedRole === role ? "default" : "outline"}
                className={`h-12 rounded-xl transition-all ${
                  selectedRole === role
                    ? `bg-gradient-to-r ${gradient} text-white border-0`
                    : "hover:scale-[1.02]"
                }`}
                onClick={() => setSelectedRole(role)}
              >
                <Icon className="w-4 h-4 mr-2" />
                {label}
              </Button>
            ))}
          </div>

          <form onSubmit={handleLogin} className="space-y-6">
            <div className="space-y-2">
              <Label htmlFor="userId">
                {selectedRole === "pemilih" 
                  ? "Nomor Telepon / ID User" 
                  : selectedRole === "admin"
                  ? "Username Admin"
                  : "ID Calon"}
              </Label>
              <Input
                id="userId"
                type="text"
                placeholder={
                  selectedRole === "pemilih"
                    ? "Masukkan nomor telepon"
                    : selectedRole === "admin"
                    ? "Masukkan username"
                    : "Masukkan ID calon"
                }
                value={userId}
                onChange={(e) => setUserId(e.target.value)}
                required
                className="h-12 rounded-xl transition-all focus:scale-[1.02]"
              />
            </div>

            <div className="space-y-2">
              <Label htmlFor="password">Password</Label>
              <Input
                id="password"
                type="password"
                placeholder="Masukkan password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                required
                className="h-12 rounded-xl transition-all focus:scale-[1.02]"
              />
            </div>

            <Button
              type="submit"
              className="w-full h-12 rounded-xl text-base font-semibold gradient-primary hover:opacity-90 transition-opacity"
              disabled={isLoading}
            >
              {isLoading ? "Memproses..." : "Login"}
            </Button>

            <p className="text-xs text-muted-foreground text-center">
              {selectedRole === "pemilih" && "Gunakan akun yang diberikan panitia"}
              {selectedRole === "admin" && "Hanya untuk administrator sistem"}
              {selectedRole === "calon" && "Login khusus untuk kandidat"}
            </p>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Login;
