import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { useToast } from "@/hooks/use-toast";
import { Vote } from "lucide-react";

const Login = () => {
  const [userId, setUserId] = useState("");
  const [password, setPassword] = useState("");
  const [isLoading, setIsLoading] = useState(false);
  const navigate = useNavigate();
  const { toast } = useToast();

  // Dummy user data
  const validUsers = [
    { id: "081234567890", password: "pemilih123", name: "Ahmad Fauzi" },
    { id: "089876543210", password: "pemilih123", name: "Siti Nurhaliza" },
    { id: "082345678901", password: "pemilih123", name: "Budi Santoso" },
  ];

  const handleLogin = (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);

    // Simulate API call
    setTimeout(() => {
      const user = validUsers.find(
        (u) => u.id === userId && u.password === password
      );

      if (user) {
        // Save user session
        localStorage.setItem("userId", user.id);
        localStorage.setItem("userName", user.name);
        
        toast({
          title: "Login Berhasil",
          description: `Selamat datang, ${user.name}!`,
        });
        
        navigate("/voting");
      } else {
        toast({
          variant: "destructive",
          title: "Login Gagal",
          description: "Nomor telepon atau password salah.",
        });
      }
      
      setIsLoading(false);
    }, 800);
  };

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

          <form onSubmit={handleLogin} className="space-y-6">
            <div className="space-y-2">
              <Label htmlFor="userId">Nomor Telepon / ID User</Label>
              <Input
                id="userId"
                type="text"
                placeholder="Masukkan nomor telepon"
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
              Gunakan akun yang diberikan panitia
            </p>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Login;
