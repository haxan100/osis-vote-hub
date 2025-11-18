import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { Button } from "@/components/ui/button";
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from "@/components/ui/card";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Switch } from "@/components/ui/switch";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { 
  LogOut, 
  Users, 
  UserCog, 
  Clock, 
  BarChart3, 
  Settings,
  TrendingUp,
  Vote,
  CheckCircle2,
  Shield
} from "lucide-react";
import { PieChart, Pie, Cell, BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from "recharts";

const AdminDashboard = () => {
  const [adminName, setAdminName] = useState("");
  const [quickcountEnabled, setQuickcountEnabled] = useState(true);
  const navigate = useNavigate();

  useEffect(() => {
    const storedName = localStorage.getItem("userName");
    const storedRole = localStorage.getItem("userRole");
    
    if (!storedName || storedRole !== "admin") {
      navigate("/");
      return;
    }
    
    setAdminName(storedName);
  }, [navigate]);

  const handleLogout = () => {
    localStorage.removeItem("userId");
    localStorage.removeItem("userName");
    localStorage.removeItem("userRole");
    navigate("/");
  };

  // Dummy data for charts
  const voteData = [
    { name: "Paslon 1", value: 45, fill: "hsl(var(--primary))" },
    { name: "Paslon 2", value: 32, fill: "hsl(var(--secondary))" },
    { name: "Paslon 3", value: 23, fill: "hsl(var(--accent))" },
  ];

  const progressData = [
    { candidate: "Paslon 1", votes: 45 },
    { candidate: "Paslon 2", votes: 32 },
    { candidate: "Paslon 3", votes: 23 },
  ];

  const stats = [
    { label: "Total Pemilih", value: "150", icon: Users, color: "text-primary" },
    { label: "Sudah Memilih", value: "100", icon: CheckCircle2, color: "text-success" },
    { label: "Belum Memilih", value: "50", icon: Clock, color: "text-destructive" },
    { label: "Partisipasi", value: "66.7%", icon: TrendingUp, color: "text-secondary" },
  ];

  return (
    <div className="min-h-screen bg-muted">
      {/* Header */}
      <header className="sticky top-0 z-10 bg-card shadow-card border-b border-border">
        <div className="container mx-auto px-4 py-4">
          <div className="flex justify-between items-center">
            <div className="flex items-center gap-3">
              <div className="w-12 h-12 rounded-full gradient-primary flex items-center justify-center">
                <Shield className="w-6 h-6 text-primary-foreground" />
              </div>
              <div>
                <h1 className="text-xl md:text-2xl font-bold text-foreground">
                  Dashboard Admin
                </h1>
                <p className="text-sm text-muted-foreground">{adminName}</p>
              </div>
            </div>
            <Button
              variant="outline"
              size="sm"
              onClick={handleLogout}
              className="rounded-xl"
            >
              <LogOut className="w-4 h-4 mr-2" />
              Keluar
            </Button>
          </div>
        </div>
      </header>

      <main className="container mx-auto px-4 py-8">
        {/* Stats Cards */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
          {stats.map((stat, index) => (
            <Card key={index} className="rounded-[20px] shadow-card animate-fade-in">
              <CardContent className="p-6">
                <div className="flex items-center justify-between">
                  <div>
                    <p className="text-sm text-muted-foreground mb-1">{stat.label}</p>
                    <h3 className="text-3xl font-bold text-foreground">{stat.value}</h3>
                  </div>
                  <div className={`w-12 h-12 rounded-full bg-muted flex items-center justify-center ${stat.color}`}>
                    <stat.icon className="w-6 h-6" />
                  </div>
                </div>
              </CardContent>
            </Card>
          ))}
        </div>

        {/* Main Content */}
        <Tabs defaultValue="quickcount" className="space-y-6">
          <TabsList className="grid w-full grid-cols-2 lg:grid-cols-5 rounded-xl h-auto p-1">
            <TabsTrigger value="quickcount" className="rounded-lg">
              <BarChart3 className="w-4 h-4 mr-2" />
              <span className="hidden sm:inline">Quickcount</span>
            </TabsTrigger>
            <TabsTrigger value="candidates" className="rounded-lg">
              <Vote className="w-4 h-4 mr-2" />
              <span className="hidden sm:inline">Calon</span>
            </TabsTrigger>
            <TabsTrigger value="voters" className="rounded-lg">
              <Users className="w-4 h-4 mr-2" />
              <span className="hidden sm:inline">Pemilih</span>
            </TabsTrigger>
            <TabsTrigger value="schedule" className="rounded-lg">
              <Clock className="w-4 h-4 mr-2" />
              <span className="hidden sm:inline">Jadwal</span>
            </TabsTrigger>
            <TabsTrigger value="settings" className="rounded-lg">
              <Settings className="w-4 h-4 mr-2" />
              <span className="hidden sm:inline">Pengaturan</span>
            </TabsTrigger>
          </TabsList>

          {/* Quickcount Tab */}
          <TabsContent value="quickcount" className="space-y-6">
            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
              <Card className="rounded-[20px] shadow-card">
                <CardHeader>
                  <CardTitle>Distribusi Suara</CardTitle>
                  <CardDescription>Persentase perolehan suara real-time</CardDescription>
                </CardHeader>
                <CardContent className="h-80">
                  <ResponsiveContainer width="100%" height="100%">
                    <PieChart>
                      <Pie
                        data={voteData}
                        cx="50%"
                        cy="50%"
                        labelLine={false}
                        label={({ name, percent }) => `${name}: ${(percent * 100).toFixed(0)}%`}
                        outerRadius={80}
                        fill="#8884d8"
                        dataKey="value"
                      >
                        {voteData.map((entry, index) => (
                          <Cell key={`cell-${index}`} fill={entry.fill} />
                        ))}
                      </Pie>
                      <Tooltip />
                    </PieChart>
                  </ResponsiveContainer>
                </CardContent>
              </Card>

              <Card className="rounded-[20px] shadow-card">
                <CardHeader>
                  <CardTitle>Perolehan Suara</CardTitle>
                  <CardDescription>Jumlah suara per kandidat</CardDescription>
                </CardHeader>
                <CardContent className="h-80">
                  <ResponsiveContainer width="100%" height="100%">
                    <BarChart data={progressData}>
                      <CartesianGrid strokeDasharray="3 3" />
                      <XAxis dataKey="candidate" />
                      <YAxis />
                      <Tooltip />
                      <Legend />
                      <Bar dataKey="votes" fill="hsl(var(--primary))" radius={[8, 8, 0, 0]} />
                    </BarChart>
                  </ResponsiveContainer>
                </CardContent>
              </Card>
            </div>
          </TabsContent>

          {/* Candidates Tab */}
          <TabsContent value="candidates">
            <Card className="rounded-[20px] shadow-card">
              <CardHeader>
                <CardTitle>Manajemen Calon</CardTitle>
                <CardDescription>Kelola data kandidat ketua & wakil OSIS</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  {[1, 2, 3].map((num) => (
                    <div key={num} className="flex items-center justify-between p-4 bg-muted rounded-xl">
                      <div>
                        <p className="font-semibold text-foreground">Pasangan Calon {num}</p>
                        <p className="text-sm text-muted-foreground">Kelola visi, misi, dan data kandidat</p>
                      </div>
                      <div className="flex gap-2">
                        <Button variant="outline" size="sm" className="rounded-lg">
                          <UserCog className="w-4 h-4 mr-2" />
                          Edit
                        </Button>
                      </div>
                    </div>
                  ))}
                </div>
              </CardContent>
            </Card>
          </TabsContent>

          {/* Voters Tab */}
          <TabsContent value="voters">
            <Card className="rounded-[20px] shadow-card">
              <CardHeader>
                <CardTitle>Manajemen Pemilih</CardTitle>
                <CardDescription>Import dan kelola data pemilih</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  <Button className="w-full md:w-auto rounded-xl gradient-primary">
                    <Users className="w-4 h-4 mr-2" />
                    Import Data Pemilih
                  </Button>
                  <div className="border border-border rounded-xl p-4">
                    <p className="text-sm text-muted-foreground text-center">
                      Daftar pemilih akan ditampilkan di sini
                    </p>
                  </div>
                </div>
              </CardContent>
            </Card>
          </TabsContent>

          {/* Schedule Tab */}
          <TabsContent value="schedule">
            <Card className="rounded-[20px] shadow-card">
              <CardHeader>
                <CardTitle>Pengaturan Waktu Pemilihan</CardTitle>
                <CardDescription>Atur jadwal mulai dan selesai pemilihan</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                      <Label>Waktu Mulai</Label>
                      <Input type="datetime-local" className="rounded-xl mt-2" />
                    </div>
                    <div>
                      <Label>Waktu Selesai</Label>
                      <Input type="datetime-local" className="rounded-xl mt-2" />
                    </div>
                  </div>
                  <Button className="rounded-xl gradient-primary">
                    <Clock className="w-4 h-4 mr-2" />
                    Simpan Jadwal
                  </Button>
                </div>
              </CardContent>
            </Card>
          </TabsContent>

          {/* Settings Tab */}
          <TabsContent value="settings">
            <Card className="rounded-[20px] shadow-card">
              <CardHeader>
                <CardTitle>Pengaturan Sistem</CardTitle>
                <CardDescription>Konfigurasi sistem pemilihan</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-6">
                  <div className="flex items-center justify-between p-4 bg-muted rounded-xl">
                    <div>
                      <Label htmlFor="quickcount" className="text-base font-semibold">
                        Quickcount Real-time
                      </Label>
                      <p className="text-sm text-muted-foreground mt-1">
                        Tampilkan hasil perhitungan suara secara langsung
                      </p>
                    </div>
                    <Switch
                      id="quickcount"
                      checked={quickcountEnabled}
                      onCheckedChange={setQuickcountEnabled}
                    />
                  </div>
                  
                  <div className="flex items-center justify-between p-4 bg-muted rounded-xl">
                    <div>
                      <Label className="text-base font-semibold">
                        Reset Data Pemilihan
                      </Label>
                      <p className="text-sm text-muted-foreground mt-1">
                        Hapus semua data suara (tidak dapat dikembalikan)
                      </p>
                    </div>
                    <Button variant="destructive" className="rounded-xl">
                      Reset
                    </Button>
                  </div>
                </div>
              </CardContent>
            </Card>
          </TabsContent>
        </Tabs>
      </main>
    </div>
  );
};

export default AdminDashboard;
